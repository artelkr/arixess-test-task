<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Document' }}</title>
</head>

<body>
    <nav>
        <!-- TODO: move links to blade component for additional features. -->
        <a href="{{ route('login') }}" @class(['active' => Route::is('login')])>Login</a>
        <a href="{{ route('register') }}" @class(['active' => Route::is('register')])>Register</a>
    </nav>

    @if($page_title ?? null)
    <h1>{{ $page_title }}</h1>
    @endif

    @if($errors->any())
    <h2>Validation Error!</h2>

    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

    <main>
        {{ $slot }}
    </main>
</body>

</html>
