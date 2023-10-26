<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 namespace Models;
 use \Core\Model;

class ComplementoPlano extends Model {
    
   
    
    
    public function getComplementoPlano($idEmpresa){
        
        $sql = "SELECT * FROM complementoPlano WHERE empresa_idEmpresa = :idEmpresa";
        
        $select = $this->db->prepare($sql);
        
        $select->bindValue(":idEmpresa",$idEmpresa);
        $select->execute();
        
        if($select->rowCount() > 0){
            
            return $select->fetchAll();
        }else{
            
            return NULL;
        }
        
        
    }

    public function getAllComplementoPlanos($idEmpresa) {


       // $sql = "SELECT * FROM complementoPlano WHERE empresa_idEmpresa = :idEmpresa";
        
        $sql = "SELECT * FROM planos join planos_has_complementoPlano on idPlanos = planos_idPlanos join complementoPlano on idComplementoPlano = complementoPlano_idComplementoPlano where planos.empresa_idEmpresa = :idEmpresa";

        $select = $this->db->prepare($sql);
        $select->bindValue(":idEmpresa", $idEmpresa);
        $select->execute();

        if ($select->rowCount() > 0) {


            return $select->fetchAll();
        } else {


            return NULL;
        }
    }

    /*
    public function inserir($idPlano, $idEmpresa, $comSemSeguro) {

        $sql = "INSERT INTO complementoPlano(nomeComplementoPlano, empresa_idEmpresa) values(:complementoPlanos, :idEmpresa)";

        $insert = $this->db->prepare($sql);

        
        foreach ($comSemSeguro as $semComSeguro) {

            $insert->bindValue(":complementoPlanos", $semComSeguro);
            $insert->bindValue(":idEmpresa", $idEmpresa);
        

            $retorno = $insert->execute();

        
                $idComplemento = $this->db->lastInsertId();
                $plano_has_complemento = new Plano_has_complementoPlano();
                
                $plano_has_complemento->inserir($idPlano, $idComplemento, $idEmpresa);

        }
        
        if($retorno){
            
            return TRUE;
        }else{
            
            return FALSE;
        }
    }
*/
}
