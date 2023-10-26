<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 namespace Controllers;
 use \Core\Controller;


class ContratoController extends Controller{
    
    
     public function index() {

        $viewData = array();

        if (!isset($_SESSION['idColaboradores']) && empty($_SESSION['idColaboradores'])) {


            $this->loadTemplate("home", $viewData);
        } else {



            $this->loadTemplateLoginCompany("contrato", $viewData);
        }
    }


    public function recuperarContrato($idCliente, $idVendedor){


        
        //echo $idCliente;
       // echo $idVendedor;



         //Gera o contrato em PDF 
         $viewData['id'] = $idCliente;
         $viewData['idVendedor']  = $idVendedor;
 
 
        
 //Recuperar o contrato
    $this->loadView("contrato",$viewData);
 
       
         
       
      

        
    }
    
    
    
    
    
}