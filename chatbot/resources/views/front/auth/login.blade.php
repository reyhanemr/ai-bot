@extends('front.master')

@section('content')
    <div class="min-h-screen bg-slate-50 flex items-center justify-center p-4">
        <div class="max-w-md w-full bg-white rounded-xl shadow-md p-8">
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-slate-800">ورود</h1>
            </div>

            <form method="POST" action="{{ route('front.login') }}">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">ایمیل</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="w-full p-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('email') border-red-500 @enderror"
                               required>
                        @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">رمز عبور</label>
                        <input type="password" name="password"
                               class="w-full p-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('password') border-red-500 @enderror"
                               required>
                    </div>

                    <button type="submit"
                            class="w-full bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700 transition font-medium">
                        ورود
                    </button>
                </div>
            </form>

            <p class="text-center mt-4">
                حساب کاربری ندارید؟
                <a href="{{ route('front.register') }}" class="text-indigo-600 hover:underline">ثبت نام کنید</a>
            </p>
        </div>
    </div>
@endsection
