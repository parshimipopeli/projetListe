<?php
//echo realpath('index.php');
require_once 'config/connect.php';
//on va chercher la selection des users
connexionBdd::get_Instance()->query("SELECT *  FROM users");

//pour compter le nombre d 'entrée dans le resultat du select
$count = connexionBdd::get_Instance()->rowCount();
echo "<p class='text-center'>il y a $count users.</p>";

if (isset($_POST['delete'])) {
    $table = 'users';
    $id = $_POST['user'];
    connexionBdd::get_Instance()->delete($table, $id);
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
            <th>n° de maison</th>
            <th>n° de telephone</th>
            <th>email</th>
            <th>login</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $result = connexionBdd::get_Instance()->getResults();
        foreach ($result as $element) {
            echo '<tr role="row" class="odd">
                            <td><a href="liste.php?id=' . $element['id'] . '">' . $element['first_name'] . '</a> </td>
                            <td>' . $element['lastName'] . '</td>
                            <td>' . $element['street'] . '</td>
                            <td>' . $element['city'] . '</td>
                            <td>' . $element['house_number'] . '</td>
                             <td>' . $element['phone_number'] . '</td>
                            <td>' .$element['email'] . '</td>
                            <td>' . $element['login'] . '</td>
                            <td><a href="updateUsers.php?id=' . $element['id'] . '">update</a> </td>
                            <td><form method="post" >
                            <input type="hidden" name="user" value=' . $element['id'] . '>
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