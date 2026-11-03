@extends('layouts.guest2')

@section('title', 'Confirm Password')
@section('content')
<div class="flex flex-col justify-center items-center min-h-screen p-6">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl overflow-hidden p-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-2">Confirm Password</h2>
        <p class="text-sm text-gray-600 mb-6">This is a secure area. Please confirm your password before continuing.</p>
        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Enter Password <span class="text-red-500">*</span></label>
                <input type="password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500" name="password" required autocomplete="current-password" autofocus>
            </div>
            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <button class="w-full py-3 px-4 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg shadow transition duration-150 ease-in-out" type="submit">Confirm</button>
        </form>
    </div>
</div>
@endsection
