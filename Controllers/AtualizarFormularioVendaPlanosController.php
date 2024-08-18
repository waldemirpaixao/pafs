<?php 
namespace Controllers;

use Core\Controller;
use DateTime;
use Models\Planos;
use Models\Venda;
use Models\Contrato;

class AtualizarFormularioVendaPlanosController extends Controller{



      //Array
      private $viewData = array();
      const CARENCIA = 90;
      private $contratoAtualizado = false;
      private $atualizadaVenda = false;
   
      public function index() {
  
         
  
          if (!isset($_SESSION['idColaboradores']) && empty($_SESSION['idColaboradores'])) {
  
  
              $this->loadTemplate("home", $this->viewData);
          } else {
  
  
  
              $this->loadTemplateLoginCompany("atualizarFormularioVendaPlanos", $this->viewData);
          }
      }


      public function atualizarPlanos($id)
      {
  
  
          $viewData = array();
  
          if (!isset($_SESSION['idColaboradores']) && empty($_SESSION['idColaboradores'])) {
  
  
              $this->loadTemplate("home", $viewData);
          } else {
  
              //id do cliente
  
             
              $viewData['id'] = $id;
           
  
              $this->loadTemplateLoginCompany("atualizarFormularioVendaPlanos", $viewData);
          }
      }



    public function atualizarVenda(){



      




        /*Array ( [idCliente] => 1 ok
        [idVenda] => 543 ok
        [dataAdesao] => 2023-09-13 ok
        [dataVencimento] => 2024-08-10 ok
        [desconto] => 5,00 ok
        [vendedor] => 1 ok
        [formaPagamento] => 2  ok
        [portabilidade] => não ok
        [observacao] => Cliente novo ok
        [idPlano] => 1 ok
        
        [idDependente] => Array ( [0] => 1 [1] => 5 [2] => 6 [3] => 7 [4] => 21 [5] => 22 [6] => 23 [7] => 24 ) ok
        [valorExtraDependente] => 7 ok
        
        [atualizarVenda] => Atualizar Contrato ) ok*/
       
       
        $idCliente =  $_POST['idCliente'];
        $idVenda = addslashes($_POST['idVenda']);
        $dataAdesao = addslashes($_POST['dataAdesao']);
        $dataVencimento = addslashes($_POST['dataVencimento']);
        $dataInicioCarencia = $dataVencimento;
        $dataFinalCarencia = date("Y-m-d",strtotime("+90 days", strtotime($dataInicioCarencia)));
        
        
        $desconto = str_replace(",",".",$_POST['desconto']);


    
        $vendedor = addslashes($_POST['vendedor']);
        $formaPagamento = addslashes($_POST['formaPagamento']);
        $portabilidade = addslashes($_POST['portabilidade']);
        $observacao = addslashes($_POST['observacao']);


        $idPlano = addslashes($_POST['idPlano']);
        $plano = new Planos();
        $planoArray = $plano->getPlanosById($idPlano);
        $valorPlanoParcial = $planoArray['valorPlanos']; 

        

        $valorExtraDependente = addslashes($_POST['valorExtraDependente']);


        //ATUALIZAR VENDA


        $venda = new Venda();
        $this->atualizadaVenda = $venda->atualizarVenda($vendedor, $idVenda, $idCliente, $idPlano, $valorPlanoParcial, $desconto, $formaPagamento, $dataAdesao, $dataVencimento,$valorExtraDependente);


       
        //Verifica se foi atualizada a venda
        if($this->atualizadaVenda){

        //Atualizar o contrato
            $contrato = new Contrato();
            if($portabilidade == "sim"){

                $this->contratoAtualizado = $contrato->atualizarContratoPortabilidade($portabilidade, $observacao, $dataInicioCarencia, $dataFinalCarencia,$this::CARENCIA,$dataAdesao, $dataVencimento,$idCliente);

            

            }else{
                $this->contratoAtualizado = $contrato->atualizarContrato($portabilidade, $observacao,$idCliente);
           
             }


        }



        //verfica se o contrato e venda estão atualizadas respectiviamente

        if($this->atualizadaVenda && $this->contratoAtualizado){


            $viewData['id'] = $idCliente;
            $viewData['mensagem'] = "Atualizado com sucesso!";
           
  
            $this->loadTemplateLoginCompany("atualizarFormularioVendaPlanos", $viewData);


        }else{

            $viewData['id'] = $idCliente;
            $viewData['mensagem'] = "Problema ao atualizar!";
           
  
            $this->loadTemplateLoginCompany("atualizarFormularioVendaPlanos", $viewData);
        }




        












    }

}