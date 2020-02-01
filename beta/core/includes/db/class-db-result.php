<?php
/**
 * A database query result
 * 
 * @since 2.0.0
 */
class PH_DB_Result implements ArrayAccess, Iterator {

    /**
     * The actual result
     * 
     * @since 2.0.0
     */
    protected $result;

    /**
     * The current active "working" row
     * 
     * @since 2.0.0
     */
    protected $row = 0;

    /**
     * Whether the query resulted in a usable result
     * 
     * @since 2.0.0
     */
    protected $success = true;

    /**
     * Sets up the result.
     * 
     * @param array $result A assoc array from $stmt->feth
     * @param bool $success Whether the query resulted in a usable result
     */
    public function __construct($result, $success = true)
    {
        $this->result = $result;
        $this->success = $success;
    }

    /**
     * Whether a row exists.
     * 
     * @since 2.0.0
     */
    public function offsetExists($offset)
    {
        return isset($this->result[$offset]);
    }

    /**
     * Gets a row.
     * Sets the current working row to the value provided, and returns $this
     * 
     * @since 2.0.0
     */
    public function offsetGet($offset)
    {
        $this->row = $offset;
        return $this;
    }

    /**
     * Required functions for the interface, but they don't do anything
     * 
     * @since 2.0.0
     */
    public function offsetSet($offset, $value) { return $this; }
    public function offsetUnset($offset) { return $this; }

    /**
     * Access a value in the currently selected row
     * 
     * @param string $column The name of the column to get the value of
     * 
     * @since 2.0.0
     * 
     * @return mixed
     */
    public function __get($name)
    {
        if(isset($this->result[$this->row][$name])) {
            return $this->result[$this->row][$name];
        } else {
            return null;
        }
    }

    /**
     * Gets the current row
     * 
     * @since 2.0.0
     * 
     * @return int
     */
    public function current() 
    {
        return $this;
    }

    /**
     * Gets the key
     * 
     * @since 2.0.0
     * 
     * @return $this
     */
    public function key()
    {
        return $this;
    }

    /**
     * Next row
     * 
     * @since 2.0.0
     * 
     * @return void
     */
    public function next()
    {
        $this->row++;
    }

    /**
     * Rewinds the iterator
     * 
     * @since 2.0.0
     */
    public function rewind()
    {
        $this->row = 0;
    }

    /**
     * Checks if a row is valid
     * 
     * @since 2.0.0
     */
    public function valid()
    {
        return isset($this->result[$this->row]);
    }

    /**
     * Whether the query resulted in an usable result
     * 
     * @since 2.0.0
     * 
     * @return bool
     */
    public function hasResult() {
        return $this->success;
    }


}