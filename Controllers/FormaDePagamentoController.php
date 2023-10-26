<?php

namespace Controllers;

use Core\Controller;
use \Models\FormaDePagamento;

class FormaDePagamentoController extends Controller
{



    private $viewData = array();

    public function index()
    {



        if (!isset($_SESSION['idColaboradores']) && empty($_SESSION['idColaboradores'])) {


            $this->loadTemplate("home", $this->viewData);
        } else {



            $this->loadTemplateLoginCompany("formaDePagamento", $this->viewData);
        }
    }




    public function cadastrar()
    {


        $formaPagamento = addslashes($_POST['formaPagamento']);

        $formDePagamento = new FormaDePagamento();


        $checado = $formDePagamento->checkFormaDePagamento($formaPagamento, $_SESSION['idEmpresa']);

        if (!$checado) {
            $inserido = $formDePagamento->inserir($formaPagamento, $_SESSION['idEmpresa']);


            if ($inserido) {
                $this->viewData['mensagem'] = "Salvo com sucesso!";

                $this->loadTemplateLoginCompany("formaDePagamento", $this->viewData);
            } else {


                $this->viewData['mensagem'] = "Não foi possivel salvar!";
                $this->loadTemplateLoginCompany("formaDePagamento", $this->viewData);
            }
        } else {

            $this->viewData['mensagem'] = "Forma de pagamento já cadastrada!";
            $this->loadTemplateLoginCompany("formaDePagamento", $this->viewData);
        }
    }
}
