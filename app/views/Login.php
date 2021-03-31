

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

<form method = "POST" autocomplete="off" id= "login-panel">
    <h2>Login</h2>
    <input type="text" placeholder="username" name = "username"><br>
    <input type="text" placeholder="password" name ="pass"><br>
    <input type="submit" name = "submit">
</form>
