<?php

 
namespace Models;

use Core\Model;
use PDOException;

class  FormaDePagamento extends Model{


    public function inserir($formaPagamento, $idEmpresa){


        $sql = "insert into formaPagamento(nomeformaPagamento, empresa_idEmpresa) values(:formaPagamento, :idEmpresa)";

        $inserir = $this->db->prepare($sql);

        try{


            $this->db->beginTransaction();

            $inserir->bindValue(":formaPagamento", $formaPagamento);
            $inserir->bindValue(":idEmpresa", $idEmpresa);

            $inserido = $inserir->execute();
            $comitado = $this->db->commit();
            


            if($inserido && $comitado){

                return true;
            }else{


                return false;
            }

        }catch(PDOException $ex){

            $this->db->rollBack();
            return $ex->getMessage();

        }

    }


    public function checkFormaDePagamento($formaPagamento, $idEmpresa){



        $sql = "SELECT nomeformaPagamento, empresa_idEmpresa 
        FROM formaPagamento 
        WHERE nomeformaPagamento = :formaPagamento and empresa_idEmpresa = :idEmpresa";

        $selecionar = $this->db->prepare($sql);

        try{


            $this->db->beginTransaction();

            $selecionar->bindValue(":formaPagamento", $formaPagamento);
            $selecionar->bindValue(":idEmpresa", $idEmpresa);

            $selecionado = $selecionar->execute();
            $comitado = $this->db->commit();
            


            if($selecionado && $comitado && $selecionar->rowCount() > 0){

                return true;
            }else{


                return false;
            }

        }catch(PDOException $ex){

            $this->db->rollBack();
            return $ex->getMessage();

        }

    }


    public function getAllByEmpresa($idEmpresa){


        $sql = "select * from formaPagamento where empresa_idEmpresa = :idEmpresa";

        $select = $this->db->prepare($sql);

        $select->bindValue(":idEmpresa",$idEmpresa);

        $executado = $select->execute();

        if($executado && $select->rowCount() > 0){

            return $select->fetchAll();
        }else{

            return null;
        }

    }



    public function getFormaPagamento($boleto, $idEmpresa){



        $sql = "select * from formaPagamento where empresa_idEmpresa = :idEmpresa and nomeformaPagamento = :nomeformaPagamento";

        $select = $this->db->prepare($sql);

        $select->bindValue(":idEmpresa",$idEmpresa); 
        $select->bindValue(":nomeformaPagamento",$boleto); 

        $executado = $select->execute();

        if($executado && $select->rowCount() > 0){

            return $select->fetch();
        }else{

            return null;
        }


    }


}