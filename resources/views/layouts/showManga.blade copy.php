
@extends('app')

@section('title', 'Home')

@section('content')

        <section class="anime-details spad">
            <div class="container">
                <div class="ad">



                    <div class="dt">
                        <div class="anime__details__content">
                            <div class="">
                                <div class="col-lg-10">
                                    <div class="anime__details__pic set-bg" data-setbg="{{ asset('storage/' . $manga->image) }}">
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="anime__details__text">
                                        <div class="anime__details__title">
                                            <h3>{{$manga->name}}</h3>
                                        </div>

                                        <p>{!! $manga->description !!}</p>

                                        <div class="anime__details__widget">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                    <ul>
                                                        <li><span>Type:</span> {{$manga->type}}</li>

                                                        <li><span>Genre:</span> {{$manga->genre_1 }}&nbsp; &nbsp;  {{ $manga->genre_2 }}&nbsp; &nbsp;  {{ $manga->genre_3}}</li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <ul>

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="anime__details__btn">
                                            @auth
                                                @if($sub)
                                                <a href="/Dashboard/subscribe?user_id={{ auth()->user()->id }}&manga_id={{ $manga->id }}" class="follow-btn"><i class="fa fa-heart-o"></i> unfollow</a>

                                                @else
                                                <a href="/Dashboard/subscribe?user_id={{ auth()->user()->id }}&manga_id={{ $manga->id }}" class="follow-btn"><i class="fa fa-heart-o"></i> follow</a>

                                                @endif

                                            @endauth
                                            @guest
                                            <a href="{{ route('login') }}" class="follow-btn"><i class="fa fa-heart-o"></i> Follow</a>


                                            @endguest
                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="chu">
                        <div>
                            <div class="chapter">


                                <!-- Webcomic Profile Section -->
                                
                            
                                <!-- Chapters Section -->
                                <div class="chapters-section">
                                    
                                    <ul class="chapter-list">
                                        @foreach ( $chapters as $chapter )
                                            <a href="{{$chapter->link}}"><li><img class="chi" src="{{ asset('storage/' . $chapter->image) }}">Chapter 1:{{$chapter->n_chapter}} <span>{{$chapter->date}}</span></li></a>
                                        @endforeach
                            
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
 <div id="chapters"></div>
                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <div class="anime__details__review">
                                <div class="section-title">
                                    <h5>Comments</h5>
                                </div>
                                    
                                    @foreach ($comments as $comment)

                                <div class="anime__review__item">
                                    <div class="anime__review__item__pic">
                                        <img src="img/anime/review-6.jpg" alt="">
                                    </div>
                                    <div class="anime__review__item__text">
                                        <h6>{{ $comment->user->name }} - <span>{{ $comment->created_at->diffForHumans() }} ago</span></h6>
                                        <p>{{ $comment->body }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="anime__details__form">
                                <div class="section-title">
                                    <h5>Your Comment</h5>
                                </div>
                                <form action="{{ route('comments.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$manga->id}}" />
                                    <textarea name="body" placeholder="Your Comment"></textarea>
                                    <button type="submit"><i class="fa fa-location-arrow"></i> Comment</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

@endsection

