@extends('app')

@section('title', 'Genres')

@section('content')



    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>


    <!-- Header End -->

    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="./index.html"><i class="fa fa-home"></i> Home</a>
                        <a href="./categories.html">Categories</a>
                        <span>{{$category}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Product Section Begin -->
    <section class="product-page spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="product__page__content">
                        <div class="product__page__title">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-6">
                                    <div class="section-title">
                                        <h4>{{$category}}</h4>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="row">

                            @foreach ($mangas as $link)
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    @if($link->link !=null)
                                        <a href="{{ $link->link }}">
                                    @else
                                        <a href="manga/{{ $link->id }}">
                                    @endif
                                    <div class="product__item">
                                        <div class="product__item__pic set-bg" data-setbg="{{ asset('storage/' . $link->image) }}" >
                                        </div>
                                        <div class="product__item__text">
                                            <ul>
                                                <li>Active</li>
                                                <li>Movie</li>
                                            </ul>
                                            <h5><a>{{ $link->name }}</a></h5>
                                        </div>
                                    </div></a>
                                </div>
                                
                            @endforeach
                            
                        </div>
                    </div>

                </div>

</div>
</div>
</section>





@endsection