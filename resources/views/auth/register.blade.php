@extends('layouts.auth')

@section('content')
<div class="flex flex-col items-center justify-center min-h-screen bg-gradient-to-br from-blue-600 to-blue-800">
    <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-md">
        <div class="mb-3 text-center">
            <a href="{{ url('/') }}" class="text-4xl font-bold text-blue-700">
                <span class="text-yellow-300">Job</span>Finder
            </a>
            <!-- Subtitle -->
            <p class="mb-6 text-sm text-center text-gray-500">
                Login to continue your journey
            </p>
        </div>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input id="name" type="text" name="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg @error('name') @enderror" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                <input id="email" type="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg @error('email') @enderror" value="{{ old('email') }}" required>
                @error('email')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" type="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg @error('password') @enderror" required>
                @error('password')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password-confirm" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input id="password-confirm" type="password" name="password_confirmation" class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
            </div>
            <div class="flex justify-center">
                <button type="submit" class="w-full px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-opacity-50">
                    Register
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
