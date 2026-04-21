
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>showNotes</title>
    <style>
      
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            text-align: center;
            background-color: rgba(216, 209, 221, 0.8);
          
        }
        
        a {
            text-decoration: none;
            color: black;
            background-color: blue;
            padding: 10px 15px;
            border-radius: 10px;
        }
        form{
            background-color: white;
            border-radius: 5px;
            padding: 10px;
            margin-top: 50%;
        }

    </style>
</head>
<body>
    <form action="{{ route('login') }}" class="auth">
       
    
    <h1>Janrey A. Lagunda</h1>   
    <h2>hello@gmail.com</h2>
    <br>
     <a href='{{ route('login') }}'>
        Logout
    </a>
    
    </form>
</body>
</html>