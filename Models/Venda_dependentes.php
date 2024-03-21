<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 namespace Models;
 use \Core\Model;
use PDOException;

class Venda_dependentes extends Model {

   
    /*Inserir Vendas_dependentes*/
    public function inserir($idVenda,$idVendedores, $idDependente, $idCientes, $idEmpresa) {

       $sql = "INSERT INTO venda_dependentes(venda_idVenda,venda_vendedores_idVendedores,dependentes_idDependentes, dependentes_clientes_idclientes,empresa_idEmpresa)"
               . " VALUES(:idVenda,:idVendedores, :idDependente, :idClientes, :idEmpresa)";

        $inserir = $this->db->prepare($sql);

        try{

            $this->db->beginTransaction();

            $inserir->bindValue(':idVenda', $idVenda);
            $inserir->bindValue(':idVendedores', $idVendedores);
            $inserir->bindValue(':idDependente', $idDependente);
            $inserir->bindValue(':idClientes', $idCientes);
            $inserir->bindValue(':idEmpresa', $idEmpresa);                                  
    
            $inserido = $inserir->execute();
            $comitado = $this->db->commit();


            if($inserido && $comitado){

                return 1;

            }else{
                

                return 0;

            }


        }catch(PDOException $ex){

            $this->db->rollBack();
            return $ex->getMessage();
        }

     
       
        
        
    }


    public function deletarVendaDependentes($idDependente){


        $sql = "DELETE FROM venda_dependentes  WHERE dependentes_idDependentes = :idDependente";

        $deletarVendaDependentes = $this->db->prepare($sql);
        $deletarVendaDependentes->bindValue(":idDependente",$idDependente);
        $deletadoVendaDependentes = $deletarVendaDependentes->execute();

        if($deletadoVendaDependentes){

            return true;


        }else{


            return false;
        }




        
    }

   
}
