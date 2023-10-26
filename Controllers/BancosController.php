<?php

namespace Controllers;
use Core\Controller;
use Models\Bancos;
use \Models\FormaDePagamento;

class BancosController extends Controller{

    //Array
    private $viewData = array();
   
    public function index() {

       

        if (!isset($_SESSION['idColaboradores']) && empty($_SESSION['idColaboradores'])) {


            $this->loadTemplate("home", $this->viewData);
        } else {



            $this->loadTemplateLoginCompany("bancos", $this->viewData);
        }
    }




    public function cadastrar(){


        $nomeBanco = addslashes($_POST['nomeBanco']);




        $bancos = new Bancos();

        $checkBanco = $bancos->checkBanco($nomeBanco, $_SESSION['idEmpresa']);
        if(!$checkBanco){
        $inserido = $bancos->inserir($nomeBanco, $_SESSION['idEmpresa']);


        if($inserido){
            $this->viewData['mensagem'] = "Salvo com sucesso!";

            $this->loadTemplateLoginCompany("bancos", $this->viewData);

        }else{


            $this->viewData['mensagem'] = "Não foi possivel salvar!";
            $this->loadTemplateLoginCompany("bancos", $this->viewData);

        }
    }else{


        $this->viewData['mensagem'] = "Banco já Cadastrado!";
        $this->loadTemplateLoginCompany("bancos", $this->viewData);

    }


    }


}