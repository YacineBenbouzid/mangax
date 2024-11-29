
@extends('app')

@section('title', 'Serie')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/showManga.css') }}">
<style>
    .comment-section {
        width: 80%;
        max-width: 1000px;
        margin: 20px auto;
        font-family: Arial, sans-serif;
        color: #eee;
        /*background-color: #1a1a1a;*/
    }

    /* Comments header */
    .comments-header {
        border-bottom: 2px solid #333;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }

    .comments-title {
        font-size: 24px;
        color: #ff4d4d;
        font-weight: bold;
    }

    /* Individual comment item */
    .comment-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 20px;
        padding: 15px;
        border-radius: 8px;
        /*background: #2a2a2a;*/
        transition: box-shadow 0.3s ease;
    }

    .comment-item {
        box-shadow: 0px 4px 10px rgba(255, 77, 77, 0.2);
    }

    .comment-avatar img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin-right: 15px;
        border: 2px solid #ff4d4d;
    }

    /* Comment content */
    .comment-content {
        max-width: calc(100% - 65px);
    }

    .comment-author {
        font-size: 16px;
        font-weight: bold;
        color: #ff4d4d;
        margin-bottom: 5px;
    }

    .comment-time {
        font-size: 14px;
        color: #bbb;
        font-weight: normal;
    }

    .comment-text {
        font-size: 15px;
        color: #ddd;
        margin-top: 8px;
        line-height: 1.5;
    }

    /* Comment form */
    .comment-form-wrapper {
        margin-top: 30px;
        padding: 20px;
        border-radius: 8px;
        background: #2a2a2a;
    }

    .comment-form-header {
        border-bottom: 2px solid #333;
        padding-bottom: 10px;
        margin-bottom: 15px;
    }

    .comment-form-title {
        font-size: 20px;
        color: #ff4d4d;
        font-weight: bold;
    }

    .comment-form {
        display: flex;
        flex-direction: column;
    }

    .comment-input {
        width: 100%;
        min-height: 100px;
        padding: 12px;
        border-radius: 8px;
        border: 1px solid #444;
        background-color: #1a1a1a;
        color: #ddd;
        resize: vertical;
        margin-bottom: 15px;
        font-size: 15px;
    }

    .comment-input:focus {
        border-color: #ff4d4d;
        outline: none;
        box-shadow: 0 0 5px rgba(255, 77, 77, 0.5);
    }

    .comment-submit-btn {
        align-self: flex-end;
        padding: 10px 20px;
        font-size: 15px;
        color: #fff;
        background-color: #ff4d4d;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .comment-submit-btn:hover {
        background-color: #e63939;
    }


</style>
@endsection
@section('content')

<div class="hotserie showbg"  style="background-image: url('{{ asset('storage/' . $manga->banner) }}');">
    <div class="mdetail">
        <div class="mtop">
            <div class="mcover">
                <img  src="{{ asset('storage/' . $manga->image) }}"/>
            </div>
            <div class="mdescription">
                <div>
                    <h3>{{$manga->name}}</h3>
                    <p >{!! $manga->description !!}</p>
                
                </div>

            </div>
        </div>
        <div class="mdown">
            <div class="bleft">
                
                @if ($manga->genre_1!=='null')
                    <div class="genre">{!! $manga->genre_1 !!}</div>
                @endif
                
                @if ($manga->genre_2!=='null')
                    <div  class="genre">{!! $manga->genre_2 !!}</div>
                @endif
                
                @if ($manga->genre_3!=='null')
                    <div  class="genre" >{!! $manga->genre_3 !!}</div>
                @endif
            
                
                
            </div>
            <div class="bright">
                <div><div class="t1">CHAPTERS</div><div class="t2">+150</div></div>
                <div><div class="t1">STATUS</div><div  class="t2">Ongoing</div></div>
                <div><div class="t1">READ ON</div><div class="t2">Line webtoon</div></div>
                
            </div>
        </div>

    </div>
    @if(count($chapters) > 0)
    <div class="right ">
        <div class="w40 tol">
            <div class="chapter">



                <div class="chapterssection">
                    
                    <ul class="chapterlist">
                        @foreach ( $chapters as $chapter )
                            <a href="{{$chapter->link}}"><li><img class="chi" src="{{ asset('storage/' . $chapter->image) }}">Chapter 1:{{$chapter->n_chapter}} <span>{{$chapter->date}}</span></li></a>
                        @endforeach
            
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
<div class="vide"></div>

<div class="comment-section">
    <div class="comments-wrapper">
        <div class="comments-header">
            <h5 class="comments-title">Comments</h5>
        </div>
        @foreach ($comments as $comment)
            <div class="comment-item">
                <div class="comment-avatar">
                    <img src="{{asset('img/logo.png')}}" alt="User Avatar">
                </div>
                <div class="comment-content">
                    <h6 class="comment-author">{{ $comment->user->name }} - <span class="comment-time">{{ $comment->created_at->diffForHumans() }} ago</span></h6>
                    <p class="comment-text">{{ $comment->body }}</p>
                </div>
            </div>
        @endforeach
    </div>
    
    <div class="comment-form-wrapper">
        <div class="comment-form-header">
            <h5 class="comment-form-title">Your Comment</h5>
        </div>
        <form action="{{ route('comments.store') }}" method="POST" class="comment-form">
            @csrf
            <input type="hidden" name="id" value="{{ $manga->id }}" />
            <textarea name="body" class="comment-input" placeholder="Your Comment"></textarea>
            <button type="submit" class="comment-submit-btn"><i class="fa fa-location-arrow"></i> Comment</button>
        </form>
    </div>
</div>


@endsection

