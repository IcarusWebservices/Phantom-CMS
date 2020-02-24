# Controller
_A controller is the primary part of a logic pack. It's primary function is to handle a route, defined in `logic-pack.json`, and return a template to be rendered._
- - -
## How to create a controller
- In your logic pack, create a new file in the `controllers` folder. The name of the file does not neccesarely matter, but pick something that has got to do with the controller, like `page_controller.php`.
- In this file, create a class that extends `PH_Controller`. In this case we are going to call it `Example_PageController`. Make sure to name it something **unique**, since you do not want other logic packs to have a class with the same name. Just to make sure however, create an if statement with `!class_exists("classname")` to check if the class already exists, just in case.
    ```php
    <?php
    if(!class_exists("Example_PageController")) {
        class Example_PageController extends PH_Controller {
            
        }
    }
    ?>
    ```
- Now create an export for this class, so it can be used by Phantom. To do this, return an `PH_Export` object in the global scope. The first parameter is the slug of the controller, which is used to refer to this controller and must also be unique (it does not technically have to be named the same as the class, but it is less confusing to name it after the class). The second parameter is an array, which must contain some properties (see Export Properties). In this case we're only going to set the property class, which must be the name of the controller class.
    ```php
    <?php
    if(!class_exists("Example_PageController")) {
        class Example_PageController extends PH_Controller {
            
        }
    }
    
    return new PH_Export("Example_PageController", [
        "class" => "Example_PageController"
    ]);
    ?>
    ```
- Now we need to create method, so it can be used by a route. We are going to create a method named `page`, which takes one argument, `parameters`.
    ```php
    <?php
    if(!class_exists("Example_PageController")) {
        class Example_PageController extends PH_Controller {
            
            public function page($parameters) {
                
            }
            
        }
    }
    
    return new PH_Export("Example_PageController", [
        "class" => "Example_PageController"
    ]);
    ?>
    ```
- (The following steps all take place within the `page()` method).
    Next we are going to get a template from the theme. Because themes and logic-packs are seperate, there is a chance that a template does not exists. To increase the likelyhood of a template existing, choose a recommended template name like `page`. If the template does then still not exist, create a fallback option with `simulated_template()`.
    ```php
    $template = PH_Loader::requestTemplate("page");
    
    if(!$template) {
        $template = simulated_template( function($data) {
            ?>
            <h1><?= $data->title ?>
            <p>
                <?= $data->content ?>
            </p>
            <?php
        });
    }
    ```
- Next we are going to assign data to the template. Although in most cases you would likely need data from the database, we are going to make a seperate tutorial for that. For now, we are going to hard-code the data.
    ```php
    ...
    $template->assignData([
        "title" => "About",
        "content" => "Welcome to my amazing page!"
    ]);
    ```
- Finally return the template
    ```php
    ...
    return $template;    
    ```
    
- And voila, you have created a controller. Here is the final result as it should be:
    ```php
     <?php
    if(!class_exists("Example_PageController")) {
        class Example_PageController extends PH_Controller {
            
            public function page($parameters) {
                 $template = PH_Loader::requestTemplate("page");
    
                if(!$template) {
                    $template = simulated_template( function($data) {
                        ?>
                        <h1><?= $data->title ?>
                        <p>
                            <?= $data->content ?>
                        </p>
                        <?php
                    });
                }
                
                $template->assignData([
                    "title" => "About",
                    "content" => "Welcome to my amazing page!"
                ]);
                
                return $template;
            }
            
        }
    }
    
    return new PH_Export("Example_PageController", [
        "class" => "Example_PageController"
    ]);
    ?>
    ```
## Example
`ExampleController.php`
```php
<?php
if(!class_exists("ExampleController")) {
    class ExampleController extends PH_Controller {
    
        public function index($parameters) {
            $template = PH_Loader::requestTemplate("page");
            // Assign data to the template, so it can be filled in.
            $template->assignData([
                "title" => "My amazing page"
            ]);
            
            return $template;
        }
        
    }
    
    return new PH_Export("ExampleController", [
        "class" => "ExampleClass"
    ]);
}

?>
```

## Export Properties
| Property Name | Required? | Type | Explanation |
|---|---|---|---|
| class          | Yes       | `string` | The name of the class of the controller |
| checkerFunctions | No      |  `ASSOC array` | Contains functions that routes can call to check if the route parameters are correct for a specific route. For example, if you have a category page, this function can check if the category exists. Format: `(function_name) => (function)`.
