<?php
/**
 * Index controller
 * 
 * @since 2.0.0
 */
class Twenties_Index {

    public function index($params) {
        
        $template = PH_Loader::requestTemplate('index');

        return $template;

    }

}

return new PH_Export('Twenties_Index', [
    'class' => 'Twenties_Index'
]);