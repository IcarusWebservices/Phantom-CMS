<?php
/**
 * The class managing the session
 * 
 * @since 1.0.0
 */
class PH_Session {

    /**
     * Returns a value from the session
     * 
     * @param string $name The name of the session variable
     * 
     * @since 1.0.0
     * 
     * @return mixed The value
     */
    public function get($name) {
        if(isset($_SESSION[$name])) {
            return $_SESSION[$name];
        }
    }

    /**
     * Checks if a session value is set
     * 
     * @param string $name The name of the session variable
     * 
     * @since 1.0.0
     */
    public function isset($name) {
        return isset($_SESSION[$name]);
    }

    /**
     * Sets a value in the session
     * 
     * @param string $name The name (or key) to register the value to
     * @param mixed $value The value to register to the session
     * 
     * @since 1.0.0
     * 
     * @return void
     */
    public function set($name, $mixed) {
        $_SESSION[$name] = $mixed;
    }

    /**
     * The logged-in user
     * 
     * @since 1.0.0
     */
    public $user;

    /**
     * Whether the session is a Guest user or a LoggedIn user
     * 
     * @since 1.0.0
     */
    public $is_logged_in = false;

    /**
     * Authorizes a user, but does not actually set the session to this user.
     * 
     * Returns a PH_User object.
     * 
     * @since 1.0.0
     * 
     * @return PH_User
     */
    public function authorizeUserByPassword($username, $password) {
        
        $user = PH_Query::get_user_by_username($username);

        if($user) {

            $r = password_verify($password, $user->hashed_password);

            if($r) {

                return $user;

            } else {
                return false;
            }

        } else {
            return false;
        }

    }

    /**
     * Sets the logged in user.
     * 
     * Also switches the session mode from Guest to LoggedIn
     * 
     * @param PH_User $user             The user to set as the logged in user
     * @param string $true_password     The non-hashed password, so that the session variables can be set.
     * 
     * @since 1.0.0
     */
    public function setUser($user, $true_password) {
        $this->user = $user;
        $this->is_logged_in = true;

        $this->set("username", $user->username);
        $this->set("password", $true_password);
    }

}