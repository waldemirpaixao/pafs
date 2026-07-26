<?php

namespace Controllers;

use \Core\Controller;
use \Models\Colaborador;
use \Models\Empresa;
use \Models\Clientes;
use \Models\Dependentes;
use \Models\Venda;
use \Models\Contrato;
use \Models\ReceberPagamentosDosClientes;
use \Models\Saida;

class HomeController extends Controller {

    public function index() {

        $viewData = array();

        

        if (!isset($_SESSION['idColaboradores']) && empty($_SESSION['idColaboradores'])) {


            $this->loadTemplate("home", $viewData);


       
        } else {
            // Carregar dados financeiros para o dashboard
            $viewData = $this->getDashboardData();
            $this->loadTemplateLoginCompany("dashboard", $viewData);
        }
    }

    private function getDashboardData() {
        $idEmpresa = $_SESSION['idEmpresa'];
        $anoAtual = date('Y');
        $mesAtual = date('m');

        $viewData = array();

        // Total de Clientes Ativos
        $clientesModel = new Clientes();
        $viewData['totalClientes'] = $clientesModel->getTotalClientesByEmpresa($idEmpresa);
        $viewData['clientesAtivos'] = $clientesModel->getTotalClientesAtivosByEmpresa($idEmpresa);

        // Total de Dependentes
        $dependentesModel = new Dependentes();
        $viewData['totalDependentes'] = $dependentesModel->getTotalDependentesByEmpresa($idEmpresa);

        // Planos Ativos
        $vendaModel = new Venda();
        $viewData['planosAtivos'] = $vendaModel->getTotalPlanosAtivosByEmpresa($idEmpresa);
        $viewData['planosInativos'] = $vendaModel->getTotalPlanosInativosByEmpresa($idEmpresa);

        // Faturamento do Mês
        $viewData['faturamentoMes'] = $vendaModel->getFaturamentoMesByEmpresa($idEmpresa, $mesAtual, $anoAtual);
        $viewData['faturamentoAno'] = $vendaModel->getFaturamentoAnualByEmpresa($idEmpresa, $anoAtual);

        // Pagamentos
        $pagamentoModel = new ReceberPagamentosDosClientes();
        $viewData['pagamentosRecebidos'] = $pagamentoModel->getPagamentosRecebidosMesAtualByEmpresa($idEmpresa, $mesAtual, $anoAtual);
        $viewData['pagamentosAReceber'] = $pagamentoModel->getPagamentosAReceberByEmpresa($idEmpresa);
        $viewData['inadimplentes'] = $pagamentoModel->getClientesInadimplentesByEmpresa($idEmpresa);

        // Vendas do Mês
        $viewData['vendasMes'] = $vendaModel->getTotalVendasMesByEmpresa($idEmpresa, $mesAtual, $anoAtual);
        $viewData['vendasAno'] = $vendaModel->getTotalVendasAnualByEmpresa($idEmpresa, $anoAtual);

        // Cancelamentos
        $contratoModel = new Contrato();
        $viewData['contratosCancelados'] = $contratoModel->getContratosCanceladosByEmpresa($idEmpresa);
        $viewData['contratosAtivos'] = $contratoModel->getContratosAtivosByEmpresa($idEmpresa);

        // Despesas do Mês
        $despesasModel = new Saida();
        $viewData['despesasMes'] = $despesasModel->getDespesasMesByEmpresa($idEmpresa, $mesAtual, $anoAtual);

        // Dados para Gráficos
        $viewData['vendasPorMes'] = $vendaModel->getVendasPorMesAnual($idEmpresa, $anoAtual);
        $viewData['faturamentoPorMes'] = $vendaModel->getFaturamentoPorMesAnual($idEmpresa, $anoAtual);
        $viewData['statusPagamentos'] = $pagamentoModel->getStatusPagamentosResume($idEmpresa, $mesAtual, $anoAtual);

        return $viewData;
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

        //captura o ano corrente
        $_SESSION['ano'] =  date("Y");
        
        // Carregar dados financeiros para o dashboard
        $viewData = $this->getDashboardData();
        
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
