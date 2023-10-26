<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


namespace Models;

use \Core\Model;


class Planos extends Model
{




    //selecinando todos os planos para ser adicionado na página de planos
    public function getAllPlanos($idEmpresa)
    {


        $sql = "SELECT * FROM planos WHERE empresa_idEmpresa = :idEmpresa";

        $select = $this->db->prepare($sql);
        $select->bindValue(":idEmpresa", $idEmpresa);
        $select->execute();

        if ($select->rowCount() > 0) {


            return $select->fetchAll();
        } else {


            return NULL;
        }
    }




    public function getPlanosById($id)
    {

        $sql = "SELECT * FROM planos WHERE idPlanos = :idPlanos";

        $select = $this->db->prepare($sql);
        $select->bindValue("idPlanos", $id);
        $select->execute();

        if ($select->rowCount() > 0) {


            return $select->fetch();
        } else {

            return NULL;
        }
    }



    //JSON BOTÃO CLICKPLANOS




    public function getPlanosByIdJSON($id)
    {



        $sql = "SELECT * FROM planos WHERE idPlanos = :idPlanos";

        $select = $this->db->prepare($sql);
        $select->bindValue("idPlanos", $id);
        $select->execute();

        if ($select->rowCount() > 0) {

            return $select->fetch();
        } else {

            return "Não há planos, Favor cadastrar";
        }
    }



    //inserir planos

    public function inserir($nomePlanos, $valorPlanos, $comissaoPlanos, $idEmpresa, $comSemSeguro, $descricao)
    {




        $sql = "INSERT INTO planos (nomePlanos, valorPlanos, empresa_idEmpresa, dataCadastroPlanos, dataCadastroAtualizacaoPlanos,  comissaoPlanos, descricao) VALUES (:nomePlanos, :valorPlanos,:idEmpresa,now(),now(),:comissaoPlanos, :descricao)";

        $inserir = $this->db->prepare($sql);
        $inserir->bindValue(':idEmpresa', $idEmpresa);
        $inserir->bindValue(':nomePlanos', $nomePlanos);
        $inserir->bindValue(':valorPlanos', $valorPlanos);
        $inserir->bindValue(':comissaoPlanos', $comissaoPlanos);
        $inserir->bindValue(':descricao', $descricao);


        $inserido = $inserir->execute();



        if ($inserido) {

            $idPlano = $this->db->lastInsertId();





            $planoHasComplementoPlano  = new Plano_has_complementoPlano();
            $complemento = new ComplementoPlano();
            $selecionado = $complemento->getComplementoPlano($idEmpresa);

            foreach ($selecionado  as $planoComplemento) {


                $retorno = $planoHasComplementoPlano->inserir($idPlano, $planoComplemento['idComplementoPlano'], $idEmpresa);
            }





            //   $complementoPlanos = new ComplementoPlano();



            if ($retorno) {


                return "Salvo com sucesso!";
            } else {


                return "Problema ao salvar!";
            }
        }
    }





    public function atualizar($nomePlanos, $valorPlanos, $comissaoPlanos, $idPlanos,$idEmpresa,$descricao)
    {



        $sql = "UPDATE planos SET nomePlanos = :nomePlanos, valorPlanos = :valorPlanos, dataCadastroAtualizacaoPlanos = now(),  comissaoPlanos = :comissaoPlanos, descricao = :descricao  WHERE idPlanos = :idPlanos and empresa_idEmpresa = :idEmpresa";

        $atual = $this->db->prepare($sql);
        $atual->bindValue(':idPlanos', $idPlanos);
        $atual->bindValue(':nomePlanos', $nomePlanos);
        $atual->bindValue(':valorPlanos', $valorPlanos);
        $atual->bindValue(':comissaoPlanos', $comissaoPlanos);
        $atual->bindValue(':idEmpresa', $idEmpresa);
        $atual->bindValue(':descricao', $descricao);
        


        $atualizado = $atual->execute();


        if ($atualizado) {


            return "Atualizado com sucesso!";
        } else {

            return "Problema ao atualizar!";
        }
    }


    public function deletar($id)
    {




        $sql = "DELETE FROM planos WHERE idPlanos = :idPlanos";


        $deletar = $this->db->prepare($sql);
        $deletar->bindValue(":idPlanos", $id);
        $deletado = $deletar->execute();

        if ($deletado) {


            return "Deletado com sucesso!";
        } else {

            return "Não foi possivel deletar!";
        }
    }




    public function checkPlano($nomePlano)
    {


        $sql = "SELECT * FROM planos WHERE nomePlanos = :nomePlanos";

        $select = $this->db->prepare($sql);

        $select->bindValue(":nomePlanos", $nomePlano);

        $select->execute();


        if ($select->rowCount() > 0) {


            return TRUE;
        } else {


            return FALSE;
        }
    }
}
