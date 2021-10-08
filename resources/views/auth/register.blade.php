<x-auth-layout>
    <x-slot name="page_title">
        Register Form
    </x-slot>

    <form action="{{ route('register') }}" method="post">
        @csrf

        <label>
            Name

            <input type="text" autocomplete="name" name="name" required value="{{ old('name') }}">
        </label>
        <label>
            Email

            <input type="email" name="email" required value="{{ old('email') }}">
        </label>
        <label>
            Password

            <input type="password" name="password" autocomplete="new-password" required minlength="8">
        </label>
        <label>
            Password Confirmation

            <input type="password" autocomplete="new-password" name="password_confirmation" required minlength="8">
        </label>

        <button type="submit">Send</button>
    </form>
</x-auth-layout>
