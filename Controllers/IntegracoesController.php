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

        $idEmpresa = addslashes($_POST['idEmpresa']);
        $nomeDoBanco = addslashes($_POST['nomeDoBanco']);
        $chave = addslashes($_POST['chave']);


        $integracoes = new Integracoes();


        if ($integracoes->checKIntegracao($idEmpresa, $nomeDoBanco, $chave)) {
            $this->viewData['mensagem'] = "Chave já cadastrada!";
            $this->loadTemplateLoginCompany("integracoes", $this->viewData);
            return;
        } else {

            $inserido = $integracoes->inserir($idEmpresa, $nomeDoBanco, $chave);


            if ($inserido) {
                $this->viewData['mensagem'] = "Salvo com sucesso!";
                $this->loadTemplateLoginCompany("integracoes", $this->viewData);
            } else {
                $this->viewData['mensagem'] = "Erro ao cadastrar!";
                $this->loadTemplateLoginCompany("integracoes", $this->viewData);
            }
        }
    }
}
