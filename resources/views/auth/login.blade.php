<x-auth-layout>
    <x-slot name="page_title">
        Login Form
    </x-slot>

    <form action="{{ route('login') }}" method="post">
        @csrf

        <label>
            Email

            <input type="email" name="email" required value="{{ old('email') }}">
        </label>
        <label>
            Password

            <input type="password" name="password" required minlength="8"">
        </label>

        <button type=" submit">Send</button>
    </form>
</x-auth-layout>
