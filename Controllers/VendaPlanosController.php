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

            // Implementar paginação
            $itensPorPagina = 10; // Número de itens por página
            $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
            if ($pagina < 1) $pagina = 1;

            $cliente = new \Models\Clientes();
            $totalClientes = $cliente->getTotalClientes($_SESSION['idEmpresa']); // Assumindo que existe este método
            $totalPaginas = ceil($totalClientes / $itensPorPagina);

            if ($pagina > $totalPaginas) $pagina = $totalPaginas;

            $allClient = $cliente->getClientePorPagina($pagina, $itensPorPagina, $_SESSION['idEmpresa']);

            $viewData['allClient'] = $allClient;
            $viewData['pagina'] = $pagina;
            $viewData['totalPaginas'] = $totalPaginas;

            $this->loadTemplateLoginCompany("vendaPlanos", $viewData);
        }
    }

    public function pagina($pagina = 1) {
        // Redirecionar para index com parâmetro GET
        header("Location: " . BASE_URL . "VendaPlanos?pagina=" . $pagina);
        exit;
    }




    //AJAX
    public function getVendaByIdClinte($idCliente){


        $retorno = [];

        $venda = new Venda();
        $retorno['vendaCliente'] = $venda->getVendaByIdCliente($idCliente);

        if(isset($retorno['vendaCliente'])){



            $retorno['status'] = "OK";

            echo json_encode($retorno['vendaCliente']);



        }else{



            $retorno['status'] = "NOTOK";

            echo json_encode($retorno['vendaCliente']);

        }
        

    }

   

}
