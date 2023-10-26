<?php

 
namespace Models;

use Core\Model;
use PDOException;

class  Bancos extends Model{


    public function inserir($nomeBanco, $idEmpresa){


        $sql = "insert into banco(nomebanco, empresa_idEmpresa) values(:nomebanco, :idEmpresa)";

        $inserir = $this->db->prepare($sql);

        try{


            $this->db->beginTransaction();

            $inserir->bindValue(":nomebanco", $nomeBanco);
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



    public function checkBanco($nomeBanco, $idEmpresa){





        $sql = "SELECT nomebanco, empresa_idEmpresa 
        FROM banco 
        WHERE nomebanco = :nomebanco and empresa_idEmpresa = :idEmpresa";

        $selecione = $this->db->prepare($sql);

        try{


            $this->db->beginTransaction();

            $selecione->bindValue(":nomebanco", $nomeBanco);
            $selecione->bindValue(":idEmpresa", $idEmpresa);

            $selecionado = $selecione->execute();
            $comitado = $this->db->commit();
            


            if($selecionado && $comitado && $selecione->rowCount() > 0){

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


        $sql = "select * from banco where empresa_idEmpresa = :idEmpresa";

        $select = $this->db->prepare($sql);

        $select->bindValue(":idEmpresa",$idEmpresa);

        $executado = $select->execute();

        if($executado && $select->rowCount() > 0){

            return $select->fetchAll();
        }else{

            return null;
        }

    }

}