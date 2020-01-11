<?php
/**
 * This class maintains a connection to the database.
 * 
 * Primarely used by the Query class to execute queries.
 * 
 * @since 1.0.0
 */
class PH_DB {

    /**
     * The instance of the database api.
     * 
     * In the case of Phantom, this is for now mysqli, altough this might change to PDO in the future
     * 
     * @since 1.0.0
     */
    protected $db;

    /**
     * The constructor method
     * 
     * @param string $hostname The hostname of the mysql server (most likely to be 'localhost')
     * @param string $username The username of the mysql server
     * @param string $password The password of the mysql server
     * @param string $database The name of the database containing the phantom tables
     * 
     * @since 1.0.0
     */
    public function __construct($hostname = 'localhost', $username, $password, $database)
    {

        $connection = new mysqli($hostname, $username, $password, $database);

        if($connection->connect_errno) {
            die("[Critical Error] Could not connect to the database (Check your login info)");
        } else {
            $this->db = $connection;
        }
    }

    /**
     * Executes a query through a prepares statement
     * 
     * @param string $query The query
     * @param array $binds The parameters to bind to the query.
     * 
     * @since 1.0.0
     */
    public function query($query, $binds = []) {
        $stmt = $this->db->prepare($query);

        foreach($binds as $bind) {
            $type = $bind[0];
            $value = $bind[1];

            $stmt->bind_param($type, $value);
        }

        $stmt->execute();

        $arr = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        if(!$arr) {
            return false;
        } else {
            $stmt->close();
            return $arr;
        }
    }

}