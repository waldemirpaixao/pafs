<?php


namespace Models;
use \Core\Model;
use PDOException;

class Contrato extends Model{


    const CARENCIA = 90;
    const ANO = 12;
    CONST ATIVO = 'sim';

    public function criarContrato($dataAdesao,$dataVencimento, $numeroContrato, $carencia, $dataInicioCarencia, $dataFimCarencia, $idEmpresa, $idClientes,$dataFimContrato,$idVenda,$portabilidade,$observacao){



        $sql = "insert into contrato(
            dataAdesao,
            dataVencimento,
            numeroContrato, 
            carenciaContrato, 
            dataInicioCarencia, 
            dataFinalCarencia, 
            empresa_idEmpresa, 
            clientes_idClientes, 
            dataFinalContrato,
            venda_idVenda, 
            venda_vendedores_idVendedores,
            portabilidade,
            observacao) values(  
            :dataAdesao,
            :dataVencimento,
            :numeroContrato, 
            :carenciaContrato, 
            :dataInicioCarencia, 
            :dataFinalCarencia, 
            :empresa_idEmpresa, 
            :clientes_idClientes, 
            :dataFinalContrato,
            :venda_idVenda, 
            :portabilidade,
            :observacao)";


        $inserir = $this->db->prepare($sql);


        try{



            $this->db->beginTransaction();

            $inserir->bindValue(":dataAdesao",$dataAdesao);
            $inserir->bindValue(":dataVencimento",$dataVencimento);
            $inserir->bindValue(":numeroContrato", $numeroContrato);
            $inserir->bindValue(":carenciaContrato", $carencia);
            $inserir->bindValue(":dataInicioCarencia", $dataInicioCarencia);
            $inserir->bindValue(":dataFinalCarencia",$dataFimCarencia);
            $inserir->bindValue(":empresa_idEmpresa",$idEmpresa);
            $inserir->bindValue(":clientes_idClientes", $idClientes);
            $inserir->bindValue(":dataFinalContrato", $dataFimContrato);
          //  $inserir->bindValue(":assinaturaDigitalClientes",$assinaturaDigitalClientes);
            $inserir->bindValue(":venda_idVenda", $idVenda);
            //$inserir->bindValue(":assinaturaDigitalVendedor", $assinaturaDigitalVendedor);
            $inserir->bindValue(":portabilidade", $portabilidade);
            $inserir->bindValue(":observacao", $observacao);

        

            $inserido = $inserir->execute();
            $comitado = $this->db->commit();



           
            if($comitado && $inserido){

                return true;
            }else{

                return false;
            }


        }catch(PDOException $ex){

            $this->db->rollBack();

            return $ex->getMessage();

        }







    }


    public function getcontratobyIdCliente($idCliente){


        $sql = "select * from contrato where clientes_idClientes = :idcliente  and contratoAtivo = :sim";

        $select = $this->db->prepare($sql);

        $select->bindValue(":idcliente",$idCliente);
        $select->bindValue(":sim",$this::ATIVO);

        $executado = $select->execute();

        if($select->rowCount() > 0 && $executado){

            return $select->fetch();



        }else{

            return null;
        }


        

    }


    public function atualizarContratoPortabilidade($portabilidade, $observacao, $dataInicioCarencia, $dataFinalCarencia, $carencia, $dataAdesao, $dataVencimento,$idCliente){



        $sql = "UPDATE contrato SET 
        dataAdesao = :dataAdesao,
        dataVencimento = :dataVencimento,
        carenciaContrato = :carencia,
        dataInicioCarencia = :dataInicioCarencia,
        dataFinalCarencia = :dataFinalCarencia,
        portabilidade = :portabilidade, 
        observacao = :observacao
        WHERE clientes_idClientes = :idCliente";

        $update = $this->db->prepare($sql);


        try{

            $this->db->beginTransaction();

            $update->bindValue(":portabilidade",$portabilidade);
            $update->bindValue(":observacao",$observacao);
            $update->bindValue(":dataInicioCarencia",$dataInicioCarencia);
            $update->bindValue(":dataFinalCarencia",$dataFinalCarencia);
            $update->bindValue(":carencia",$carencia);
            $update->bindValue(":dataAdesao",$dataAdesao);
            $update->bindValue(":dataVencimento",$dataVencimento);
            $update->bindValue(":idCliente", $idCliente);
        

            $atualizado = $update->execute();
            $comitado = $this->db->commit();

            if($atualizado && $comitado){

                return true;
            }else{

                return false;
            }



        }catch(PDOException $ex){

            $this->db->rollBack();

            return $ex->getMessage();
        }

    }

            

           
    public function atualizarContrato($portabilidade, $observacao,$idCliente){


        $sql = "UPDATE contrato SET 
        portabilidade = :portabilidade, 
        observacao = :observacao, 
        WHERE clientes_idClientes = :idCliente";

        $update = $this->db->prepare($sql);


        try{

            $this->db->beginTransaction();

            $update->bindValue(":portabilidade",$portabilidade);
            $update->bindValue(":observacao",$observacao);
            $update->bindValue(":idCliente", $idCliente);
        

            $atualizado = $update->execute();
            $comitado = $this->db->commit();

            if($atualizado && $comitado){

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