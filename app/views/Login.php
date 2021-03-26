

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        form{
            border: 1px solid black;
            display: block;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 30px 20px 50px;
            text-align: center;
        }
        form input{
            margin: 10px 0;
            padding: 5px 20px;
        }
    </style>
</head>
<body>
    <form action="../controllers/Login-handler.php" method = "POST" autocomplete="off">
        <h2>Login</h2>
        <input type="text" placeholder="username" name = "username"><br>
        <input type="text" placeholder="password" name ="pass"><br>
        <input type="submit" name = "submit">
    </form>
</body>
</html>