<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Models;

use \Core\Model;
use PDOException;

class ReceberPagamentosDosClientes extends Model
{


    private const ANTERIOR = "anterior";




    public function inserir($idEmpresa, $idCliente, $numeroParcelas, $dataPagamento, $dataVencimento, $valor,$valorExtraDependente ,$desconto, $statusPagamento, $formaPagamento, $idVenda, $idVendedor, $ano)
    {




        $sql = "INSERT INTO receberPagamentosDosClientes(empresa_idEmpresa,clientes_idClientes,numeroParcelas,dataPagamento,dataVencimentoBoleto, valor,valorExtraDependente,desconto, estatusPagamento_idestatusPagamento, formaPagamento_idformaPagamento, venda_idVenda, venda_vendedores_idVendedores, ano)"
            . " VALUES(:idEmpresa, :idClientes, :numeroParcelas, :dataPagamento, :dataVencimentoBoleto, :valor,:valorExtraDependente, :desconto, :idEstatusPagamento, :idFormaPagamento, :idVenda, :idVendedores, :ano )";


        $inserir = $this->db->prepare($sql);

        try {

            $this->db->beginTransaction();
           
            $inserir->bindValue(':idEmpresa', $idEmpresa);
            $inserir->bindValue(':idClientes', $idCliente);
            $inserir->bindValue(':numeroParcelas', $numeroParcelas);
            $inserir->bindValue(':dataPagamento', $dataPagamento);
            $inserir->bindValue(':dataVencimentoBoleto', $dataVencimento);
            $inserir->bindValue(':valor', $valor);
            $inserir->bindValue(':valorExtraDependente', $valorExtraDependente);
            $inserir->bindValue(':desconto', $desconto);
            $inserir->bindValue(':idEstatusPagamento', $statusPagamento);
            $inserir->bindValue(':idFormaPagamento', $formaPagamento);
            $inserir->bindValue(':idVenda', $idVenda);
            $inserir->bindValue(':idVendedores', $idVendedor);
            $inserir->bindValue(':ano', $ano);
    
            $inserido = $inserir->execute();
            $comitado = $this->db->commit();

            if($inserido && $comitado){

              

                return true;
            }else{


                return false;
            }



        } catch (PDOException $ex) {

            $this->db->rollBack();
            return $ex->getMessage();
         
            

        }

      


    }


    public function inserirRetornaId($idEmpresa, $idCliente, $numeroParcelas, $dataPagamento, $dataVencimento, $valor, $valorExtraDependente,$desconto, $statusPagamento, $formaPagamento, $idVenda, $idVendedor, $ano)
    {




        $sql = "INSERT INTO receberPagamentosDosClientes(empresa_idEmpresa,clientes_idClientes,numeroParcelas,dataPagamento,dataVencimentoBoleto, valor,valorExtraDependente,desconto, estatusPagamento_idestatusPagamento, formaPagamento_idformaPagamento, venda_idVenda, venda_vendedores_idVendedores, ano)"
            . " VALUES (:idEmpresa, :idClientes, :numeroParcelas, :dataPagamento, :dataVencimentoBoleto, :valor, :desconto, :idEstatusPagamento, :idFormaPagamento, :idVenda, :idVendedores, :ano )";


        $inserir = $this->db->prepare($sql);

        try {

            $this->db->beginTransaction();
           
            $inserir->bindValue(':idEmpresa', $idEmpresa);
            $inserir->bindValue(':idClientes', $idCliente);
            $inserir->bindValue(':numeroParcelas', $numeroParcelas);
            $inserir->bindValue(':dataPagamento', $dataPagamento);
            $inserir->bindValue(':dataVencimentoBoleto', $dataVencimento);
            $inserir->bindValue(':valor',$valor);
            $inserir->bindValue(':valorExtraDependente', $valorExtraDependente);
            $inserir->bindValue(':desconto', $desconto);
            $inserir->bindValue(':idEstatusPagamento', $statusPagamento);
            $inserir->bindValue(':idFormaPagamento', $formaPagamento);
            $inserir->bindValue(':idVenda', $idVenda);
            $inserir->bindValue(':idVendedores', $idVendedor);
            $inserir->bindValue(':ano', $ano);
    
            $inserido = $inserir->execute();
            $ultimoId = $this->db->lastInsertId();
            $comitado = $this->db->commit();

            if($inserido && $comitado){

                return $ultimoId;
            }else{


                return 0;
            }



        } catch (PDOException $ex) {

            $this->db->rollBack();
            return $ex->getMessage();
         
            

        }

      


    }


    public function existeIdCliente($idCleinte)
    {


        $sql = "select * from receberPagamentosDosClientes where clientes_idClientes = :idCliente";

        $select = $this->db->prepare($sql);

        $select->bindValue(":idCliente", $idCleinte);

        $executado = $select->execute();


        if ($executado && $select->rowCount() > 0) {


            return true;
        } else {

            return false;
        }
    }

    public function ultimoBoletoCliente($ultimo, $idCliente)
    {


        $sql = "select * from receberPagamentosDosClientes where clientes_idClientes = :idClientes and anteriorultimo = :ultimo";

        $select = $this->db->prepare($sql);

        $select->bindValue(":idClientes", $idCliente);
        $select->bindValue(":ultimo", $ultimo);

        $executado = $select->execute();

        if ($executado && $select->rowCount() > 0) {

            return $select->fetch();
        } else {

            return null;
        }
    }


    public function atualizarAnterior($ultimo, $idCliente)
    {




        $sql = "update receberPagamentosDosClientes set anteriorultimo = :anterior  where clientes_idClientes = :idClientes and anteriorultimo = :ultimo";

        $update = $this->db->prepare($sql);

        try {

            $this->db->beginTransaction();


            $update->bindValue(":idClientes", $idCliente);
            $update->bindValue(":ultimo", $ultimo);
            $update->bindValue(":anterior", $this::ANTERIOR);

            $executado = $update->execute();
            $comitado = $this->db->commit();

            if ($executado && $comitado) {

                return true;
            } else {

                return false;
            }
        } catch (PDOException $ex) {

            $this->db->rollBack();
            return $ex->getMessage();
        }
    }


    public function atualizarAnteriorUltimoId($idCliente, $ultimoId)
    {




        $sql = "update receberPagamentosDosClientes set anteriorultimo = :anterior  where clientes_idClientes = :idClientes and idPagamentos = :idPagamentos";

        $update = $this->db->prepare($sql);

        try {

            $this->db->beginTransaction();


            $update->bindValue(":idClientes", $idCliente);
            $update->bindValue(":anterior", $this::ANTERIOR);
            $update->bindValue(":idPagamentos", $ultimoId);

            $executado = $update->execute();
            $comitado = $this->db->commit();

            if ($executado && $comitado) {

                return true;
            } else {

                return false;
            }
        } catch (PDOException $ex) {

            $this->db->rollBack();
            return $ex->getMessage();
        }
    }
}
