<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


namespace Models;

use \Core\Model;
use PDOException;

class Venda extends Model

{

  const SIM = "sim";
  /* Inserir Vendas */



  // $insert = $this->db->prepare($sql); // pega a conexão e prepara a consulta SQL

  //try {

  // $this->db->beginTransaction(); // pega a conexão e inicia uma transação

  /*$insert->bindValue(":marcaPneus", $idMarcaPneus);
        $insert->bindValue(":fornecedor", $idFornecedores);
        $insert->bindValue(":observacao", $observacao);
        $insert->bindValue(":numeroFogo", $numeroFogo);
        $insert->bindValue(":numeroSerie", $numeroSerie);
        $insert->bindValue(":sulcoPneu", $sulcoPneu);
        $insert->bindValue(":medidaPneus", $idMedidaPneu);
        $insert->bindValue(":tipoPneus", $idTipoPneu);
        $insert->bindValue(":indicecarga", $indicecarga);
        $insert->bindValue(":indiceVelocidade", $indiceVelocidade);
        $insert->bindValue(":capacidadeLonas", $capacidadeLonas);*/
  //$insert->bindValue(":dot", $dot);
  //$insert->bindValue(":notafiscal", $notafiscal);
  //$insert->bindValue(":dataAquisicao", $dataAquisicao);
  //$insert->bindValue(":garantia", $garantia);
  //$insert->bindValue(":idEmpresa", $idEmpresa);
  //$insert->bindValue(":modeloPneus", $idModeloPneu);
  //$insert->bindValue(":prazoGarantia", $prazoGarantia);
  //$insert->bindValue(":precopneu", $valor);
  //$insert->bindValue(":idcondicaopneu", $condicaoPneu);

  //$executado = $insert->execute();
  //$idPneu = $this->db->lastInsertId(); //retorna último ID

  //$comitado = $this->db->commit(); // envia a transação

  //if ($executado && $comitado) {

  //  return $idPneu;
  //} else {

  //    return 0;
  //  }
  //} catch (PDOException $ex) {

  // $this->db->rollBack(); //desfaz a transação
  //   return $ex->getMessage(); //Mensagem de erro
  // }

  public function inserir($idVendedor, $valorPlanoParcial, $valorExtraDependente, $adesao, $idClientes, $idPlano, $idEmpresa, $dataAdesao, $desconto,$idFormaPagamento){
  

    $sql = "INSERT INTO venda(vendedores_idVendedores, dataVenda, valorPlanos, valorExtraDependente, adesaoVenda, clientes_idClientes, planos_idPlanos, empresa_idEmpresa, dataAdesao, desconto, formaPagamento_idformaPagamento) 
        VALUES(:idVendedores, now(), :valorPlanos, :valorExtraDependente, :adesaoVenda, :idClientes, :idPlanos, :idEmpresa, :dataAdesao, :desconto,:idFormaPagamento)";



    $inserir = $this->db->prepare($sql);


    try {

      $this->db->beginTransaction();

      $inserir->bindValue(":idVendedores", $idVendedor);
      $inserir->bindValue(":valorPlanos", $valorPlanoParcial);
      $inserir->bindValue(":valorExtraDependente", $valorExtraDependente);
      $inserir->bindValue(":adesaoVenda", $adesao);
      $inserir->bindValue(":idClientes", $idClientes);
      $inserir->bindValue(":idPlanos", $idPlano);
      $inserir->bindValue(":idEmpresa", $idEmpresa);
      $inserir->bindValue(":dataAdesao", $dataAdesao);
      $inserir->bindValue(":desconto", $desconto);
      $inserir->bindValue(":idFormaPagamento", $idFormaPagamento);
      


      $inserido = $inserir->execute();

      $ultimoId = $this->db->lastInsertId();

      $comitado = $this->db->commit();


      if ($inserido && $comitado) {

        return $ultimoId;
      } else {
  
        return 0;
      }
    } catch (PDOException $ex) {

      $this->db->rollBack();
      return $ex->getMessage();
    }



   // if ($inserido) {


     // return "Salvo com sucesso!";
    //} else {

      //return "Problema ao salvar!";
    //}
  }



  public function getVendaByIdClinteIdVendedor($idVendedor, $idCliente)
  {




    $sql = "select * from venda where vendedores_idVendedores = :idVendedores and clientes_idClientes = :idClientes";


    $select = $this->db->prepare($sql);

    $select->bindValue(":idVendedores", $idVendedor);
    $select->bindValue(":idClientes", $idCliente);

    $executado  = $select->execute();

    if ($executado && $select->rowCount() > 0) {

      return $select->fetch();
    } else {

      return null;
    }
  }



  public function getVendaByIdCliente($idCliente)
  {

    $sql = "select * from venda where clientes_idClientes = :idClientes and vendaAtual = :vendaAtual";


    $select = $this->db->prepare($sql);

    $select->bindValue(":idClientes", $idCliente);
    $select->bindValue(":vendaAtual", $this::SIM);
   

    $executado  = $select->execute();

    if ($executado && $select->rowCount() > 0) {

      return $select->fetch();
    } else {

      return null;
    }
  }


  public function getAllVenda()
  {


    $sql = "SELECT * 
    from venda";

    $select = $this->db->prepare($sql);

    $this->db->beginTransaction();

    $executado =  $select->execute();
    $comitado = $this->db->commit();


    if($comitado && $executado){

      return $select->fetchAll();
    }else{



      return null;
    }


  }
}
