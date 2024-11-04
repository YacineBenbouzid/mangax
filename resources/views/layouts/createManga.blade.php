<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Story</title>
    <style>
        /* Body Styling */
        body {
            background: linear-gradient(135deg, #74ebd5 0%, #ACB6E5 100%);
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Form Container Styling */
        .form-container {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            width: 350px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Input Field Styling */
        .form-container input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0 20px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .form-container input[type="text"]:focus {
            border-color: #74ebd5;
            outline: none;
        }
        

        /* Label Styling */
        .form-container label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
            color: #333;
        }

        /* Button Styling */
        .form-container button {
            background: #74ebd5;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            transition: background 0.3s ease;
        }

        .form-container button:hover {
            background: #66d3c1;
        }

        /* Form Heading Styling */
        .form-container h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-size: 24px;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h2>Create New Story</h2>
        <form action="{{ route('links.store') }}" method="POST">
            @csrf
            <label for="name">Name of the story:</label>
            <input type="text" name="name" required>
            
            <label for="link1">Link of the image:</label>
            <input type="text" name="image" required>
            
            <label for="description">Description of the story:</label>
            <input type="text" name="description" required>
            
            <button type="submit">Save</button>
        </form>
    </div>

</body>
</html>
