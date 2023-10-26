<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of controller
 *
 * @author waldemir
 */

 namespace Core;

 
class Controller {
   public function loadView($viewName, $viewData = array()){
       
       extract($viewData);
       
       require 'Views/'.$viewName.'.php';
   }
   
   public function loadTemplate($viewName, $viewData = array()){
        
       
       require 'Views/template.php';
   }
   
   
    public function loadTemplateChat($viewName, $viewData = array()){
        extract($viewData);
       
       require 'views/templateChat.php';
   }
   
   public function loadTemplateChatCompany($viewName, $viewData = array()){
        extract($viewData);
       
       require 'Views/templateChatCompany.php';
   }
   
   
    public function loadTemplateLogin($viewName, $viewData = array()){
     
        extract($viewData);
       
       require 'Views/templatelogin.php';
   }
   
     public function loadTemplateLoginCompany($viewName, $viewData = array()){
         extract($viewData);
       
       require 'Views/templatelogincompany.php';
   }
   
   public function loadViewInTemplate($viewName, $viewData = array()){
       
       extract($viewData);
       
        require 'Views/'.$viewName.'.php';
   }
}


