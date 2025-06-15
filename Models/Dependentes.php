<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


namespace Models;

use \Core\Model;

class Dependentes extends Model
{

    public function getAllDependentes($idEmpresa)
    {



        $sql = "SELECT *, idClientes, nomeClientes FROM dependentes JOIN clientes on idClientes = clientes_idclientes WHERE dependentes.empresa_idEmpresa = :id ORDER BY nomeClientes";

        $select = $this->db->prepare($sql);
        $select->bindValue(":id", $idEmpresa);

        $selected = $select->execute();


        if ($selected) {

            return $select->fetchAll();
        } else {

            return NULL;
        }
    }

    public function inserir($nome, $cpf, $dataNascimento, $idClientes, $idEmpresa)
    {




        $sql = "INSERT INTO dependentes(nomeDependentes,cpfDependentes,dataNascimentoDependentes,clientes_idclientes,empresa_idEmpresa) VALUES (:nome,:cpf,:dataNascimento,:idClientes,:idEmpresa)";


        $insert = $this->db->prepare($sql);
        $insert->bindValue(":nome", $nome);
        $insert->bindValue(":cpf", $cpf);
        $insert->bindValue(":dataNascimento", $dataNascimento);
        $insert->bindValue(":idClientes", $idClientes);
        $insert->bindValue(":idEmpresa", $idEmpresa);



        $inserido = $insert->execute();


        if ($inserido) {

            return "Dependente cadastrado com sucesso!";
        } else {


            return "Não foi possível cadastrar o dependete!";
        }
    }




    public function checkCpf($cpfDependente)
    {

        $sql = "SELECT cpfDependentes FROM dependentes WHERE cpfDependentes = :cpf";

        $select = $this->db->prepare($sql);
        $select->bindValue(":cpf", $cpfDependente);
        $selecionado = $select->execute();

        if ($select->rowCount() > 0 && $selecionado) {

            return TRUE;
        } else {

            return FALSE;
        }
    }

    public function getDependentesById($id)
    {


        $sql = "SELECT * FROM dependentes WHERE idDependentes = :id";

        $select = $this->db->prepare($sql);
        $select->bindValue(":id", $id);
        $selected = $select->execute();

        if ($selected) {




            return $select->fetch();
        } else {



            return NULL;
        }
    }



    //public function update($id, $nome,$cpf, $dataNascimento, $titular) {
    public function update($id, $nome, $cpf, $dataNascimento)
    {




        // $sql = "UPDATE dependentes SET nomeDependentes = :nome, cpfDependentes = :cpf, dataNascimentoDependentes = :dataNascimento, clientes_idclientes = :idclientes WHERE idDependentes = :id";
        $sql = "UPDATE dependentes SET nomeDependentes = :nome, cpfDependentes = :cpf, dataNascimentoDependentes = :dataNascimento WHERE idDependentes = :id";


        $update = $this->db->prepare($sql);
        $update->bindValue(":id", $id);
        $update->bindValue(":nome", $nome);
        $update->bindValue(":cpf", $cpf);
        $update->bindValue(":dataNascimento", $dataNascimento);
        // $update->bindValue(":idclientes", $titular);

        $atualizado = $update->execute();


        if ($atualizado) {

            return TRUE;
        } else {


            return FALSE;
        }
    }



    public function getDependentesByIdTitular($id)
    {


        $sql = "SELECT * FROM dependentes WHERE clientes_idclientes = :idClientes";

        $select = $this->db->prepare($sql);

        $select->bindValue(":idClientes", $id);
        $select->execute();

        if ($select->rowCount() > 0) {

            return $select->fetchAll();
        } else {


            return NULL;
        }
    }


    public function  deletarDependentes($idDependentes)
    {

        $sql = "DELETE FROM dependentes WHERE idDependentes = :idDependentes";

        $deletar = $this->db->prepare($sql);

        $deletar->bindValue(":idDependentes", $idDependentes);

        $deletado = $deletar->execute();


        if ($deletado) {

            return true;
        } else {


            return false;
        }
    }


     public function getDependentesPorPagina($pagina, $itensPorPagina, $idEmpresa) {
        if (!is_numeric($pagina) || $pagina < 1) {
            $pagina = 1;
        }
        $offset = ($pagina - 1) * $itensPorPagina;

        $sql = "SELECT * , idClientes, nomeClientes FROM dependentes as d JOIN clientes on idClientes = clientes_idclientes WHERE d.empresa_idEmpresa = :id   ORDER BY nomeClientes ASC LIMIT :offset, :itensPorPagina";

        $select = $this->db->prepare($sql);
        $select->bindValue(":id", $idEmpresa);
        $select->bindValue(":offset", $offset, \PDO::PARAM_INT);
        $select->bindValue(":itensPorPagina", $itensPorPagina, \PDO::PARAM_INT);

        $selected = $select->execute();

        if ($selected) {

            return $select->fetchAll();
        } else {

            return $select->fetchAll();
        }
    }

}
