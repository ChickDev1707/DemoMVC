

<form action="" method= "POST">
    <select name="role" id="">
        <option value="reader">reader</option>
        <option value="librarian">librarian</option>
    </select><br>
    <input type="submit" name= "login">
</form>
 <style>
    body{
        margin: 0;
        padding: 0;
    }
    form{
        position: relative;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 20%;
        border: 1px solid black;
        padding: 20px;
        text-align: center;
        box-sizing: border-box;
    }
    form select{
        margin-top: 10px;
        padding: 5px;
    }
    form input{
        margin-top: 50px ;
        padding: 10px 30px;
    }
</style>
<!--
<div class="login-wrapper">
    <form method = "POST" autocomplete="off" id= "login-panel">
        <h2>Login</h2>
        <input type="text" placeholder="username" name = "username"><br>
        <input type="text" placeholder="password" name ="password"><br>
        <input type="submit" name = "sign-in">
    </form>

    <form method = "POST" autocomplete="off" id= "sign-up-panel">
        <h2>Sign Up</h2>
        <input type="text" placeholder="username" name = "username"><br>
        <input type="text" placeholder="password" name ="password"><br>
        <input type="password" placeholder="confirm password" name ="confirmPassword"><br>
        <input type="submit" name = "sign-up">
    </form>
</div> -->

