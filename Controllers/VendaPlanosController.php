<?php


namespace Controllers;

use \Core\Controller;
use Models\Venda;

class VendaPlanosController extends Controller {

    public function index() {

        $viewData = array();

        if (!isset($_SESSION['idColaboradores']) && empty($_SESSION['idColaboradores'])) {


            $this->loadTemplate("home", $viewData);
        } else {



            $this->loadTemplateLoginCompany("vendaPlanos", $viewData);
        }
    }




    //AJAX
    public function getVendaByIdClinte($idCliente){


        $retorno = [];

        $venda = new Venda();
        $retorno['vendaCliente'] = $venda->getVendaByIdClinte($idCliente);

        if(isset($retorno['vendaCliente'])){



            $retorno['status'] = "OK";

            echo json_encode($retorno['vendaCliente']);



        }else{



            $retorno['status'] = "NOTOK";

            echo json_encode($retorno['vendaCliente']);

        }
        

    }

   

}
