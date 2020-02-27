<?php
/**
 * The database connection class.
 * 
 * Connects to a database and executes queries.
 * 
 * @since 2.0.0
 * 
 * @package Phantom.Core.Database
 */
class PH_DB {

    /**
     * The database connection.
     * 
     * In this case PDO.
     */
    protected $database_connection;

    /**
     * The constructor method.
     * Sets up the database connection OR throws an error that stops the execution of Phantom
     * 
     * @param string $dsn       The PDO DSN string. Should follow all the rules that apply to PDO.
     * @param string $username  The username for the database.
     * @param string $password  The password for the database.
     * @param array  $options   The PDO options.
     * 
     * @since 2.0.0
     * 
     * @return void
     */
    public function __construct($dsn, $username, $password, $options = [])
    {
        # Default Argument Validation
        if(!all_true(var_check(TYPE_STRING, $dsn), var_check(TYPE_STRING, $username), var_check(TYPE_STRING, $password), var_check(TYPE_ARRAY, $options))) return null;

        try {
            // Setup the database connection using PDO. If this fails, will throw an error.
            $pdo = new PDO($dsn, $username, $password, $options);
            $this->database_connection = $pdo;
        } catch(\PDOException $e) {
            // Throw exception
            # TODO: Change to native exception
            ph_die("Database connection resulted in an error. Message: " . $e->getMessage());
        }
    }

    /**
     * Executes a SELECT query on the database
     * 
     * @param string $tablename             The name of the table to select from.
     * @param array  $requested_columns     The name of the columns to return.
     * @param array  $where                 (Optional) The where statements.
     *                                          $column => $value : Checks if a column has a specific value.
     *                                          "__OR" => [
     *                                              [
     *                                                  $column => $value,
     *                                                  $column => $value
     *                                              ]
     *                                          ] : Creates an OR between the values.
     *                                          "$BIGGER" => [
     *                                              $column => $value
     *                                          ] : Checks whether the columns are bigger.
     * @param array  $join                  (Undeveloped, leave empty) The join statements.
     * @param string $append                (Optional) Extra string to append to the end of the query.
     * @param string $order_by              (Optional) Order by a specific column
     * 
     * @since 2.0.0
     */
    public function select($tablename, $requested_columns, $where = null, $join = null, $append = null, $order_by = null) {

        $vars = [];

        $qs = 'SELECT ';

        for ($i=0; $i < count($requested_columns); $i++) { 
            $col = $requested_columns[$i];
            $qs .= $col;

            if($i < count($requested_columns) - 1) {
                $qs .= ', ';
            }
        }

        $qs .= ' FROM ' . $tablename . ' ';

        if($where) {

            $data = $this->getWhereClause($where);

            $vars = array_merge($vars, $data["vars"]);

            $qs .= 'WHERE ' . $data["string"] . ' ';
            
        }

        if(var_check(TYPE_STRING, $order_by)) {
            $qs .= "ORDER BY " . $order_by . ' ';
        }

        if(var_check(TYPE_STRING, $append)) {
            $qs .= $append;
        }

        return $this->execute($qs, $vars);
        
    }

    /**
     * Inserts a row into the database
     * 
     * @param string $tablename The name of the table to insert to
     * @param array $columns    The names of the columns to insert to
     * @param array $values     The values of the columns
     * 
     * @since 2.0.0
     */
    public function insert($tablename, $keyvalues) {

        $columns = array_keys($keyvalues);
        $values = array_values($keyvalues);

        $qs = "INSERT INTO " . $tablename . " (";
        foreach ($columns as $column) {
            $qs .= $column . ', ';
        }
        $qs = substr($qs, 0, strlen($qs) - 2) . ') ';
        $qs .= "VALUES (";

        $vars = [];

        foreach ($values as $value) {
            array_push($vars, $value);
            $qs .= "?, ";
        }
        $qs = substr($qs, 0, strlen($qs) - 2) . ');';

        return $this->execute($qs, $vars);

    }

