@extends('front.master')

@section('content')
    <div class="min-h-screen bg-slate-50 flex items-center justify-center p-4">
        <div class="max-w-md w-full text-center">
            <div class="flex items-center justify-center w-20 h-20 rounded-full bg-indigo-100 text-indigo-600 mx-auto mb-6">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-slate-800 mb-4">automata-ai</h1>
            <p class="text-slate-600 mb-8">دستیار هوشمند شما برای درس نظریه زبان ها و ماشین ها</p>

            <div class="space-y-3">
                <a href="{{ route('front.register') }}" class="block w-full bg-indigo-600 text-white py-3 rounded-xl hover:bg-indigo-700 transition font-medium">
                    شروع چت
                </a>
                <a href="{{ route('front.login') }}" class="block w-full text-indigo-600 border border-indigo-600 py-3 rounded-xl hover:bg-indigo-50 transition font-medium">
                    ورود
                </a>
            </div>
        </div>
    </div>
@endsection
