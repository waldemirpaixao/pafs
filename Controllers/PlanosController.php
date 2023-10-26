<?php

namespace Controllers;

use \Core\Controller;
use \Models\Planos;
use Models\Plano_has_complementoPlano;

class planosController extends Controller {

    public function index() {

        $viewData = array();

        if (!isset($_SESSION['idColaboradores']) && empty($_SESSION['idColaboradores'])) {


            $this->loadTemplate("home", $viewData);
        } else {



            $this->loadTemplateLoginCompany("planos", $viewData);
        }
    }

    public function atualizarPlanos() {


        $viewData['idPlanos'] = $_GET['id']; //esse id vai para o banco de dados



        $this->loadTemplateLoginCompany("atualizarPlanos", $viewData);
    }

    public function atualizar() {


        $idPlanos = addslashes($_POST['idPlanos']);
        $nomePlanos = addslashes($_POST['nomePlano']);
        $valorPlanos = addslashes(str_replace(",",".",$_POST['valorPlano']));
        $descricao = addslashes($_POST['descricao']);
        $comissaoPlanos = addslashes($_POST['comissaoPlano']);

        $idComplemento = $_POST['comSemSeguro'][0];

       
        $planos = new Planos();
        $viewData['mensagem'] = $planos->atualizar($nomePlanos, $valorPlanos, $comissaoPlanos, $idPlanos,$_SESSION['idEmpresa'],$descricao);
        $viewData['idPlanos'] = $idPlanos;



        //Plano_has_complementoPlano
        if($viewData['mensagem'] == "Atualizado com sucesso!"){


            $plano_has_complementoPlano = new Plano_has_complementoPlano();
            $plano_has_complementoPlano->atualizar($idPlanos, $idComplemento,$_SESSION['idEmpresa']);


        }

        // $this->loadTemplateLoginCompany("planos", $viewData);



        $this->loadTemplateLoginCompany("atualizarPlanos", $viewData);
    }

    public function registerPlanos() {




        $nomePlanos = addslashes($_POST['nomePlano']);
        $valorPlanos = addslashes(str_replace(",",".",$_POST['valorPlano']));
        $descricao = addslashes($_POST['descricao']);
        $comissaoPlanos = addslashes($_POST['comissaoPlano']);
        $comSemSeguro = $_POST['comSemSeguro'];
        
        $planos = new Planos();
        
        if($planos->checkPlano($nomePlanos)){

              
             $viewData['mensagem'] = "Plano já cadastrado!";
             
               $this->loadTemplateLoginCompany("planos", $viewData);
            
            
         }else{
        if (isset($_POST['comSemSeguro']) && !empty($_POST['comSemSeguro'])) {

            
            $viewData['mensagem'] = $planos->inserir($nomePlanos, $valorPlanos, $comissaoPlanos, $_SESSION['idEmpresa'],  $comSemSeguro, $descricao);

            $this->loadTemplateLoginCompany("planos", $viewData);
        } else {
            
             $viewData['mensagem'] = "Não foi possível salvar";
             
               $this->loadTemplateLoginCompany("planos", $viewData);
            
        }
       
            
            
            
            
        }
    }

    public function deletarPlanos() {


        $idPlanos = $_GET['id'];

        $deletar = new Planos();
        $viewData['mensagem'] = $deletar->deletar($idPlanos);

        $this->loadTemplateLoginCompany("planos", $viewData);
    }
    
    
    
    /*Ajax*/
    
    public function getPlanoJSON($id){
       
      // $id = $_GET;
        
      $array = array();
        
        $planos = new Planos();
        
        $array = $planos->getPlanosByIdJSON($id);
        
        
        echo json_encode($array);
        
        
    }


}
