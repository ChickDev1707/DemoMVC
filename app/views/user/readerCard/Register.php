

<form id= "rc-register-form" form action="" method= "POST">
    <input type="text" placeholder="name" name= "name" autocomplete="off"><br>
    <input type="text" placeholder="type" name= "type" autocomplete="off"><br>
    <input type="text" placeholder="date of birth" name= "dateOfBirth" autocomplete="off"><br>
    <input type="text" placeholder="address" name= "address" autocomplete="off"><br>
    <input type="text" placeholder="email" name= "email" autocomplete="off"><br>
    <?php echo "<p> create date: ".date("d/m/Y")."</p>"?>
    <input type="submit" name= "createCardSubmit">
</form> 

