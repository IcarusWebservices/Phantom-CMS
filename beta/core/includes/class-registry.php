<?php
/**
 * A place to store key-value pairs
 * 
 * @since 2.0.0
 */
class PH_Registry {

    /**
     * The registry array
     * 
     * @since 2.0.0
     */
    protected $registry;

    /**
     * Registers an item to the registry, of the type export
     * 
     * @param string $category  The category of the item.
     *                          This is most likely the type of item that you're registering, like "record-type" or "controller"
     * 
     * @param string $slug      The slug of the item that you're registering.
     *                          This slug must be unique, and is used to reference to the item
     * 
     * @param PH_Export $value  The export item that you are registering
     * 
     * @since 2.0.0
     * 
     * @return void
     */
    public function registerExport($category, $export) {
        if(var_instanceof($export, "PH_Export")) {
            if(isset($this->registry[$category])) {
                if(var_check(TYPE_ARRAY, $this->registry[$category])) {
                    $this->registry[$category][$export->name] = $export;
                } else {
                    $this->registry[$category] = [
                        $export->name => $export
                    ];
                }
            } else {
                $this->registry[$category] = [
                    $export->name => $export
                ];
            }
        } else {
            logger()->log('Registry: trying to register item not of type PH_Export');
        }
    }

    /**
     * Registers any type of item to the registry
     * 
     * @param string $category  The category of the item.
     *                          This is most likely the type of item that you're registering, like "record-type" or "controller"
     * 
     * @param string $slug      The slug of the item that you're registering.
     *                          This slug must be unique, and is used to reference to the item
     * 
     * @param mixed $value      The item that you are registering
     * 
     * @since 2.0.0
     * 
     * @return void
     */
    public function register($category, $slug, $value) {
        if(isset($this->registry[$category])) {
            if(var_check(TYPE_ARRAY, $this->registry[$category])) {
                $this->registry[$category][$slug] = $value;
            } else {
                $this->registry[$category] = [
                    $slug => $value
                ];
            }
        } else {
            $this->registry[$category] = [
                $slug => $value
            ];
        }
    }

    /**
     * Gets an item from the registry based on category and slug
     * 
     * @param string $category  The category of the item
     * @param string $slug      The slug of the item
     * 
     * @since 2.0.0
     * 
     * @return mixed
     */
    public function get($category, $slug) {
        if(isset($this->registry[$category][$slug])) {
            return $this->registry[$category][$slug];
        } else {
            return null;
        }
    }

    /**
     * Checks whether the registry has a specific registered item
     * 
     * @param string $category  The category of the item
     * @param string $slug      The slug of the item.
     * 
     * @since 2.0.0
     * 
     * @return bool
     */
    public function has($category, $slug) {
        return isset($this->registry[$category][$slug]);
    }

}