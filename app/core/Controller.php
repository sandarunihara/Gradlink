<?php
    Trait Controller{
        public function view($name, $data =[]){
            if (!empty($data))
                extract($data);
            $filename ="../app/views/".$name.".view.php";
            
            if(file_exists($filename)){
                require $filename;
            }else{
                $filename ="../app/views/404.view.php";
                require $filename;
            }
        }

        public function renderComponent($componentName, $componentProps = []){
            $fileName = "../app/views/components/" . $componentName . ".view.php";
            if (file_exists($fileName)) {
                require $fileName;
            } else {
                echo "Component not found";
            }
        }
    }