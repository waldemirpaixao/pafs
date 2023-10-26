<?php


namespace Controllers;
use \Core\Controller;
use \Models\Vendedor;

class VendedoresController extends Controller {

    public function index() {

        $viewData = array();

        if (!isset($_SESSION['idColaboradores']) && empty($_SESSION['idColaboradores'])) {


            $this->loadTemplate("home", $viewData);
        } else {



            $this->loadTemplateLoginCompany("vendedor", $viewData);
        }
    }

    public function inserirVendedores() {


        $nomeVendedores = addslashes($_POST['nomeVendedor']);
        $telefoneVendedores = addslashes($_POST['telefoneVendedor']);
        $emailVendedores = addslashes($_POST['emailVendedor']);
        $assinaturaDigitalVendedor = md5($nomeVendedores);

        $vendedor = new Vendedor();
        if ($vendedor->checkTelefone($telefoneVendedores)) {


            $viewData['mensagem'] = "Vendedor Já Cadastrado";
            $this->loadTemplateLoginCompany("vendedor", $viewData);
            
        } else {

           
            $viewData['mensagem'] = $vendedor->inserir($nomeVendedores, $telefoneVendedores, $emailVendedores, $_SESSION['idEmpresa'],$assinaturaDigitalVendedor);
            $this->loadTemplateLoginCompany("vendedor", $viewData);
        }
    }
    
    public function atualizarVendedores() {



        $viewData['id'] = $_GET['id'];





        $this->loadTemplateLoginCompany("atualizarVendedores", $viewData);
    }

    public function atualizarVendedor() {


        $nomeVendedores = addslashes($_POST['nomeVendedor']);
        $telefoneVendedores = addslashes($_POST['telefoneVendedor']);
        $emailVendedores = addslashes($_POST['emailVendedor']);
        $id = addslashes($_POST['id']);

        $venda = new Vendedor();
        $viewData['mensagem'] = $venda->atualizar($nomeVendedores, $telefoneVendedores, $emailVendedores, $id);
        $viewData['id'] = $id;




        $this->loadTemplateLoginCompany("atualizarVendedores", $viewData);
    }

    public function deletarVendedores() {


        $id = $_GET['id'];


        $vendedor = new Vendedor();

        $viewData['mensagem'] = $vendedor->delete($id);


        $this->loadTemplateLoginCompany("vendedor", $viewData);
    }

    public function getAssinaturaVendedores(){

        $idVendedores = addslashes($_GET['idVendedores']);


        $vendedor = new Vendedor();
        $vendedoresArray['vendedores'] = $vendedor->getVendedorById($idVendedores);

        if(isset($vendedoresArray)){

            $vendedoresArray['status'] = "OK";
            echo json_encode($vendedoresArray);

        }else{

            $vendedoresArray['status'] = "NOTOK";

            echo json_encode($vendedoresArray);


        }


      
    }

}
