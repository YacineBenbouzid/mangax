@extends('app')

@section('title', 'Home')

@section('content')



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/cre.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

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
            position: absolute;

            top: 0;
            left: 0;
            background-color: rgb(0, 0, 0);
            margin-right: 20px;
            width: 100vw;
            overflow: visible;
        }

        body{
            background-color: black;
        }
    </style>
</head>
<body>
    <div id="app2"></div>

</body>
</html>

@endsection