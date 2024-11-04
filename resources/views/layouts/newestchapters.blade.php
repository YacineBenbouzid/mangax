@extends('app')

@section('title', 'New')

@section('content')
<style>

    .nchp{
        padding: 5vw;
        display: flex;
        flex-wrap: wrap;
    }
    .chapterr{
        
        width: 20vw;
        padding: 3vw;
        height: 24vw;
    }
    .wh{
        padding: 10px;
        color: white;
    }
    .imgc{
        border-radius: 5px;
        width: 100%;
        height: 100%;
    }
    .tt{
        font-weight: 700;
    }
</style>
<h3 class="wh tt">New Chapter Releases</h3>
<div class="nchp">

@foreach($newestChapters as $chapter)


    <div class="chapterr" >
            <a href="{{ $chapter->link }}">

            <div >
                <img class="imgc" src="{{ asset('storage/' . $chapter->image) }}" />
            </div>
            <div >
                <h5 class="wh"><a >{{ $chapter->n_chapter }}</a></h5>
            </div>
        </a>
    </div>
                                
                          

@endforeach
</div>


@endsection