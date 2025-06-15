<?php

namespace Controllers;

use Core\Controller;
use Models\Integracoes;

class IntegracoesController extends Controller
{


    private $viewData = array();


    public function index()
    {



        if (!isset($_SESSION['idColaboradores']) && empty($_SESSION['idColaboradores'])) {


            $this->loadTemplate("home", $this->viewData);
        } else {

            $this->viewData['idEmpresa']  = $_SESSION['idEmpresa'];



            $this->loadTemplateLoginCompany("integracoes", $this->viewData);
        }
    }


    public function cadastrar()
    {

        $idEmpresa = trim(addslashes($_POST['idEmpresa']));
        $nomeDoBanco = trim(addslashes($_POST['nomeBanco']));
        $chave = trim(addslashes($_POST['chave']));


       


        $integracoes = new Integracoes();


        if ($retorno = $integracoes->checKIntegracao($idEmpresa, $nomeDoBanco, $chave)) {
            unset($viewData);
            $this->viewData['mensagem'] = "Chave já cadastrada!";
            
           // $this->loadTemplateLoginCompany("integracoes", $this->viewData);
            //return;
        } else {

            $inserido = $integracoes->inserir($idEmpresa, $nomeDoBanco, $chave);


            if ($inserido) {
                 unset($viewData);
                $this->viewData['mensagem'] = "Salvo com sucesso!";
               // $this->loadTemplateLoginCompany("integracoes", $this->viewData);
            } else {
                 unset($viewData);
                $this->viewData['mensagem'] = "Erro ao salvar!";
                //$this->loadTemplateLoginCompany("integracoes", $this->viewData);
            }
        }


        $this->viewData['retono'] = $retorno;
        $this->loadTemplateLoginCompany("integracoes", $this->viewData);

       
    }
}