    /**
     * Updates a row within the database
     * 
     * @since 2.0.0
     */
    public function update($tablename, $keyvalues, $where) {

        $qs = "UPDATE " . $tablename . " SET ";

        $vars = [];

        foreach ($keyvalues as $key => $value) {
            $qs .= $key . " = ?, ";
            array_push($vars, $value);
        }

        $qs = substr($qs, 0, strlen($qs) - 2);

        $data = $this->getWhereClause($where);

        $qs .= " WHERE " . $data["string"];

        $vars = array_merge($vars, $data["vars"]);

        return $this->execute($qs, $vars);

    }

    /**
     * Deletes a row from the database
     * 
     * @param string $tablename The name of the table to delete from
     * @param array $where      The where variables
     * 
     * @since 2.0.0
     */
    public function delete($tablename, $where) {
        $qs = "DELETE FROM " . $tablename . " ";

        if(count($where) > 0) {
            $vars = [];

            $data = $this->getWhereClause($where);
    
            $qs .= "WHERE " . $data["string"];
    
            // echo $qs;
    
            $vars = array_merge($vars, $data["vars"]);
        }
        
        return $this->execute($qs, $vars);
    }

    /**
     * Generates a WHERE clause
     * 
     * @param array $where The where array
     * 
     * @return array ["string" => ...string, "vars" => ...array]
     * 
     * @since 2.0.0
     */
    protected function getWhereClause($where) {
        $where_vals = [];

        $qs = '';

        $it = 0;
        foreach ($where as $key => $value) {
            switch($key) {

                case "__OR":
                    
                    foreach ($value as $or_compare) {
                        $iit = 0;
                        foreach ($or_compare as $var => $val) {
                            $qs .= '(';
                            $iii = 0;
                            // var_dump($val);
                            foreach ($val as $vl) {
                                $qs .= $this->getWhereComparisonString($var, $vl);
                                array_push($where_vals, $vl);
                                if($iii < count($val) - 1) {
                                    $qs .= ' OR ';
                                }

                                $iii++;
                            }
                            $qs .= ')';

                            if($iit < count($or_compare) - 1) {
                                $qs .= ' AND ';
                            }

                            $iit++;
                        }
                        
                    }
                break;

                default:
                    $qs .= $this->getWhereComparisonString($key, $value);

                    array_push($where_vals, $value);
                break;

            }

            if($it < count($where) - 1) {
                $qs .= ' AND ';
            }

            $it++;
        }

        return [
            "string" => $qs,
            "vars" => $where_vals
        ];
    }

    /**
     * Parsed a comparison string within a WHERE clause
     * 
     * @param string $column_name The name of the column to do the comparison on. The format is as followed: ('==' or '>>' or '<<' or 'LI' or '>=' or '<=') + collumn_name.
     * 
     * @return string The fully created comparison string
     * 
     * @since 2.0.0
     */
    protected function getWhereComparisonString($column_name, $value = "ignore") {

        $first_char = substr($column_name, 0, 2);
        $cname = substr($column_name, 2);

        $comp_str = "=";

        switch($first_char) {
            
            case "==":
                if($value != "ignore") {
                    if(is_null($value)) {
                        $comp_str = "IS";
                    } else {
                        $comp_str = "=";
                    }
                } else {
                    $comp_str = "=";
                }
            break;

            case ">>":
                $comp_str = ">";
            break;

            case "<<":
                $comp_str = "<";
            break;

            case "LI":
                $comp_str = "LIKE";
            break;

            case "NL":
                $comp_str = "IS";
            break;

            case ">=":
                $comp_str = ">=";
            break;

            case "<=":
                $comp_str = "<=";
            break;
        }

        return $cname . " " . $comp_str . " ?";

    }

    /**
     * Executes a query, created by other functions
     * 
     * @since 2.0.0
     */
    protected function execute($query, $parameters) {
        $stmt = $this->database_connection->prepare($query);

        $stmt->execute($parameters);

        // $stmt->debugDumpParams();
        if($stmt->rowCount() > 0) {

            $r = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $result = new PH_DB_Result($r);

            return $result;

        } else {
            return new PH_DB_Result(null, false);
        }
        
    }

}