<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


namespace Models;

use \Core\Model;
use PDOException;

class Saida extends Model
{

   public function envidados($de,$para, $assunto, $mensagem, $idEmpresa){

    $sql = "INSERT INTO saida(de,para, assunto, mensagem, empresa_idEmpresa) VALUES (:de,:para, :assunto, :mensagem, :idEmpresa)";

    $insert = $this->db->prepare($sql);

    try {
        $this->db->beginTransaction();

        $insert->bindValue(":de",$de);
        $insert->bindValue(":para", $para);
        $insert->bindValue(":assunto", $assunto);
        $insert->bindValue(":mensagem", $mensagem);
        $insert->bindValue(":idEmpresa", $idEmpresa);

        $executado = $insert->execute();
        $comitado = $this->db->commit();

        if($executado && $comitado){

            return true;
        }else{

            return false;

        }


    } catch (PDOException $ex) {

        $this->db->rollBack();
        return $ex->getMessage();
        
    }




   }

   public function getDespesasMesByEmpresa($idEmpresa, $mes, $ano) {
       $sql = "SELECT COALESCE(SUM(valor), 0) as total FROM despesas 
               WHERE empresa_idEmpresa = :id 
               AND MONTH(dataDespesa) = :mes 
               AND YEAR(dataDespesa) = :ano";

       $select = $this->db->prepare($sql);
       $select->bindValue(":id", $idEmpresa);
       $select->bindValue(":mes", $mes, \PDO::PARAM_INT);
       $select->bindValue(":ano", $ano, \PDO::PARAM_INT);

       $selected = $select->execute();

       if ($selected) {
           $result = $select->fetch();
           return $result['total'];
       } else {
           return 0;
       }
   }
}