<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 namespace Models;
 use \Core\Model;

class Clientes extends Model {


    const ATIVO = "ativo";

    public function getAllCliente($idEmpresa) {


        define("situacao", "ativo");
        $sql = "SELECT * FROM clientes WHERE empresa_idEmpresa = :id and situacao = :situacao";

        $select = $this->db->prepare($sql);
        $select->bindValue(":id", $idEmpresa);
        $select->bindValue(":situacao", situacao);

        $selected = $select->execute();


        if ($selected) {

            return $select->fetchAll();
        } else {

            return NULL;
        }
    }

    public function inserir($nome, $dataNascimento, $rg, $cpf, $telefone, $email, $endereco, $cep, $complemento, $pontoreferencia, $bairro, $cidade, $estado, $idEmpresa,$assinaturaDigital) {


        
        
        //echo $nome. $dataNascimento. $rg. $cpf. $telefone. $email. $endereco. $complemento. $pontoreferencia. $bairro. $cidade. $estado. $idEmpresa;

        //exit();
        $sql = "INSERT INTO clientes(nomeClientes,rgClientes, cpfClientes, enderecoClientes,cepClientes, bairroClientes,complementoClientes, pontoReferenciaClientes,cidadeClientes, estadoClientes, telefoneClientes, emailClientes, dataNascimentoClientes, empresa_idEmpresa, dataCadastroClientes, dataCadastroAtualizacaoClientes, assinaturaDigitalClientes) VALUES (:nome, :rg, :cpf, :endereco, :cep, :bairro, :complemento, :pontoReferencia, :cidade, :estado, :telefone,:email,:dataNascimento,:idEmpresa, now(),now(),:assinatura)";


        $insert = $this->db->prepare($sql);
        $insert->bindValue(":nome", $nome);
        $insert->bindValue(":rg", $rg);
        $insert->bindValue(":cpf", $cpf);
        $insert->bindValue(":endereco", $endereco);
        $insert->bindValue(":cep", $cep);
        $insert->bindValue(":bairro", $bairro);
        $insert->bindValue(":complemento", $complemento);
        $insert->bindValue(":pontoReferencia", $pontoreferencia);
        $insert->bindValue(":cidade", $cidade);
        $insert->bindValue(":estado", $estado);
        $insert->bindValue(":telefone", $telefone);
        $insert->bindValue(":email", $email);
        $insert->bindValue(":dataNascimento", $dataNascimento);
        //$insert->bindValue(":situacao", NULL);
        $insert->bindValue(":idEmpresa", $idEmpresa);
         $insert->bindValue(":assinatura", $assinaturaDigital);



        $inserido = $insert->execute();


        if ($inserido) {

            return "Cliente cadastrado com sucesso!";
        } else {


            return "Não foi possível cadastrar o cliente!";
        }
    }

    public function getClientById($id) {


        $sql = "SELECT * FROM clientes WHERE idClientes = :id and situacao = :ativo";

        $select = $this->db->prepare($sql);
        $select->bindValue(":id", $id);
        $select->bindValue(":ativo", $this::ATIVO);
        $selected = $select->execute();

        if ($selected) {




            return $select->fetch();
        } else {



            return NULL;
        }
    }

    public function update($id, $nome, $dataNascimento, $rg, $cpf, $telefone, $email, $endereco, $cep, $complemento, $pontoreferencia, $bairro, $cidade, $estado, $situacao) {




        $sql = "UPDATE clientes SET nomeClientes = :nome,rgClientes = :rg, cpfClientes = :cpf, enderecoClientes = :endereco, cepClientes = :cep,  bairroClientes = :bairro, complementoClientes = :complemento, pontoReferenciaClientes = :pontoReferencia, cidadeClientes = :cidade, estadoClientes = :estado, telefoneClientes = :telefone, emailClientes = :email, dataNascimentoClientes = :dataNascimento, situacao = :situacao, dataCadastroAtualizacaoClientes = now() WHERE idClientes = :id";


        $update = $this->db->prepare($sql);
        $update->bindValue(":id", $id);
        $update->bindValue(":nome", $nome);
        $update->bindValue(":rg", $rg);
        $update->bindValue(":cpf", $cpf);
        $update->bindValue(":endereco", $endereco);
        $update->bindValue(":cep", $cep);
        $update->bindValue(":bairro", $bairro);
        $update->bindValue(":complemento", $complemento);
        $update->bindValue(":pontoReferencia", $pontoreferencia);
        $update->bindValue(":cidade", $cidade);
        $update->bindValue(":estado", $estado);
        $update->bindValue(":telefone", $telefone);
        $update->bindValue(":email", $email);
        $update->bindValue(":dataNascimento", $dataNascimento);
        $update->bindValue(":situacao", $situacao);
        // $insert->bindValue(":idEmpresa", $idEmpresa);



        $atualizado = $update->execute();


        if ($atualizado) {

            return "Cliente atualizado com sucesso!";
        } else {


            return "Não foi possível atualizar o cliente!";
        }
    }
    
    public function checkCpf($cpf){
        
        
        $sql = "SELECT * FROM clientes WHERE cpfClientes = :cpfClientes";
        
        $select = $this->db->prepare($sql);
        
        $select->bindValue(":cpfClientes",$cpf);
        
        $select->execute();
        
        
        if($select->rowCount() > 0){
            
            
            return TRUE;
        } else {
        
            return FALSE;
        }
    }
    

    public function pesquisarCpf($cpf){
        
        
        $sql = "SELECT * FROM clientes join dependentes WHERE cpfClientes like '%". $cpf."%'";

       // " WHERE pneu.numerofogopneu like '%" . $pesquisa . "%'"
        
        $select = $this->db->prepare($sql);
        
        //$select->bindValue(":cpfClientes",$cpf);
        
        $select->execute();
        
        
        if($select->rowCount() > 0){
            
            
            return $select->fetch();
        } else {
        
            return null;
        }
    }

    public function pesquisarCliente($nomeCliente){
        
        
        $sql = "SELECT * FROM clientes join dependentes WHERE nomeClientes like '%". $nomeCliente."%'";

       // " WHERE pneu.numerofogopneu like '%" . $pesquisa . "%'"
        
        $select = $this->db->prepare($sql);
        
        //$select->bindValue(":nomeClientes",$nomeCliente);
        
        $select->execute();
        
        
        if($select->rowCount() > 0){
            
            
            return $select->fetch();
        } else {
        
            return null;
        }
    }

}
