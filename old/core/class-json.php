<?php
/**
 * Parses JSON from a file to this object
 * 
 * @since 1.0.0
 */
class PH_JSON {

    protected $array;

    /**
     * @param string $file_path The path to the file to read. If you want to read from string, set to null.
     * @param string $string    The JSON string. If you want to read from string, set $file_path to null.
     */
    public function __construct($file_path, $string = null)
    {   

        $str = null;

        if($file_path) {

            if(file_exists($file_path)) {

                $str = file_get_contents($file_path);

            } else {
                throw new Exception("The file ". $file_path . "doesn't exist.");
            }

        } elseif(!$file_path && $string) {
            $str = $string;
        } else {
            throw new Exception("PH_JSON requires either a file path OR a string.");
        }

        $json = json_decode($str);

        if($json) {
            $this->array = $json;
        } else {
            throw new Exception("Invalid json: " . $str);
        }
    }

    /**
     * Checks whether an item exists
     * 
     * @since 1.0.0
     */
    public function checkSet() {
        $vars = func_get_args();

        $curr_level = $this->array;

        $going = true;

        foreach ($vars as $var) {
            if(isset($curr_level->$var)) {
                $curr_level = $curr_level->$var;
            } else $going = false;
        }

        return $going;
    }

    /**
     * Gets an item from the json object
     * 
     * @since 1.0.0
     */
    public function get() {
        return $this->array;
    }

}