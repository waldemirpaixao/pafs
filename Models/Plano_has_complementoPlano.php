<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 namespace Models;
 use \Core\Model;
use PDOException;

class Plano_has_complementoPlano extends Model{
    
    
    public function inserir($idPlanos, $idComplemento, $idEmpresa){
        
        $sql = "insert into planos_has_complementoPlano(planos_idPlanos, complementoPlano_idComplementoPlano, empresa_idEmpresa) "
                . "values( :idPlanos, :idComplemento, :idEmpresa )";
        
        $insert = $this->db->prepare($sql);
        
            $insert->bindValue(":idPlanos", $idPlanos);
            $insert->bindValue(":idComplemento", $idComplemento);
            $insert->bindValue(":idEmpresa", $idEmpresa);
            
            return $insert-> execute();
            
            
           /* if($retorno){
                
                return TRUE;
                
            }else{
                
                return FALSE;
                
            }*/
        
        
    }


    public function getMatchPlanoHasComplemento($idPlano, $idComplemento, $idEmpresa){


        $sql = "select * from planos_has_complementoPlano 
        join planos 
        on planos_has_complementoPlano.planos_idPlanos = planos.idPlanos
        join complementoPlano
        on planos_has_complementoPlano.complementoPlano_idComplementoPlano = complementoPlano.idComplementoPlano
        where planos_has_complementoPlano.planos_idPlanos = :idPlano 
        and planos_has_complementoPlano.complementoPlano_idComplementoPlano = :idComplemento
        and planos_has_complementoPlano.empresa_idEmpresa = :idEmpresa";


        $select = $this->db->prepare($sql);
        $select->bindValue(":idPlano",$idPlano);
        $select->bindValue(":idComplemento", $idComplemento);
        $select->bindValue(":idEmpresa",$idEmpresa);


        $executado = $select->execute();


        if($executado && $select->rowCount() > 0){

            return $select->fetchAll();

        }else{

            return null;
        }


    }



    public function atualizar($idPlano, $idComplemento,$idEmpresa){


        $sql = "update planos_has_complementoPlano 
        set complementoPlano_idComplementoPlano = :idComplementoPlano
        where empresa_idEmpresa = :idEmpresa
        and planos_idPlanos = :idPlanos";



        $update = $this->db->prepare($sql);

        try{

            $this->db->beginTransaction();

            $update->bindValue(":idComplementoPlano",$idComplemento);
            $update->bindValue(":idEmpresa",$idEmpresa);
            $update->bindValue(":idPlanos",$idPlano);
            
            $executado = $update->execute();
            $comitado = $this->db->commit();


            if($executado && $comitado){
                return true;
            }else{
                return false;
            }
        }catch(PDOException $ex){

            $this->db->rollBack();
            return $ex->getMessage();
        }

    }
    
    
    
}