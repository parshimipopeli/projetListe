<?php
require_once 'config/connect.php';
$sth = $dbh->prepare("SELECT *  FROM users");
$sth->execute();
    $count = $sth->rowCount();
echo"<p class='text-center'>il y a $count users.</p>";



if (isset($_POST['delete'])) {
    $req = $dbh->prepare('DELETE FROM users WHERE id=?');
    $req->bindParam(1,$_POST['user']);

    try
    {
        $dbh -> beginTransaction ();
        $req->execute();
        $dbh -> commit ();
        header('LOCATION:index.php');
    }
    catch ( Exception $e )
    {
        $dbh -> rollBack ();
    }

}





?>


<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <title>Document</title>
</head>
<body>



<div class="container-fluid">

    <table class="table table-dark table-striped">
        <thead>
        <tr>
            <th>nom</th>
            <th>prenom</th>
            <th>ville</th>
            <th>rue</th>
            <th>no de maison</th>
            <th>login</th>
            <th>password</th>
        </tr>
        </thead>
        <tbody>
        <?php

        while ($donnees = $sth->fetch()) {
            echo '<tr role="row" class="odd">
                            <td><a href="liste.php?id='.$donnees['id'].'">' . $donnees['first_name'] . '</a> </td>
                            <td>' . $donnees['lastName'] . '</td>
                            <td>' . $donnees['street'] . '</td>
                            <td>' . $donnees['city'] . '</td>
                            <td>' . $donnees['house_number'] . '</td>
                            <td>' . $donnees['login'] . '</td>
                            <td><a href="updateUsers.php?id='.$donnees['id'].'">update</a> </td>
                            <td><form method="post" >
                            <input type="hidden" name="user" value='.$donnees['id'].'>
                            <button type="submit" name="delete" >delete</button>
                            
                            </form></td>



                
                        </tr>';

        }
        ?>

<p><a href="adding_users.php">Ajouter un utilisateur</a></p>

        </tbody>
</table>
</div>








<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>