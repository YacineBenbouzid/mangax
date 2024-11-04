<form action="{{ route('chapter.store') }}" method="POST">
    @csrf
    <label for="link1">image Link:</label>
    <input type="text" name="image" required>
    
    <label for="link2">chapter Link:</label>
    <input type="link" name="link" required>
    

    <label for="name">Name of the mnaga:</label>
    <select name="nmanga" id="type">
        @foreach($mangas as $manga)
            <option value="{{ $manga->id }}">{{ $manga->name }}</option>
        @endforeach
    </select>

    <label for="name">Name of the chapter:</label>
    <input type="text" name="nchapter" required>
    <label for="name">date released of the chapter:</label>
    <input type="date" name="date" required>
    
    <button type="submit">Save</button>
</form>