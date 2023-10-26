<?php

 
namespace Models;

use Core\Model;
use PDOException;

class  EstatusPagamento extends Model{


   


   public function getIdStatusPagamentoByName($estatus){

    $sql = "SELECT * 
    FROM estatusPagamento 
    WHERE nomeEstatusPagamento = :nomeEstatusPagamento";

    $select = $this->db->prepare($sql);
    
    $select->bindvalue(":nomeEstatusPagamento", $estatus);

    $executado = $select->execute();


    if($executado && $select->roCount() > 0){

        return $select->fetch();
    }else{

        return null;
    }



   }
}