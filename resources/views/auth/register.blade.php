@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center h-full bg-gray-100">
    <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md">
        <h2 class="mb-6 text-2xl font-semibold text-center">{{ __('Register') }}</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-4">
                <label for="name" class="block mb-2 font-medium text-gray-700">{{ __('Name') }}</label>
                <input id="name" type="text" name="name"
                    class="w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-300 @error('name') border-red-500 @enderror"
                    value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block mb-2 font-medium text-gray-700">{{ __('Email Address') }}</label>
                <input id="email" type="email" name="email"
                    class="w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-300 @error('email') border-red-500 @enderror"
                    value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block mb-2 font-medium text-gray-700">{{ __('Password') }}</label>
                <input id="password" type="password" name="password"
                    class="w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-300 @error('password') border-red-500 @enderror"
                    required autocomplete="new-password">
                @error('password')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password-confirm" class="block mb-2 font-medium text-gray-700">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" name="password_confirmation"
                    class="w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-300"
                    required autocomplete="new-password">
            </div>

            <div class="flex justify-center">
                <button type="submit"
                    class="px-4 py-2 font-semibold text-white transition duration-200 bg-indigo-600 rounded hover:bg-indigo-700">
                    {{ __('Register') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
