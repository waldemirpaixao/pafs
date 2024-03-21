<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Controllers;
use \Core\Controller;
use \Models\Dependentes;
use Models\Venda_dependentes;

class DependentesController extends Controller{
    
    
    
      public function index() {

        $viewData = array();

        if (!isset($_SESSION['idColaboradores']) && empty($_SESSION['idColaboradores'])) {


            $this->loadTemplate("home", $viewData);
        } else {



            $this->loadTemplateLoginCompany("dependentes", $viewData);
        }
    }
    
    
    
    
    public function registerDependentes(){
        
        
        
        $idClientes = addslashes($_POST['idCliente']);
        $nome = addslashes($_POST['nome']);
        $cpf = addslashes($_POST['cpf']);
        $dataNascimento = addslashes($_POST['dataNascimento']);
        
        
        $dependentes =  new Dependentes();
        
        /*checar se existe um cpf igual*/
       //$checkado = $dependentes->checkCpf($cpf);
       
      // if($checkado){
        
            //   $viewData["mensagem"] = "Dependente já Cadastrado!";
        // $this->loadTemplateLoginCompany("dependentes", $viewData);
    // }else{
         
         
         $viewData['mensagem'] = $dependentes->inserir($nome,$cpf, $dataNascimento,$idClientes ,$_SESSION['idEmpresa']);
        $this->loadTemplateLoginCompany("dependentes", $viewData);
         
         
  
         
    // }
     
    }
    
    
    public function atualizarDependentes(){
        
        
         $viewData['id'] = addslashes($_GET['id']);
        
         $this->loadTemplateLoginCompany("atualizarDependentes", $viewData);
        
    }
    
    
    public function atualizar(){
        
        $id = addslashes($_POST['id']);
       // $titular = addslashes($_POST['titular']);

        $nome = addslashes($_POST['nome']);
        $cpf = addslashes($_POST['cpf']);
        $dataNascimento = addslashes($_POST['dataNascimento']);
        
        $dependente = new Dependentes();
        //$atualizado = $dependente->update($id, $nome,$cpf, $dataNascimento, $titular);
        $atualizado = $dependente->update($id, $nome,$cpf, $dataNascimento);
        if($atualizado){
            
            $viewData['mensagem'] = "Dependentes atualizado com sucesso!";
            $viewData['id'] = $id;
            $this->loadTemplateLoginCompany("atualizarDependentes", $viewData);
            
        } else {
            
            $viewData['mensagem'] =  "Não foi possível atualizar o Dependente!";
            $viewData['id'] = $id;
            $this->loadTemplateLoginCompany("atualizarDependentes", $viewData);
            
        }
        
    }
    

    public function deletarDependentes($idDependentes){



        $viewData = [];



        //É NECESSÁRIO QUE DELETE ANTES DA VENDA DEPENDENTES PARA DEPOIS DELETAR DO DEPENDENTE
        //vENDA dEPENDENTES

        $vendaDependentes = new Venda_dependentes();
        $deletadoVendaDependente = $vendaDependentes->deletarVendaDependentes($idDependentes);

        if($deletadoVendaDependente){


            //DEPENDENTES

        $dependente = new Dependentes();
        $deletadoDependente = $dependente->deletarDependentes($idDependentes);

        if($deletadoDependente){


            $viewData = ['mensagem' => "Dependente deletado com sucesso!"];


        }else{


            $viewData = ['mensagem' => "Ops! Algo deu errado."];


        }



        }else{

            $viewData = ['mensagem' => "Ops! Algo deu errado."];


        }




        


       




        $this->loadTemplateLoginCompany("dependentes", $viewData);

    }
    

}



