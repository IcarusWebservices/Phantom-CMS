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
     * An array containing the so-called "expected hooks", hooks that
     * are native to Phantom
     * 
     * @since 2.0.0
     */
    protected $expected_hooks = [
        'global_registry_setup', // Called when the global registry has been set up
        
    ];

    /**
     * Adds a hook to this hook manager
     * 
     * @param string $hookname  The name of the hook to register.
     * @param callback $hook    A function to execute when the hook is called.
     * 
     * @since 2.0.0
     * 
     * @return void
     */
    public function addHook($hookname, $hook) {
        if(var_check(TYPE_FUNCTION, $hook)) {
            if(var_check(TYPE_ARRAY, $this->hooks)) {
                if(isset($this->hooks[$hookname])) {
                    if(var_check(TYPE_ARRAY, $this->hooks[$hookname])) {
                        arr($this->hooks[$hookname])->push($hook);
                    } else {
                        $this->hooks[$hookname] = arr([$hook]);
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
    public function doHook($hookname, $arguments) {
        if(isset($this->hooks[$hookname])) {
            if(var_check(TYPE_ARRAY, $this->hooks[$hookname])) {
                $a = arr($this->hooks[$hookname]);

                if($a->hasItems()) {
                    foreach ($a as $hook) {
                        if(var_check(TYPE_FUNCTION, $hook)) {
                            $hook($arguments);
                        }
                    }
                }
            }
        }
    }

}