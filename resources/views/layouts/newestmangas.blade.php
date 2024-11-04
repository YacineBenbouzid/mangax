@extends('app')

@section('title', 'Home')

@section('content')
<style>

    .nchp{
        padding: 5vw;
        display: flex;
        flex-wrap: wrap;
    }
    .mangar{
        
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
<h3 class="wh tt">New Storie Releases</h3>
<div class="nchp">

@foreach($newestMangas as $manga)


    <div class="mangar" >
            <a href="{{ $manga->link }}">

            <div >
                <img class="imgc" src="{{ asset('storage/' . $manga->image) }}" />
            </div>
            <div >
                <h5 class="wh"><a >{{ $manga->name }}</a></h5>
            </div>
        </a>
    </div>
                                
                          

@endforeach
</div>


@endsection