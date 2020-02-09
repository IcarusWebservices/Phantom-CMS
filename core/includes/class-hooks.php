<?php
/**
 * Contains registered hooks, that execute at specific points during execution
 * 
 * @since 2.0.0
 */
class PH_Hooks {

    /**
     * An array containing the hooks
     * 
     * @since 2.0.0
     */
    protected $hooks = [];

    /**
     * Adds a hook to this hook manager
     * 
     * @param string $hookname  The name of the hook to register.
     * @param callback $hook    A function to execute when the hook is called.
     * @param array $pass_parameters    Parameters to pass to the hook function on call
     * 
     * @since 2.0.0
     * 
     * @return void
     */
    public function addHook($hookname, $hook, $pass_parameters = []) {
        if(var_check(TYPE_FUNCTION, $hook)) {
            if(var_check(TYPE_ARRAY, $this->hooks)) {
                if(isset($this->hooks[$hookname])) {
                    if(var_check(TYPE_ARRAY, $this->hooks[$hookname])) {
                        array_push($this->hooks[$hookname], [
                            "function" => $hook,
                            "parameters" => $pass_parameters
                        ]);
                    } else {
                        $this->hooks[$hookname] = [$hook];
                    }
                }
            }
        }
    }

    /**
     * Executes a hook
     * 
     * @since 2.0.0
     */
    public function doHook($hookname, $arguments = []) {
        if(isset($this->hooks[$hookname])) {
            if(var_check(TYPE_ARRAY, $this->hooks[$hookname])) {
                $a = $this->hooks[$hookname];

                if(count($a) > 0) {
                    foreach ($a as $hook) {
                        if(var_check(TYPE_FUNCTION, $hook["function"])) {
                            $pars = $arguments;
                            if(var_check(TYPE_ARRAY, $hook["parameters"])) {
                                $pars = array_merge($pars, $hook["parameters"]);
                            }
                            $hook["function"]($pars);
                        }
                    }
                }
            }
        }
    }

}