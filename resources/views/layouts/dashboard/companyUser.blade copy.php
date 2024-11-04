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
                            <input type="url" name="link" placeholder="Name of the Story">
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

        </div>
        

    </div>
</section>

@endsection




#########




@extends('app')

@section('title', 'Home')

@section('content')



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <link rel="stylesheet" href="{{ asset('css/cre.css') }}">
    <style>
        .pi{
            display: flex;
            
        }
        .pi div{

            padding: 10px;
        }
        body {
         font-family: Arial, sans-serif;
         background-color: #f7f7f7;
         display: flex;
         justify-content: center;
         align-items: center;
         height: 100vh;
         margin: 0;
     }

     .im {
         position: relative;
         overflow: hidden;
         margin: 20px;
         border: 2px dashed #007BFF;
         border-radius: 8px;
         background-color: #fff;
         transition: all 0.3s ease;
         padding: 20px;
         text-align: center;
         cursor: pointer;
     }

     .im:hover {
         border-color: #0056b3;
         box-shadow: 0 4px 20px rgba(0, 123, 255, 0.2);
     }

     .im input[type="file"] {
         position: absolute;
         width: 100%;
         height: 100%;
         top: 0;
         left: 0;
         opacity: 0; /* Hide the default file input */
         cursor: pointer;
     }

     .im .label {
         display: flex;
         flex-direction: column;
         align-items: center;
         justify-content: center;
         color: #007BFF;
     }

     .im .label i {
         font-size: 48px;
         margin-bottom: 10px;
     }

     .im .label p {
         margin: 0;
         font-size: 16px;
     }
     body {
         font-family: Arial, sans-serif;
         background-color: #f7f7f7;
         display: flex;
         justify-content: center;
         align-items: center;
         height: 100vh;
         margin: 0;
     }

     .in {
         position: relative;
         width: 300px; /* Adjust width as needed */
         margin: 20px;
     }

     .in input[type="text"] {
         width: 100%;
         padding: 12px 40px 12px 20px; /* Add padding for icon */
         border: 2px solid #007BFF;
         border-radius: 8px;
         outline: none;
         transition: border-color 0.3s ease, box-shadow 0.3s ease;
         font-size: 16px;
     }

     .in input[type="text"]:focus {
         border-color: #0056b3;
         box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
     }

     .in .icon_lock {
         position: absolute;
         left: 10px;
         top: 50%;
         transform: translateY(-50%);
         font-size: 20px;
         color: #007BFF;
     }

     .in input::placeholder {
         color: #aaa; /* Placeholder color */
     }
 </style>
</head>
<body>
    <div id="app2"></div>
    <div class="form-container">
        <h2> Create serie</h2>
        <form action="{{ route('serie.create') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="seriesTitle">Series Title *</label>
            <input type="text" id="seriesTitle" name="name" placeholder="Series Title Here" required>

            <label for="seriesTitle">Series link *</label>
            <input type="url" id="seriesTitle" name="link" placeholder="Series Title Here" required>
            <div class="pi">
                <div><label for="readingLayouts">genre 1 *</label>
                    <select id="readingLayouts" name="genre_1" required>
                        <option value="infiniteScroll">Infinite Scroll</option>
                        <option value="paginated">Paginated</option>
                        <option value="twoPageView">Two-Page View (L-R)</option>
                        <option value="twoPageViewR">Two-Page View (R-L)</option>
                    </select>
                </div>
                <div><label for="readingLayouts">genre 2 (Option) *</label>
                    <select id="readingLayouts" name="genre_2" >
                        <option value="infiniteScroll">Infinite Scroll</option>
                        <option value="paginated">Paginated</option>
                        <option value="twoPageView">Two-Page View (L-R)</option>
                        <option value="twoPageViewR">Two-Page View (R-L)</option>
                    </select></div>
                <div><label for="readingLayouts">genre 3 (Option) *</label>
                    <select id="readingLayouts" name="genre_3" >
                        <option value="infiniteScroll">Infinite Scroll</option>
                        <option value="paginated">Paginated</option>
                        <option value="twoPageView">Two-Page View (L-R)</option>
                        <option value="twoPageViewR">Two-Page View (R-L)</option>
                    </select>
                </div>
            </div>      
            


            <div class="im" >
                <input type="file" name="image" accept=".jpeg" onchange="updateLabel(this)" required>
                <div class="label">
                    <i class="fas fa-upload"></i>
                    <p>Click or Drag to Upload Image (JPEG only)</p>
                </div>
            </div>


            <div class="button-container">
                <button type="submit">Create</button>
            </div>
        </form>
    </div>
</body>
</html>

@endsection