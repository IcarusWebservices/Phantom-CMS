<?php
/**
 * Contains the data of a queried record from the database
 * 
 * @since 1.0.0
 */
class PH_Record {

    // The ID of the record
    public $id;

    // The name of the data type of the record
    public $data_type_name;

    // The instantiated datatype controller
    protected $data_type_controller;

    // Whether the data type is a correct type
    public $data_type_exists;

    // The unparsed content
    public $unparsed_content;

    // The parsed content
    public $parsed_content;

    // The slug of the record (Can be null)
    public $slug;

    // When the record was created
    public $created_at;

    // When the record was last updated (Can be null if the record has never been updated)
    public $updated_at;

    // The ID of the user that created the record (Can be null if the record was not specifically created by an user)
    public $created_by_user;

    // The title of the record
    public $title;

    // The project of the record
    public $project;

    // The constructor method
    public function __construct($id, $data_type, $slug = null, $content, $created_at, $updated_at = null, $created_by_user = null, $title = null, $project = null)
    {
        $this->id = $id;
        $this->data_type_name = $data_type;
        $this->slug = $slug;
        $this->unparsed_content = $content;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->created_by_user = $created_by_user;
        $this->title = $title;
        $this->project = $project;

        $c_class_name = ph_get_registered_item("@this", "datatypes", $this->data_type_name);

        if($c_class_name) {
            $c_class_name = $c_class_name["class"];
            if(class_exists($c_class_name) && ph_check_class_inherits($c_class_name, "PH_Data_Type")) {

                $controller = new $c_class_name;

                $this->data_type_controller = $controller;
                $this->data_type_exists = true;

                $this->process_content();

            } else {
                $this->data_type_exists = false;
            }
        } else {
            $this->data_type_exists = false;
        }
    }

    // Proccesses the content into an array.
    // Only works if a data_type_controller is defined
    protected function process_content() {
        if($this->data_type_controller) {
            $unparsed_content = $this->unparsed_content;
            $controller = $this->data_type_controller;

            $parsed = $controller->process_content($unparsed_content);

            $this->parsed_content = $parsed;
        }
    }

}
