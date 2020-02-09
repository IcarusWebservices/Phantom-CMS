<?php
/**
 * Represents a browser session.
 * 
 * Primarely stores the logged-in user
 * 
 * @since 2.0.0
 *
 */
class PH_Session {

    /**
     * The logged-in user
     * 
     * @since 2.0.0
     */
    public $user;

    /**
     * Sets a user the logged-in user
     * 
     * @param PH_User $user The user to set
     * 
     * @return void
     * 
     * @since 2.0.0
     */
    public function setUser($user) {
        $this->user = $user;

        $this->setVar( "username", $user->username );
        $this->setVar( "password", $user->password );
    }

    /**
     * Sets a session variable
     * 
     * @param string $name The name of the variable
     * 
     * @param mixed $value The value to set.
     * 
     * @since 2.0.0
     */
    public function setVar($name, $value) {
        $_SESSION[$name] = $value;
    }

    /**
     * Returns a session variable
     * 
     * @param string $name The name of the variable
     * 
     * @since 2.0.0
     */
    public function getVar($name) {
        if(isset($_SESSION[$name])) return $_SESSION[$name];
        else return null;
    }

    /**
     * Whether a list of session vars have been set
     * 
     * @since 2.0.0
     */
    public function issetVars() {
        global $request;

        $args = func_get_args();

        $found_all = true;

        foreach ($args as $arg) {
            if($found_all) {
                if( !isset($_SESSION[$arg]) ) {
                    $found_all = false;
                }
            }
        }

        return $found_all;
    }

}