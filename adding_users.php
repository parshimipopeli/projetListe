<?php
require_once 'config/connect.php';

$req = $dbh->prepare('INSERT INTO users(first_name,lastName,city,street,house_number,phone_number,login,password) VALUES(?, ?, ?, ?, ?, ?, ?, ?)');



$req->bindParam(1,  $_POST['first_name']);
$req->bindParam(2, $_POST['lastName']);
$req->bindParam(3, $_POST['city']);
$req->bindParam(4,  $_POST['street']);
$req->bindParam(5,  $_POST['house_number']);
$req->bindParam(6,$_POST['phone_number']);
$req->bindParam(7,  $_POST['login']);
$pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
$req->bindParam(8, $pass);

$req->execute();
if ($req->execute()){
    header('LOCATION:index.php');
}

?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <title>Document</title>
</head>
<body>
<form method="POST" class="form-horizontal" action="">
    <div class="form-group">
        <div class="col-sm-10">
            <input type="text" name="first_name" class="form-control"  placeholder="Entrez votre nom">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-10">
            <input type="text" name="lastName" class="form-control"  placeholder="Entrez votre prenom">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-10">
            <input type="text" name="city" class="form-control"  placeholder="Entrez votre ville de résidence">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-10">
            <input type="text" name="street" class="form-control"  placeholder="Entrez le nom de votre rue">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-10">
            <input type="number" name="house_number" class="form-control"  placeholder="Entrez le numero de maison">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-10">
            <input type="number" name="phone_number" class="form-control"  placeholder="Entrez le numero de tel">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-10">
            <input type="text" name="login" class="form-control"  placeholder="Entrez votre login">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-10">
            <input type="text" name="password" class="form-control"  placeholder="Entrez votre mot de passe">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="submit" class="btn btn-default">Envoyer</button>
        </div>
    </div>
</form>
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>
