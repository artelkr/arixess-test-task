<x-app-layout>
    <h1>Feedback Form</h1>

    @if($errors->any())
    <h2>Validation Error!</h2>

    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

    @if(session('status'))
    <div @class([session('status')['type']])>
        {{ session('status')['text'] }}
    </div>
    @endif

    <form action="{{ route('save-feedback') }}" method="post" enctype="multipart/form-data">
        @csrf

        <label>
            Subject

            <input type="text" name="subject" value="{{ old('subject') }}" required>
        </label>
        <label>
            Message

            <textarea name="message" cols="30" required>{{ old('message') }}</textarea>
        </label>
        <label>
            File

            <input type="file" name="file">
        </label>

        <button type="submit">Send</button>
    </form>
</x-app-layout>
