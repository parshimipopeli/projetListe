<?php
require_once 'config/connect.php';
$get = $_GET['id'];
$sth = $dbh->prepare("SELECT articles.nom, articles.prix_article, listes_articles.quantites FROM  articles inner join listes_articles on articles.id=listes_articles.id_article  where listes_articles.id=?");
$sth->execute(array($get));
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="container">
    <table class="table table-dark table-striped">
        <thead>
        <tr>
            <th>nom</th>
            <th>quantité</th>
            <th>prix_article</th>
        </tr>
        </thead>
        <tbody>
        <?php
        while ($donnees = $sth->fetch()) {
            echo '<tr role="row" class="odd">
                            <td>' . $donnees['nom'] . '</td>
                            <td>' . $donnees['quantites'] . '</td>
                            <td>' . $donnees['prix_article'] . '</td> 
                        </tr>';
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
</body>
</html>
