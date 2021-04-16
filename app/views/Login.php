

<style>
    .login-wrapper{
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        justify-content: center;
        border: 1px solid black;
    }
    form{
        border: 1px solid black;
        padding: 30px 20px 50px;
        text-align: center;
        margin: 10px;
    }
    form input{
        margin: 10px 0;
        padding: 5px 20px;
    }
</style>

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
</div>