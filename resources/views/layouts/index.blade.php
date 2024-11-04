<!-- resources/views/links/index.blade.php -->
@foreach ($links as $link)
    <div>
        <h2>{{ $link->name }}</h2>
        <p>Link 1: <a href="{{ $link->image }}">{{ $link->image }}</a></p>
        <p>Link 2: <a href="{{ $link->link }}">{{ $link->link }}</a></p>
    </div>
@endforeach
