<?php 
namespace Controllers;

use Core\Controller;

class atualizarFormularioVendaPlanosController extends Controller{



      //Array
      private $viewData = array();
   
      public function index() {
  
         
  
          if (!isset($_SESSION['idColaboradores']) && empty($_SESSION['idColaboradores'])) {
  
  
              $this->loadTemplate("home", $this->viewData);
          } else {
  
  
  
              $this->loadTemplateLoginCompany("atualizarFormularioVendaPlanos", $this->viewData);
          }
      }



    public function atualizarVenda(){


        



    }

}