<?php

namespace Controllers;

use \Core\Controller;
use \Models\Colaborador;
use \Models\Empresa;

class HomeController extends Controller {

    public function index() {

        $viewData = array();

        

        if (!isset($_SESSION['idColaboradores']) && empty($_SESSION['idColaboradores'])) {


            $this->loadTemplate("home", $viewData);


       
        } else {



            $this->loadTemplateLoginCompany("dashboard", $viewData);
        }
    }

    // make login
    public function doLogin() {




             
        $viewData = array();
        
        
        
        //pega o usuário e senha do formulário

       $login = addslashes($_POST['login']);
       $senha = addslashes(md5($_POST['senha']));

       


       // $_SESSION['idColaboradores'] = '1';
        
        //faz a instancia da classe
        $colaborador = new Colaborador();
        
        //checa se existe e retorna os dados compelto do colaborador
        $colaboradores = $colaborador->checkLogin($login, $senha);
        
        //verifica se tem dados
        if($colaboradores != NULL){
            
       
        //adiciona na sessão do colaborados    
        $_SESSION['emailColaboradores'] = $colaboradores['emailColaboradores'];
        $_SESSION['idColaboradores'] = $colaboradores['idColaboradores'];
        $_SESSION['nomeColaboradores'] = $colaboradores['nomeColaboradores'];
        $_SESSION['idEmpresa'] = $colaboradores['empresa_idEmpresa'];
        
       
        //instancia a classe empresa
        $empresa = new Empresa();
        $empresas = $empresa->getEmpresaById($_SESSION['idEmpresa']); //capitura dos dados com o id vindo do cliente
        
    
         
        //variável de sessão para empresa
        $_SESSION['nomeEmpresa'] = $empresas['nomeEmpresa'];
        $_SESSION['emailEmpresa'] =  $empresas['emailEmpresa'];
        $_SESSION['siglaEmpresa'] = $empresas['siglaEmpresa'];
        $_SESSION['logoEmpresa'] = $empresas['logoEmpresa'];
        $_SESSION['cnpj'] = $empresas['cnpjEmpresa'];
        
        
        
    
        $this->loadTemplateLoginCompany("dashboard", $viewData);
       
       
        }else{
            
           
            
            $viewData['mensagem'] = "Usuário ou senha incorretos!";
            
            $this->loadTemplate("home", $viewData);
        }
    }

    
    //logoout
    public function logOut() {


        $viewData = array();
        session_unset();
         $this->loadTemplate("home", $viewData);
    }

}
