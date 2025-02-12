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
            $fileName = "../app/views/Components/" . $componentName . ".view.php";
            if (file_exists($fileName)) {
                extract($componentProps);
                require $fileName;
            } else {
                echo "Component not found";
            }
        }

        public function renderPDC_adminTabs($tabname, $tabprops = []){
            $fileName = "../app/views/PDC_admin/Tabs/" . $tabname . ".view.php";
            if (file_exists($fileName)) {
                require $fileName;
            } else {
                echo "Tab not found";
            }
        }

    }