<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Controllers;
use \Core\Controller;
use \Models\DependentesExtras;

class DependentesExtrasController extends Controller{
    
    
    
      public function index() {

        $viewData = array();

        if (!isset($_SESSION['idColaboradores']) && empty($_SESSION['idColaboradores'])) {


            $this->loadTemplate("home", $viewData);
        } else {



            $this->loadTemplateLoginCompany("dependentesExtras", $viewData);
        }
    }
    
    
    
    
    public function cadastrar(){




        $quantidadeMaxima = $_POST['quantidadeMaxima'];
        $preco = str_replace(",",".",$_POST['preco']);



        $dependenteExtra = new DependentesExtras();
        $cadastrado = $dependenteExtra->cadastrar($quantidadeMaxima, $preco, $_SESSION['idEmpresa'] );

        if($cadastrado){

            $viewData['mensagem'] = "Dependente extras configurado com sucesso!";
            
            $this->loadTemplateLoginCompany("dependentesExtras", $viewData);


        }else{

            $viewData['mensagem'] = "Erro ao cadastrar dependentes extras!";

            $this->loadTemplateLoginCompany("dependentesExtras", $viewData);


        }


    }


    public function atualizar(){


        $idDependenteExtra =  addslashes($_POST['idDependenteExtra']);
        $quantidadeMaximaAtualizar = addslashes($_POST['quantidadeMaximaAtualizar']);
        $precoAtualizar = addslashes(str_replace(",",".",$_POST['precoAtualizar']));


        $dependenteExtra = new DependentesExtras();
        $atualizar = $dependenteExtra->atualizar($idDependenteExtra,$quantidadeMaximaAtualizar, $precoAtualizar, $_SESSION['idEmpresa']);

        if($atualizar){

            $viewData['mensagem'] = "Dependentes extras atualizado com suceso!";
            
            $this->loadTemplateLoginCompany("dependentesExtras", $viewData);


        }else{

            $viewData['mensagem'] = "Erro ao  atualizar dependentes extras!";

            $this->loadTemplateLoginCompany("dependentesExtras", $viewData);


        }




    }
    

}



