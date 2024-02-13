<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Controllers;

use \Core\Controller;
use \Models\Clientes;
use Models\Contrato;
use Models\Planos;
use \Models\Venda;
use \Models\Venda_dependentes;

class formularioVendaPlanosController extends Controller
{




    private $vendaDependente = 0;
    private $contratoFeito = false;
    private $idCliente = 0;


    //$contrato = new Contrato();


    public function planos($id)
    {


        $viewData = array();

        if (!isset($_SESSION['idColaboradores']) && empty($_SESSION['idColaboradores'])) {


            $this->loadTemplate("home", $viewData);
        } else {

            //id do cliente

           
            $viewData['id'] = $id;
         

            $this->loadTemplateLoginCompany("formularioVendaPlanos", $viewData);
        }
    }

    public function registerVenda()
    {



        $contrato = new Contrato();

        $viewData = array();


        /* Tabela venda */
        $idVendedor = addslashes($_POST['vendedor']); //ok
        $idPlano = $_POST['plano']; //ok

        $plano = new Planos();
        $planoArray = $plano->getPlanosById($idPlano);

        $valorPlanoParcial = $planoArray['valorPlanos']; //ok

        $observacao = addslashes($_POST['observacao']);
        $portabilidade = addslashes($_POST['portabilidade']);

      
        $valorExtraDependente = addslashes($_POST['valorExtraDependente']); //ok
        $adesao = addslashes($_POST['adesao']); //oK
        $dataVencimento = addslashes($_POST['dataVencimento']); //ok
        $idClientes = addslashes($_POST['idCliente']); //ok
      
        $dataAdesao = addslashes($_POST['dataAdesao']); // ok
        $dataInicioCarencia = $dataAdesao;
       
        
        $dataFimCarencia = date("Y-m-d", strtotime('+' . $contrato::CARENCIA . " days", strtotime(strval($dataInicioCarencia))));
        $dataFimCarenciaNovo = strval(date_format(date_create($dataFimCarencia), "Y-m-d"));

        $dataFimContrato = date("Y-m-d",strtotime('+'.$contrato::ANO." months",strtotime(strval($dataVencimento))));
        $dataFimContratoNovo = date_format(date_create($dataFimContrato),"Y-m-d");


        $desconto = addslashes(str_replace(",",".",$_POST['desconto']));
                



        /* id da empresa */
        $idEmpresa = $_SESSION['idEmpresa'];




        /* Atualizar a tabela de clientes */
        $nome = addslashes($_POST['nome']); //ok
        $dataNascimento = addslashes($_POST['dataNascimento']); //ok
        $rg = addslashes($_POST['rg']); //ok
        $cpf = addslashes($_POST['cpf']); //ok
        $telefone = addslashes($_POST['telefone']); //ok
        $email = addslashes($_POST['email']); //ok
        $endereco = addslashes($_POST['endereco']); //ok
        $cep = addslashes($_POST['cep']); //ok
        $complemento = addslashes($_POST['complemento']); //ok
        $pontoReferencia = addslashes($_POST['pontoReferencia']); //ok
        $bairro = addslashes($_POST['bairro']); //ok
        $cidade = addslashes($_POST['cidade']); //ok
        $estado = addslashes($_POST['estado']); //ok
        $situacao = 'ativo'; //ok



        /* vai para a tabela de venda_dependentes */
        $idDependentes = $_POST['idDependente']; //ok Array




        /* Tabela Contrato */
        $numeroContrato = str_replace("-", "", str_replace(".", "", $cpf)) . "/" . date('Y');

        //$assinaturaDigitalClientes = addslashes($_POST['assinaturaDigitalClientes']); //ok
        //$assinaturaDigitalVendedor = addslashes($_POST['assinaturaDigitalVendedor']);//OK
        $observacao = addslashes($_POST['observacao']);
        $portabilidade = addslashes($_POST['portabilidade']);





        //verificar se atualizou o cliente
        $cliente = new Clientes();
        $cliente->update($idClientes, $nome, $dataNascimento, $rg, $cpf, $telefone, $email, $endereco, $cep, $complemento, $pontoReferencia, $bairro, $cidade, $estado, $situacao);
        $venda = new Venda();
        $idVenda = $venda->inserir($idVendedor, $valorPlanoParcial, $valorExtraDependente, $adesao, $dataVencimento, $idClientes, $idPlano, $idEmpresa, $dataAdesao,$desconto);

        //print_r($idDependentes);

        //Venda de dependente

        if (!empty($idDependentes)) {

            foreach ($idDependentes as $idDependente) {

                $venda_dependentes = new Venda_dependentes();

                $this->vendaDependente += intval($venda_dependentes->inserir($idVenda, $idVendedor, $idDependente, $idClientes, $idEmpresa));
            }
        }



        //contrato

        if($portabilidade == "sim"){

            $carencia = 0;
        }else{
            
            $carencia = $contrato::CARENCIA;
        }

        if ($this->vendaDependente > 0) {

          

            $this->contratoFeito =  $contrato->criarContrato($dataAdesao, $numeroContrato, $carencia, $dataInicioCarencia, $dataFimCarenciaNovo, $idEmpresa, $idClientes,$dataFimContratoNovo,$idVenda,$idVendedor, $portabilidade,$observacao);
        } else {


           $this->contratoFeito = $contrato->criarContrato($dataAdesao, $numeroContrato, $carencia, $dataInicioCarencia, $dataFimCarenciaNovo, $idEmpresa, $idClientes,$dataFimContratoNovo,$idVenda,$idVendedor, $portabilidade,$observacao);
        }
       
        
        //Gera o contrato em PDF 
        $viewData['id'] = $idClientes;
        $viewData['idVendedor']  = $idVendedor;


        if($this->contratoFeito){

            $this->loadView("contrato",$viewData);

        }else{
            $this->loadView("notFound",$viewData);
        }
     
    }
}
