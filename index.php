<?php
//require_once 'config/connect.php';
require_once 'vendor/autoload.php';
require_once 'BDD/connexionBdd.php';

 use  Dompdf\Dompdf ;
 use BDD\connexionBdd;


$table = "<table class='table table-dark table-striped' id='tableUsers'>
        <thead>
        <tr>
            <th>nom</th>
            <th>prènom</th>
            <th>ville</th>
            <th>rue</th>
            <th>n° de maison</th>
            <th>n° de telephone</th>
            <th>email</th>
            <th>login</th>
        </tr>
        </thead>
        <tbody>";
$result = connexionBdd::get_Instance()->query("SELECT *  FROM users")->getResults();
foreach ($result as $element) {
    $table .= '<tr role="row" class="odd">
                            <td><a href="liste.php?id=' . $element['id'] . '">' . $element['first_name'] . '</a> </td>
                            <td>' . $element['lastName'] . '</td>
                            <td>' . $element['street'] . '</td>
                            <td>' . $element['city'] . '</td>
                            <td>' . $element['house_number'] . '</td>
                             <td>' . $element['phone_number'] . '</td>
                            <td>' . $element['email'] . '</td>
                            <td>' . $element['login'] . '</td>
                            <td><a href="updateUsers.php?id=' . $element['id'] . '">update</a> </td>
                            <td><form method="post" >
                            <input type="hidden" name="user" value=' . $element['id'] . '>
                            <button type="submit" name="delete" >delete</button>
                            </form></td>
                        </tr>';
}

$table .= "<p><a href='adding_users.php'>Ajouter un utilisateur</a></p>
        </tbody>
    </table>";
//generate html in pdf
if (isset($_POST['pdf'])) {
    $dompdf = new  Dompdf ();
    $dompdf->loadHtml($table);
    $dompdf->setPaper(' A4 ', ' paysage ');
    $dompdf->render();
    $dompdf->stream();
}
echo 'la dernière url est' . ' ' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];//recuperer la derniere url entrèe.
//echo realpath('index.php');

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
    <?= $table ?>
<form method="post">
    <button name="pdf" type="submit">génerer pdf</button>
</form>
</div>
<!-- Button to Open the Modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
    ajout utilisateur
</button>

<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Veuillez entrer vos informations</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form method="POST" class="form-horizontal" id="addUser" action="">
                    <div class="form-group">
                        <div class="col-sm-10">
                            <input type="text" name="first_name" class="form-control" placeholder="Entrez votre nom">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10">
                            <input type="text" name="lastName" class="form-control" placeholder="Entrez votre prenom">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10">
                            <input type="text" name="city" class="form-control" placeholder="Entrez votre ville de résidence">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10">
                            <input type="text" name="street" class="form-control" placeholder="Entrez le nom de votre rue">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10">
                            <input type="number" name="house_number" class="form-control" placeholder="Entrez le numero de maison">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10">
                            <input type="number" name="phone_number" class="form-control" placeholder="Entrez le numero de tel">
                        </div>

                        <div class="form-group">
                            <div class="col-sm-10">
                                <input type="email" name="email" class="form-control" placeholder="Entrez votre email">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10">
                                <input type="text" name="login" class="form-control" placeholder="Entrez votre login">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10">
                                <input type="text" name="password" class="form-control" placeholder="Entrez votre mot de passe">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" name="submit" id="btnGo" class="btn btn-default">Envoyer</button>
                            </div>
                        </div>
                </form>
            </div>

            <!-- Modal footer -->
<!--            <div class="modal-footer">-->
<!--                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>-->
<!--            </div>-->

        </div>
    </div>
</div>
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="js/app.js"></script>
</body>
</html>