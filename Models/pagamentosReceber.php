<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Models;

use \Core\Model;
use PDOException;

class PagamentosReceber extends Model
{


    private const ANTERIOR = "anterior";




    public function inserir($idEmpresa, $idCliente, $numeroParcelas, $dataPagamento, $dataVencimento, $valor, $desconto, $statusPagamento, $formaPagamento, $idVenda, $idVendedor, $ano)
    {




        $sql = "INSERT INTO pagamentos_receber(empresa_idEmpresa,clientes_idClientes,numeroParceclas,dataPagamento,dataVencimentoBoleto, valor,desconto, estatusPagamento_idestatusPagamento, formaPagamento_idformaPagamento, venda_idVenda, venda_vendedores_idVendedores, ano)"
            . " VALUES (:idEmpresa, :idClientes, :numeroParceclas, :dataPagamento, :dataVencimentoBoleto, :valor, :desconto, :idEstatusPagamento, :idFormaPagamento, :idVenda, :idVendedores, :ano )";


        $inserir = $this->db->prepare($sql);

        try {

            $this->db->beginTransaction();
           
            $inserir->bindValue(':idEmpresa', $idEmpresa);
            $inserir->bindValue(':idClientes', $idCliente);
            $inserir->bindValue(':numeroParceclas', $numeroParcelas);
            $inserir->bindValue(':dataPagamento', $dataPagamento);
            $inserir->bindValue(':dataVencimentoBoleto', $dataVencimento);
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


    public function existeIdCliente($idCleinte)
    {


        $sql = "select * from pagamentos_receber where clientes_idClientes = :idCliente";

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


        $sql = "select * from pagamentos_receber where clientes_idClientes = :idClientes and anteriorultimo = :ultimo";

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




        $sql = "update pagamentos_receber set anteriorultimo = :anterior  where clientes_idClientes = :idClientes and anteriorultimo = :ultimo";

        $update = $this->db->prepare($sql);

        try {

            $this->db->beginTransaction();


            $update->bindValue(":idClientes", $idCliente);
            $update->bindValue(":ultimo", $ultimo);
            $update->bindValue(":anterior", $this::ANTERIOR);

            $executado = $update->execute();
            $comitado = $update->commit();

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
