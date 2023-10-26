<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Core
 *
 * @author waldemir
 */

 namespace Core;
 
class Core {

    public function run() {

        $url = '/';

        $params = array();
        if (isset($_GET['url'])) {

            $url .= $_GET['url'];
        }

        if (!empty($url) && $url != '/') {

            $url = explode('/', $url);

            array_shift($url);

            $currentController = $url[0] . 'Controller';
            array_shift($url);

            if (isset($url[0]) && !empty($url[0])) {
                $currentAction = $url[0];
                array_shift($url);
            } else {
                $currentAction = 'index';
            }


            if (count($url) > 0) {
                $params = $url;
            }
        } else {


            $currentController = 'HomeController';
            $currentAction = 'index';

        
        }


      

        $currentController = ucfirst($currentController);//transformar a primeira letra para maiúscula
      
        
     
        $prefix = '\Controllers\\';


        

       if(!file_exists('Controllers/'.$currentController.".php") || !method_exists($prefix.$currentController,$currentAction)){

            $currentController = "NotFoundController";
            $currentAction = 'index';
        }


        $newController = $prefix.$currentController;
        $controller = new $newController();



   
      call_user_func_array(array($controller, $currentAction), $params);
     // call_user_func(array($controller, $currentAction), $params);
     
      
    }


    

}


