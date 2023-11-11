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
}