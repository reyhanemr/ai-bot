<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('front.login');
        }

        $user = Auth::user();
        $messages = ChatMessage::where('user_id', $user->id)
            ->orderBy('created_at', 'asc')
            ->get();

        return view('front.home.home_page', compact('messages'));
    }




    public function send(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'لطفاً وارد شوید'], 401);
        }

        $request->validate([
            'message' => 'nullable|string|max:10000',
            'pdf' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $user = Auth::user();
        $messageText = $request->input('message', '');
        $pdfFile = $request->file('pdf');


        //تست

        \Log::info('=== PDF Upload Debug ===');
        \Log::info('Has file?', ['has' => $request->hasFile('pdf')]);
        \Log::info('File object:', ['file' => $pdfFile]);
        \Log::info('Message:', ['message' => $messageText]);



        $category = 'general';
        $lower = strtolower($messageText);

        if (str_starts_with($lower, 'dfa')) {
            $category = 'dfa';
        } elseif (str_starts_with($lower, 'nfa')) {
            $category = 'nfa';
        } elseif (str_starts_with($lower, 'regex')) {
            $category = 'regex';
        } elseif ($pdfFile) {
            $category = 'general';
        }

        $displayMessage = $messageText;
        if ($pdfFile && empty($messageText)) {
            $displayMessage = 'آپلود فایل: ' . $pdfFile->getClientOriginalName();
        } elseif ($pdfFile) {
            $displayMessage = $messageText . ' [PDF: ' . $pdfFile->getClientOriginalName() . ']';
        }

        $userMessage = ChatMessage::create([
            'user_id' => $user->id,
            'sender' => 'user',
            'message' => $displayMessage,
            'type' => 'text',
            'image' => null,
            'category' => $category,
        ]);

        $botReply = '';
        $botType = 'text';
        $botImage = null;

        try {
            $http = Http::timeout(60);

            if ($pdfFile) {
                $response = $http
                    ->attach(
                        'pdf',
                        file_get_contents($pdfFile->getRealPath()),
                        $pdfFile->getClientOriginalName()
                    )
                    ->post('http://127.0.0.1:8001/predict', [
                        'text' => $messageText,
                    ]);
            } else {
                $response = $http->post('http://127.0.0.1:8001/predict', [
                    'text' => $messageText,
                ]);
            }

            if ($response->successful()) {
                $data = $response->json();
                $botReply = $data['reply'] ?? 'خطا در پاسخ سرور';
                $botType = $data['type'] ?? 'text';
                $botImage = $data['image'] ?? null;
            } else {
                $botReply = 'خطا در ارتباط با FastAPI: ' . $response->status();
            }
        } catch (\Exception $e) {
            $botReply = 'خطا: ' . $e->getMessage();
        }

        $botMessage = ChatMessage::create([
            'user_id' => $user->id,
            'sender' => 'bot',
            'message' => $botReply,
            'type' => $botType,
            'image' => $botImage,
            'category' => $userMessage->category,
        ]);

        $messages = ChatMessage::where('user_id', $user->id)
            ->whereIn('id', [$userMessage->id, $botMessage->id])
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(fn($msg) => [
                'id' => $msg->id,
                'sender' => $msg->sender,
                'message' => $msg->message,
                'type' => $msg->type,
                'image' => $msg->image,
                'created_at' => $msg->created_at->format('H:i'),
            ]);

        return response()->json([
            'success' => true,
            'messages' => $messages,
        ]);
    }











    /*public function send(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'لطفاً وارد شوید'], 401);
        }

        $request->validate(['message' => 'required|string|max:10000']);
        $user = Auth::user();
        $messageText = $request->message;

        // ذخیره پیام کاربر
        $category = 'general';
        $lower = strtolower($messageText);

        if (str_starts_with($lower, 'dfa')) {
            $category = 'dfa';
        } elseif (str_starts_with($lower, 'nfa')) {
            $category = 'nfa';
        }

        $userMessage = ChatMessage::create([
            'user_id' => $user->id,
            'sender' => 'user',
            'message' => $messageText,
            'type' => 'text',
            'image' => null,
            'category' => $category,
        ]);


        $botReply = '';
        $botType = 'text';
        $botImage = null;

        try {
            $lowerText = strtolower($messageText);
            if (str_starts_with($lowerText, 'dfa') || str_starts_with($lowerText, 'nfa')) {
                $type = str_starts_with($lowerText, 'dfa') ? 'dfa' : 'nfa';
                $jsonPart = trim(substr($messageText, strlen($type)));
                $automatonData = json_decode($jsonPart, true);

                if(!$automatonData){
                    $botReply = "لطفا جدول را تکمیل کنید!";
                } else {
                    $states = $automatonData['states'] ?? [];
                    $alphabet = $automatonData['alphabet'] ?? [];
                    $transitions = $automatonData['transitions'] ?? [];
                    $start = $automatonData['start'] ?? null;
                    $accept = $automatonData['accept'] ?? [];

                    // اعتبارسنجی start
                    if(!$start || !in_array($start, $states)){
                        $botReply = "حالت شروع نامعتبر است! باید در میان states باشد.";
                    }
                    // اعتبارسنجی accept
                    elseif(empty($accept) || count(array_diff($accept, $states)) > 0){
                        $botReply = "حالت/های پذیرش نامعتبرند! باید در میان states باشند.";
                    }
                    // اعتبارسنجی DFA
                    elseif($type==='dfa'){
                        foreach($states as $s){
                            foreach($alphabet as $sym){
                                if(!isset($transitions[$s][$sym])){
                                    $botReply = "DFA ناقص است! حالت $s برای نماد $sym مقصد ندارد.";
                                    break 2;
                                }
                            }
                        }
                    }

                    // اگر خطایی نبود، ارسال به FastAPI
                    if(!$botReply){
                        $response = Http::timeout(10)->post('http://127.0.0.1:8001/predict', [
                            'text' => $messageText
                        ]);

                        if($response->successful()){
                            $data = $response->json();
                            $botReply = $data['reply'] ?? 'خطا در پاسخ سرور 😅';
                            $botType = $data['type'] ?? 'text';
                            $botImage = $data['image'] ?? null;
                        } else {
                            $botReply = "خطا در ارتباط با سرور FastAPI: ".$response->status();
                        }
                    }
                }
            } else {
                // پیام عادی
                $response = Http::timeout(10)->post('http://127.0.0.1:8001/predict', [
                    'text' => $messageText
                ]);
                if($response->successful()){
                    $data = $response->json();
                    $botReply = $data['reply'] ?? 'خطا در پاسخ سرور 😅';
                    $botType = $data['type'] ?? 'text';
                    $botImage = $data['image'] ?? null;
                } else {
                    $botReply = "خطا در ارتباط با سرور FastAPI: ".$response->status();
                }
            }

        } catch (\Exception $e){
            $botReply = 'خطا در ارتباط با سرور: '.$e->getMessage();
        }

        // ذخیره پاسخ ربات
        $botMessage = ChatMessage::create([
            'user_id' => $user->id,
            'sender' => 'bot',
            'message' => $botReply,
            'type' => $botType,
            'image' => $botImage,
            'category' => $userMessage->category,
        ]);


        // بازگرداندن هیستوری پیام‌ها
        $messages = ChatMessage::where('user_id', $user->id)
            ->whereIn('id', [$userMessage->id, $botMessage->id])
            ->orderBy('created_at','asc')
            ->get()
            ->map(function($msg){
                return [
                    'id'=>$msg->id,
                    'sender'=>$msg->sender,
                    'message'=>$msg->message,
                    'type'=>$msg->type,
                    'image'=>$msg->image,
                    'created_at'=>$msg->created_at->format('H:i'),
                ];
            });

        return response()->json([
            'success'=>true,
            'messages'=>$messages
        ]);
    }*/




    public function filter($category)
    {
        $user = Auth::user();

        if (!in_array($category, ['all','dfa','nfa','regex']))  {
            return response()->json(['success'=>false,'message'=>'invalid category']);
        }

        $query = ChatMessage::where('user_id', $user->id);

        if ($category !== 'all') {
            $query->where('category', $category);
        }

        $messages = $query->orderBy('created_at','asc')->get();

        return response()->json([
            'success'=>true,
            'messages'=>$messages->map(function($msg){
                return [
                    'id'=>$msg->id,
                    'sender'=>$msg->sender,
                    'message'=>$msg->message,
                    'type'=>$msg->type,
                    'image'=>$msg->image,
                    'category'=>$msg->category,
                    'created_at'=>$msg->created_at->format('H:i'),
                ];
            })
        ]);
    }

}
