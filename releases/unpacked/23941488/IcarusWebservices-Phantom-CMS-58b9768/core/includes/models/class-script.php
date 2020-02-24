<?php
/**
 * Requested script
 * 
 * Can be used within the HOOK_QUEUE_JAVASCRIPT hook
 */
class PH_Requested_Script {

    /**
     * Constructor 
     */
    public function __construct($source = null, $js_body = null, $xtra = null)
    {
        $this->source = $source;
        $this->js_body = $js_body;
        $this->extra_attb = $xtra;
    }

    /**
     * Extra attribute raw html
     */
    public $extra_attb = null;

    /**
     * The source of the javascript.
     * 
     * If null, will use javascript body set in $this->js_body
     * 
     * @since 2.0.0
     */
    public $source = null;

    /**
     * JS Body, only used if $this->source is null
     * 
     * @since 2.0.0
     */
    public $js_body = null;

    public function render() {
        if(!$this->source && var_check(TYPE_STRING, $this->js_body)) {
            ?>
            <script <?= $this->extra_attb ?>><?= $this->js_body ?></script>
            <?php
        } else if($this->source) {
            ?>
            <script src="<?= $this->source ?>" <?= $this->extra_attb ?>></script>
            <?php
        }
        
    }

}