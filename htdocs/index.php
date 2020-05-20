<?php

include 'php/connexion.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Combat</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Pangolin&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,100&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <h1>Mini TP War game</h1>

    <div class="container-fluid">
    <h2>Sign into your account</h2>
        <hr>
        <form action="php/register_user.php" method="post">
            <div class="col">
            <div class="col">
                <input type="text" class="form-control" placeholder="User name" name= "nickname" required autofocus>
                <button type="submit" name= "login" class="btn btn-primary">Next</button>
        </form>
    </div>

</body>
</html>

