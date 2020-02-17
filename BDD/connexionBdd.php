<?php
//singleton for connexion bdd
namespace BDD;
require_once 'config/define.php';

/**
 * Class connexionBdd
 */
class connexionBdd
{
    /**
     * @var null
     */
    private static $_instance = null;
    /**
     * @var \PDO
     */
    public $_pdo;
    /**
     * @var
     */
    public $_sth;
    /**
     * @var
     */
    public $_rowcount;
    /**
     * @var
     */
    public $_LastInsertId;

    /**
     * connexionBdd constructor.
     *connection to the database
     */
    private function __construct()
    {
        try {
            $this->_pdo = new \PDO("mysql:dbname=" . DB_NAME . ";host=" . LOCALHOST, ROOT);
            $this->_pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            die('Connection non faite : ' . $e->getMessage());
        }
    }

    /**
     * @return connexionBdd|null
     */
    public static function get_Instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new connexionBdd();
        }
        return self::$_instance;
    }


    /**
     * @param $req
     * @param array $tab
     * @return $this
     * method for query
     */
    public function query($req, $tab = [])
    {
        $this->_sth = $this->_pdo->prepare($req);
        $this->_sth->execute($tab);
        $this->_rowcount = $this->_sth->rowCount();
        $this->_LastInsertId = $this->_pdo->lastInsertId();
        return $this;
    }

    /**
     * @return mixed
     *method for counting the number of users
     */
    public function rowCount()
    {
        return $this->_rowcount;
    }

    /**
     * @return mixed
     */
    public function lastinsertid()
    {
        return $this->_lastinsertid;
    }

    /**
     * @return mixed
     */
    public function getResults()
    {
        return $this->_sth->fetchAll();
    }


    /**
     * @param $table
     * @param $tab
     * method for insert into
     **/
    public function insert($table, $tab)
    {
        $queryValue = [];
        foreach ($tab as $key => $value) {
            $queryValue[":" . $key] = $value;
        }
        $fields = implode(",", array_keys($tab));
        $values = ":" . implode(',:', array_keys($tab));
        $sql = "INSERT INTO $table ($fields) VALUES ($values)";
        return $this->query($sql, $queryValue);
    }

//

    /**
     * @param $table
     * @param $id
     * method for delete user
     */
    public function delete($table, $id)
    {
        $tabId = [':id' => $id];
        $sql = "DELETE FROM $table WHERE id= :id";
        $this->query($sql, $tabId);

    }

    public function select($table,$id)
    {
        $tabId = [':id' => $id];
        $sql = " SELECT FROM $table where id = :id";
        $this->query($sql, $tabId);
    }


    /**
     * @param $table
     * @param $tab
     * @param $where
     * method for update user
     */
    public function update($table, $tab, $where)
    {
        $stringWhere = '';
        $stringSet = '';

        $values = '';
        $queryValue = [];
        foreach ($tab as $key => $value) {
            $stringSet .= "`$key` = :" . $key . ', ';

            $queryValue[':' . $key] = $value;
        }

        foreach ($where as $key => $value) {
            $stringWhere .= "`$key` = :" . $key . ', ';

            $queryValue[':' . $key] = $value;
        }

        $stringSet = rtrim($stringSet, ', ');
        $stringWhere = rtrim($stringWhere, ', ');

        $sql = "UPDATE $table SET $stringSet  WHERE $stringWhere ";


        $this->query($sql, $queryValue);


    }


}