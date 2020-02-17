<?php
require_once 'config/connect.php';
$get = $_GET['id'];
$sth = $dbh->prepare("SELECT name,id FROM liste   where id=?");
$sth->execute(array($get));

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


<div class="container">
        <table class="table table-dark table-striped">
            <thead>
            <tr>
                <th>nom</th>
            </tr>
            </thead>
            <tbody>
<?php
while ($donnees = $sth->fetch()) {
    echo '<tr role="row" class="odd">
                            <td><a href="detailListe.php?id='.$donnees['id'].'">' . $donnees['name'] . '</a></td>
                        </tr>';
var_dump($donnees);
}
?>
            </tbody>
        </table>
    </div>

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src = "js/app.js"></script>
</body>
</html>