@extends('app')

@section('title', 'Dashboard')

@section('content')




<section class="login spad"></section>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="login__form">
                    <h3>Create a new Story</h3>
                    <form action="{{ route('links.store') }}" method="POST" class="form-card" enctype="multipart/form-data">
                        @csrf
                        <div class="input__item">
                            <input type="text" name="name" placeholder="Name of the Story">
                            <span class="icon_lock"></span>
                        </div>
                        <div class="input__item">
                            <input type="file" name="image"  >
                        </div>
                        <div >
                            <textarea name="description" rows="4" cols="39" placeholder="Description about the story ..." required></textarea>

                        </div>
                        
                        

                        @error('email')
                            <span class="text-danger">{{  $message }}</span>
                        @enderror
                        <button type="submit" class="site-btn">Login Now</button>
                    </form>
                    <a href="#" class="forget_pass">Forgot Your Password?</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="login__form">
                    <h3>Create a new Chapter</h3>
                    <form action="{{ route('chapter.store') }}" method="POST" class="form-card" enctype="multipart/form-data">
                        @csrf

                        <div class="input__item">
                            <input type="url"  name="link"  placeholder="link of the chapter" required>
                        </div>
                        <div >
                            <select name="nmanga" id="type">
                                @foreach($mangas as $manga)
                                    <option value="{{ $manga->id }}">{{ $manga->name }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div >
                            <input type="file" name="image"  >
                        </div>
                        <div class="input__item">
                            <input type="text" name="nchapter" required>
                        </div>
                        <div class="input__item">
                            <input type="date" name="date" required>
                        </div>
                        
                        
                        

                        @error('email')
                            <span class="text-danger">{{  $message }}</span>
                        @enderror
                        <button type="submit" class="site-btn">Login Now</button>
                    </form>
                    <a href="#" class="forget_pass">Forgot Your Password?</a>
                </div>
            </div>
        </div>
        

    </div>
</section>

<form action="{{ route('serie.create') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="seriesTitle">Series Title *</label>
            <input type="text" id="seriesTitle" name="name" placeholder="Series Title Here">



            <label for="readingLayouts">genre 1 *</label>
            <select id="readingLayouts" name="genre">
                <option value="infiniteScroll">Infinite Scroll</option>
                <option value="paginated">Paginated</option>
                <option value="twoPageView">Two-Page View (L-R)</option>
                <option value="twoPageViewR">Two-Page View (R-L)</option>
            </select>


            <div class="im">
                <input type="file" name="image" accept="image/*" onchange="updateLabel(this)">
                <div class="label">
                    <i class="fas fa-upload"></i>
                    <p>Click or Drag to Upload Image</p>
                </div>
            </div>


            <div class="button-container">
                <button type="submit">Submit</button>
            </div>
        </form>

@endsection







<form action="{{ route('chapter.store') }}" method="POST" class="frcd" enctype="multipart/form-data" >
        @csrf
        <h2>Create a New Chapter</h2>
        <div class="im">
            <input type="file" name="image" accept="image/*" onchange="updateLabel(this)">
            <div class="label">
                <i class="fas fa-upload"></i>
                <p>Click or Drag to Upload Image</p>
            </div>
        </div>

        <label for="link2">Chapter Link:</label>
        <input type="text" name="link" required>

        <label for="nmanga">Name of the Manga:</label>
        <select  name="nmanga" id="type">
            @foreach($mangas as $manga)
                <option value="{{ $manga->id }}">{{ $manga->name }}</option>
            @endforeach
        </select>

        <label for="nchapter">Name of the Chapter:</label>
        <input type="text" name="nchapter" required>

        <label for="date">Date Released of the Chapter:</label>
        <input type="date" name="date" required>

        <button type="submit">Save</button>
    </form>
</div>

    <div class="frcn">
        <h2>Series Form</h2>
        <form action="{{ route('links.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="seriesTitle">Series Title *</label>
            <input type="text" id="seriesTitle" name="name" placeholder="Series Title Here">

            <label>Series Type *</label>
            <div class="rdgr">
                <input type="radio" id="manga" name="seriesType" value="Manga">
                <label for="manga">Manga</label>

                <input type="radio" id="webcomic" name="seriesType" value="Webcomic">
                <label for="webcomic">Webcomic</label>

                <input type="radio" id="novel" name="seriesType" value="Novel">
                <label for="novel">Novel</label>
            </div>

            <label for="readingLayouts">genre 1 *</label>
            <select id="readingLayouts" name="genre">
                <option value="infiniteScroll">Infinite Scroll</option>
                <option value="paginated">Paginated</option>
                <option value="twoPageView">Two-Page View (L-R)</option>
                <option value="twoPageViewR">Two-Page View (R-L)</option>
            </select>

            <label>Set default reading experience *</label>
            <div class="rdgr">
                <input type="radio" id="infiniteScrollExp" name="readingExperience" value="Infinite Scroll">
                <label for="infiniteScrollExp">Infinite Scroll</label>

                <input type="radio" id="paginatedExp" name="readingExperience" value="Paginated">
                <label for="paginatedExp">Paginated</label>

                <input type="radio" id="twoPageViewExp" name="readingExperience" value="Two-Page View (L-R)">
                <label for="twoPageViewExp">Two-Page View (L-R)</label>
            </div>
            <div class="im">
                <input type="file" name="image" accept="image/*" onchange="updateLabel(this)">
                <div class="label">
                    <i class="fas fa-upload"></i>
                    <p>Click or Drag to Upload Image</p>
                </div>
            </div>
            <textarea id="summernote" name="description"> </textarea>

            <div class="button-container">
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>