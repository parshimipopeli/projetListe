<?php



/* Connexion à une base MySQL avec l'invocation de pilote */
$dsn = 'mysql:dbname=shopping_list;host=127.0.0.1';
$user = 'root';
$password = '';

try {
//    connection a la base de données
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}