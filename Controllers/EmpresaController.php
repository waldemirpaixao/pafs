<?php

namespace Controllers;
use \Core\Controller;
use \Models\Empresa;

class EmpresaController extends Controller {

    public function index() {

        $viewData = array();

        if (!isset($_SESSION['idColaboradores']) && empty($_SESSION['idColaboradores'])) {


            $this->loadTemplate("home", $viewData);
        } else {



            $this->loadTemplateLoginCompany("empresa", $viewData);
        }
    }
    
    
    
    
    public function registerEmpresa(){
        
        
      
        
     // print_r($_POST);
      
      
   
       // print_r($_FILES);
       
        $logoMarca = $_FILES['foto'];
        $cnpj = addslashes($_POST['cnpjEmpresa']);
        $nomeEmpresa = addslashes($_POST['nomeEmpresa']);
        $sigla = addslashes($_POST['siglaEmpresa']);
        $telefone = addslashes($_POST['telefoneEmpresa']);
        $cep = addslashes($_POST['cepEmpresa']);
        $endereco = addslashes($_POST['enderecoEmpresa']);
        $numero = addslashes($_POST['numeroEmpresa']);
        $complemento = addslashes($_POST['complementoEmpresa']);
        $pontoReferencia = addslashes($_POST['pontoReferenciaEmpresa']);
        $bairro = addslashes($_POST['bairroEmpresa']);
        $cidade = addslashes($_POST['cidadeEmpresa']);
        $estado = addslashes($_POST['estadoEmpresa']);
        $email = addslashes($_POST['emailEmpresa']);
        
        if($nomeEmpresa !=NULL && $email != NULL){
            
            $empresa = new Empresa();
        
             $viewData["mensagem"] =  $empresa->inserir($logoMarca,$cnpj,$nomeEmpresa,$sigla,$telefone,$cep,$endereco,$numero,$complemento,$pontoReferencia,$bairro,$cidade,$estado,$email);
            
             
             
               $this->loadTemplateLoginCompany("empresa", $viewData);
         
         
        }
    }
    
    
    
     public function atualizarEmpresa(){
         
         
        $logoMarca = $_FILES['foto'];
       
        $cnpj = addslashes($_POST['cnpjEmpresa']);
        $nomeEmpresa = addslashes($_POST['nomeEmpresa']);
        $sigla = addslashes($_POST['siglaEmpresa']);
        $telefone = addslashes($_POST['telefoneEmpresa']);
        $cep = addslashes($_POST['cepEmpresa']);
        $endereco = addslashes($_POST['enderecoEmpresa']);
        $numero = addslashes($_POST['numeroEmpresa']);
        $complemento = addslashes($_POST['complementoEmpresa']);
        $pontoReferencia = addslashes($_POST['pontoReferenciaEmpresa']);
        $bairro = addslashes($_POST['bairroEmpresa']);
        $cidade = addslashes($_POST['cidadeEmpresa']);
        $estado = addslashes($_POST['estadoEmpresa']);
        $email = addslashes($_POST['emailEmpresa']);
        
        
        $planos = new Empresa();
        $viewData['mensagem'] = $planos->atualizar($logoMarca, $cnpj, $nomeEmpresa, $sigla, $telefone, $cep, $endereco, $numero, $complemento, $pontoReferencia, $bairro, $cidade, $estado, $email);
       
       
       
       
        $this->loadTemplateLoginCompany("empresa", $viewData);
         
         
    
        
        
    }
    
    
    
    public function planos($idCliente){
        
        
        $viewData = array();
        $viewData['id']= $idCliente;
        
        
         $this->loadTemplateLoginCompany("formularioVendaPlanos",$viewData);
        
        
    }

   

}
