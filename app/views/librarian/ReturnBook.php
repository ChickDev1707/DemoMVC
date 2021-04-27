<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/Main.css">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/librarian/ReturnBook.css">
    <link rel="stylesheet" href= "<?php echo URLROOT;?>public/css/components/Info-form.css">
    <script src="https://kit.fontawesome.com/a7cf4e395f.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <?php
        require APPROOT."/views/includes/Header.php";
        require APPROOT."/views/includes/Librarian-nav-panel.php";
    ?>
     <form method="POST" autocomplete="off">
        readerID: <input type="text" name="readerId" required> <br>
        bookID: <input type="text" name="bookId" required> <br>
        Date Return: <input type="date" name="datereturn" value="<?php echo date('Y-m-d'); ?>" required> <br>
        <input type="submit" name="returnBook" value="return book">
    </form>
</body>
</html>