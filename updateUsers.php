<?php
require_once 'config/connect.php';
require_once 'secure.php';

$id=$_GET['id'];
$sql = "SELECT * FROM users WHERE id=:id";
$req = $dbh->prepare($sql);
$req->bindParam(':id', $id);
$req->execute();
$user=$req->fetch();

if (isset($_POST['submit'])) {


    $tab['first_name'] =  $postSecure['first_name'];
    $tab['lastName'] =  $postSecure['lastName'];
    $tab['city'] = $postSecure['city'];
    $tab['street'] = $postSecure['street'];
    $tab['house_number'] = $postSecure['house_number'];
    $tab['phone_number'] = $postSecure['phone_number'];
    $tab['email'] = $postSecure['email'];
    $tab['login'] = $postSecure['login'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $tab['password'] = $pass;

    $id = $_GET['id'];
    $where = [ 'id' => $id];
    connexionBdd::get_Instance()->update('users', $tab, $where);
    header('LOCATION:index.php');
//    if ($dbh->update('users', $tab, $where )) {
//        header('location:index.php');
//    }
}






//$get = $_GET['id'];
//$req = $dbh->prepare("SELECT first_name,lastName,city,street,house_number,phone_number,email,login,password FROM users where id=?");
//$req->bindParam(1,$get);
//$req->execute();
//$donnees = $req->fetch();
//foreach ($donnees as $key=>$elements){
//    extract($donnees);
//}
//if(isset($_POST["submit"])){
//    $req = $dbh->prepare('UPDATE users
//SET first_name = ?,lastName = ?, city = ?, street = ?, house_number = ?, phone_number = ?,email = ? login = ?, password = ? WHERE id=? ' );
//    $req->bindParam(1,  $_POST['first_name']);
//    $req->bindParam(2,  $_POST['lastName']);
//    $req->bindParam(3, $_POST['city']);
//    $req->bindParam(4, $_POST['street']);
//    $req->bindParam(5, $_POST['house_number']);
//    $req->bindParam(6, $_POST['phone_number']);
//    $req->bindParam(7, $_POST['email']);
//    $req->bindParam(8, $_POST['login']);
//    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
//    $req->bindParam(9, $pass);
//    $req->bindParam(10,$get);
//    $req->execute();
//    if ($req->execute()){
//        header('LOCATION:index.php');
//    }
//}
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
            <input type="text" name="first_name" class="form-control"  value="<?=$user['first_name']?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-10">
            <input type="text" name="lastName" class="form-control"  value="<?=$user['lastName']?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-10">
            <input type="text" name="city" class="form-control"  value="<?=$user['city']?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-10">
            <input type="text" name="street" class="form-control"  value="<?=$user['street']?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-10">
            <input type="text" name="house_number" class="form-control"  value="<?=$user['house_number']?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-10">
            <input type="text" name="phone_number" class="form-control" value="<?=$user['phone_number']?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-10">
            <input type="email" name="email" class="form-control" value="<?=$user['email']?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-10">
            <input type="text" name="login" class="form-control"  value="<?=$user['login']?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-10">
            <input type="text" name="password" class="form-control"  placeholder="Entrez votre nouveau mot de passe">
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
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html></html>
