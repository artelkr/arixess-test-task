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
        @cannot('view-admin-panel')
        <a href="{{ route('home') }}">Home</a>
        @endcannot

        @can('view-admin-panel')
        <a href="{{ route('admin-panel') }}">Admin Panel</a>
        @endcan

        <form action="{{ route('logout') }}" method="post">
            @csrf

            <button type="submit">Logout</button>
        </form>
    </nav>

    @if(session('status'))
    <div @class([session('status')['type']])>
        {{ session('status')['text'] }}
    </div>
    @endif

    <main>
        {{ $slot }}
    </main>
</body>

</html>
