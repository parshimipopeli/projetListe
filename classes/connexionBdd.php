<?php
//singleton for connexion bdd

class connexionBdd
{
    private static $_instance = null;
    public $_pdo;
    private $_sth;
    private $_rowcount;
    private $_lastinsertid;

    private function __construct()
    {


        try {
            $this->_pdo =  new PDO("mysql:dbname=".DB_NAME.";host=".LOCALHOST, ROOT);
            $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Connection non faite : ' . $e->getMessage());
        }
    }


    public static function get_Instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new connexionBdd();
        }
        return self::$_instance;


    }
    //methode pour requette query
    public function query($req,$tab=[])
    {
        $this->_sth = $this->_pdo->prepare($req);
       $this->_sth->execute($tab);
       $this->_rowcount = $this->_sth->rowCount();
       $this->_lastinsertid = $this->_pdo->lastInsertId();
       return true;
    }

    public function rowCount()
    {
        return $this->_rowcount;
    }

    public function lastinsertid()
    {
        return $this->_lastinsertid;
    }

    public function getResults()
    {
        return $this->_sth->fetchAll();
    }

    public function insert($table,$tab)
    {
    $queryValue=[];
    foreach ($tab as $key => $value){
        $queryValue[":" . $key] = $value;
    }
       $fields = implode(",", array_keys($tab));
    $values = ":".implode(',:',array_keys($tab));
    $sql = "INSERT INTO $table ($fields) VALUES ($values)";
    $this->query($sql, $queryValue);
    }
    public function delete($table,$id){
        $tabId = [':id' => $id];
        $sql = "DELETE FROM $table WHERE id= :id";
        $this->query($sql,$tabId);
    }


}