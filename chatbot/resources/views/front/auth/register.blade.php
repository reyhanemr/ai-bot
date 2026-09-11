@extends('front.master')

@section('content')
    <div class="min-h-screen bg-slate-50 flex items-center justify-center p-4">
        <div class="max-w-md w-full bg-white rounded-xl shadow-md p-8">
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-slate-800">ثبت نام</h1>
            </div>

            <form method="POST" action="{{ route('front.register') }}">
                @csrf
                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">نام</label>
                            <input type="text" name="first_name" value="{{ old('first_name') }}"
                                   class="w-full p-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 @error('first_name') border-red-500 @enderror"
                                   required>
                            @error('first_name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">نام خانوادگی</label>
                            <input type="text" name="last_name" value="{{ old('last_name') }}"
                                   class="w-full p-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 @error('last_name') border-red-500 @enderror"
                                   required>
                            @error('last_name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">نام کاربری</label>
                        <input type="text" name="username" value="{{ old('username') }}"
                               class="w-full p-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 @error('username') border-red-500 @enderror"
                               required>
                        @error('username')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">ایمیل</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="w-full p-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 @error('email') border-red-500 @enderror"
                               required>
                        @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">شماره موبایل</label>
                        <input type="text" name="mobile" value="{{ old('mobile') }}"
                               class="w-full p-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 @error('mobile') border-red-500 @enderror"
                               required>
                        @error('mobile')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">رمز عبور</label>
                        <input type="password" name="password"
                               class="w-full p-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 @error('password') border-red-500 @enderror"
                               required>
                        @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">تکرار رمز عبور</label>
                        <input type="password" name="password_confirmation"
                               class="w-full p-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500"
                               required>
                    </div>

                    <button type="submit"
                            class="w-full bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700 transition font-medium">
                        ثبت نام
                    </button>
                </div>
            </form>

            <p class="text-center mt-4">
                حساب کاربری دارید؟
                <a href="{{ route('front.login') }}" class="text-indigo-600 hover:underline">وارد شوید</a>
            </p>
        </div>
    </div>
@endsection
