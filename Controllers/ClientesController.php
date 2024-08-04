<?php

namespace Controllers;

use \Core\Controller;
use \Models\Clientes;


class ClientesController extends Controller {

    public function index() {

        $viewData = array();

        if (!isset($_SESSION['idColaboradores']) && empty($_SESSION['idColaboradores'])) {


            $this->loadTemplate("home", $viewData);
        } else {



            $this->loadTemplateLoginCompany("clientes", $viewData);
        }
    }

    public function registerClientes() {


        $nome = addslashes($_POST['nome']);
        $dataNascimento = addslashes($_POST['dataNascimento']);
        $rg = addslashes($_POST['rg']);
        $cpf = addslashes($_POST['cpf']);
        $telefone = addslashes($_POST['telefone']);
        $email = addslashes($_POST['email']);
        $endereco = addslashes($_POST['endereco']);
        $cep = addslashes($_POST['cep']);
        $complemento = addslashes($_POST['complemento']);
        $pontoreferencia = addslashes($_POST['pontoreferencia']);
        $bairro = addslashes($_POST['bairro']);
        $cidade = addslashes($_POST['cidade']);
        $estado = addslashes($_POST['estado']);
        $assinaturaDigital = addslashes(md5($_POST['nome']));





        
        $clientes = new Clientes();

        if ($clientes->checkCpf($cpf)) {
            
            
             $viewData["mensagem"] = "Cliente Já Cadastrado";
              $this->loadTemplateLoginCompany("clientes", $viewData);
            
        } else {
            $viewData["mensagem"] = $clientes->inserir($nome, $dataNascimento, $rg, $cpf, $telefone, $email, $endereco, $cep, $complemento, $pontoreferencia, $bairro, $cidade, $estado, $_SESSION['idEmpresa'], $assinaturaDigital);


            $this->loadTemplateLoginCompany("clientes", $viewData);
        }
    }

    public function atualizarClientes() {


        $id = $_GET['id'];

        $viewData['id'] = $id;
        $_SESSION['idClientes'] = $id;


        $this->loadTemplateLoginCompany("atualizarClientes", $viewData);
    }

    public function atualizar() {

        $id = addslashes($_POST['id']);
        $nome = addslashes($_POST['nome']);
        $dataNascimento = addslashes($_POST['dataNascimento']);
        $rg = addslashes($_POST['rg']);
        $cpf = addslashes($_POST['cpf']);
        $telefone = addslashes($_POST['telefone']);
        $email = addslashes($_POST['email']);
        $endereco = addslashes($_POST['endereco']);
        $cep = addslashes($_POST['cep']);
        $complemento = addslashes($_POST['complemento']);
        $pontoreferencia = addslashes($_POST['pontoreferencia']);
        $bairro = addslashes($_POST['bairro']);
        $cidade = addslashes($_POST['cidade']);
        $estado = addslashes($_POST['estado']);
        $situacao = addslashes($_POST['situacao']);


        $clientes = new Clientes();
        $viewData["mensagem"] = $clientes->update($id, $nome, $dataNascimento, $rg, $cpf, $telefone, $email, $endereco, $cep, $complemento, $pontoreferencia, $bairro, $cidade, $estado, $situacao);
        $viewData['id'] = $id;

        $this->loadTemplateLoginCompany("atualizarClientes", $viewData);
    }


    public function pesquisar(){


        $pesquisarCPF = $_GET['pesquisarCPF'];

        $clientes = new Clientes();
        $clienteArray['cliente'] = $clientes->pesquisarCpf($pesquisarCPF);


        if(isset($clienteArray)){

            $clienteArray['status'] = "OK";

            echo json_encode($clienteArray);

        }else{

            $clienteArray['status'] = "NOTOK";

            echo json_encode($clienteArray);

        }





    }



    public function pesquisarCliente(){


        $nomeCliente = $_POST['nomeCliente'];

        $clientes = new Clientes();
        $clienteArray['clienteJson'] = $clientes->pesquisarCliente($nomeCliente);


        if(isset($clienteArray)){

            $clienteArray['status'] = "OK";

            echo json_encode($clienteArray);

        }else{

            $clienteArray['status'] = "NOTOK";

            echo json_encode($clienteArray);

        }





    }



    public function deletarClientes($idCliente){



        echo $idCliente;
        exit;

    }

    
}
