@extends('app')

@section('title', 'Home')

@section('content')


<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Summernote with Bootstrap 4</title>
    <link rel="stylesheet" href="{{ asset('css/cre.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">


    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    <style>


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
        .newchapter{
            display: flex;
            justify-content: center;
            position: absolute;

            top: 0;
            left: 0;
            background-color: rgb(0, 0, 0);
            margin-right: 20px;
            width: 100vw;
            overflow: visible;
        }

        .newchapter form{

            width: 50vw;
        }
        .newmanga{
            display: flex;
            justify-content: center;
            position: relative;

            top: 0;
            left: 0;
            background-color: rgb(0, 0, 0);
            margin-right: 20px;
            width: 100%;
            overflow: visible;
        }

        body{
            background-color: black;
        }
    </style>
  </head>
  <body>
    <div id="app">
        <example-component></example-component>
    </div>

      

    <script>
         function updateLabel(input) {
            const label = input.nextElementSibling;
            if (input.files && input.files[0]) {
                const fileName = input.files[0].name;
                label.querySelector('p').textContent = fileName;
            } else {
                label.querySelector('p').textContent = 'Click or Drag to Upload Image';
            }
        }

$('#summernote').summernote({
    height: 150,
  toolbar: [
    // [groupName, [list of button]]
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript', 'subscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['height', ['height']]
  ]
});
    </script>
  </body>
</html>

@endsection