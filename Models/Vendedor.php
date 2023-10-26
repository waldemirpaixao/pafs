<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


 namespace Models;
 use \Core\Model;
class Vendedor extends Model {

    //selecinando todos os Vendedores para ser adicionado na página de planos
    public function getAllVendedor($idEmpresa) {


        $sql = "SELECT * FROM vendedores WHERE empresa_idEmpresa = :idEmpresa";

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
      public function getPlanosById($id) {

      $sql = "SELECT * FROM planos WHERE idPlanos = :idPlanos";

      $select = $this->db->prepare($sql);
      $select->bindValue("idPlanos", $id);
      $select->execute();

      if ($select->rowCount() > 0) {


      return $select->fetch();
      } else {

      return NULL;
      }
      } */

    //inserir vendedores

    public function inserir($nomeVendedores, $telefoneVendedores, $emailVendedores, $idEmpresa,$assinaturaDigitalVendedor) {

        /*
          echo $nomeVendedores."<br/>";
          echo $telefoneVendedores. "<br/>";
          echo $emailVendedores."<br/>";
          echo $idEmpresa."<br/>";

          exit(); */


        $sql = "INSERT INTO vendedores(nomeVendedores, telefoneVendedores,emailVendedores, dataCadastroVendedores, dataAtualizacaoVendedores,empresa_idEmpresa,assinaturaDigitalVendedor) 
        VALUES(:nomeVendedores, :telefoneVendedores,:emailVendedores, now(), now(), :idEmpresa, :assinaturaDigitalVendedor)";

        $inserir = $this->db->prepare($sql);

        $inserir->bindValue(':nomeVendedores', $nomeVendedores);
        $inserir->bindValue(':telefoneVendedores', $telefoneVendedores);
        $inserir->bindValue(':emailVendedores', $emailVendedores);
        $inserir->bindValue(':idEmpresa', $idEmpresa);
        $inserir->bindValue(':assinaturaDigitalVendedor', $assinaturaDigitalVendedor);
        

        $inserido = $inserir->execute();


        if ($inserido) {


            return "Salvo com sucesso!";
        } else {

            return "Problema ao salvar!";
        }
    }

    /*
      public function atualizar($nomePlanos, $valorPlanos, $idenizacaoPlanos, $comissaoPlanos, $idPlanos) {



      $sql = "UPDATE planos SET nomePlanos = :nomePlanos, valorPlanos = :valorPlanos, dataCadastroAtualizacaoPlanos = now(), idenizacaoPlanos = :idenizacaoPlanos, comissaoPlanos = :comissaoPlanos  WHERE idPlanos = :idPlanos";

      $atual = $this->db->prepare($sql);
      $atual->bindValue(':idPlanos', $idPlanos);
      $atual->bindValue(':nomePlanos', $nomePlanos);
      $atual->bindValue(':valorPlanos', $valorPlanos);
      $atual->bindValue(':idenizacaoPlanos', $idenizacaoPlanos);
      $atual->bindValue(':comissaoPlanos', $comissaoPlanos);

      $atualizado = $atual->execute();


      if ($atualizado) {


      return "Atualizado com sucesso!";
      } else {

      return "Problema ao atualizar!";
      }
      }

      public function deletar($id) {




      $sql = "DELETE FROM planos WHERE idPlanos = :idPlanos";


      $deletar = $this->db->prepare($sql);
      $deletar->bindValue(":idPlanos", $id);
      $deletado = $deletar->execute();

      if ($deletado) {


      return "Deletado com sucesso!";
      } else {

      return "Não foi possivel deletar!";
      }
      }

     */

    public function getVendedorById($id) {




        $sql = "SELECT * FROM vendedores WHERE idVendedores = :id";


        $select = $this->db->prepare($sql);

        $select->bindValue(":id", $id);

        $selecionado = $select->execute();


        if ($selecionado != NULL) {

            return $select->fetch();
        } else {



            return NULL;
        }
    }

    
    public function atualizar($nomeVendedores, $telefoneVendedores, $emailVendedores, $id) {

   
        
        $sql = "UPDATE vendedores SET nomeVendedores = :nome, telefoneVendedores = :telefone, emailVendedores = :email, dataAtualizacaoVendedores = now() WHERE idVendedores = :id";

        $update = $this->db->prepare($sql);

        $update->bindValue(":nome", $nomeVendedores);
        $update->bindValue(":telefone", $telefoneVendedores);
        $update->bindValue(":email", $emailVendedores);
        $update->bindValue(":id",$id);


        $updated = $update->execute();
        
        
        if($updated){
            
            return "Atualizado com sucesso!";
            
        }else{
            
            return "Não foi possível atualizar!";
            
        }
    }
    
    
    public function delete($id){
        
        
        
    $sql = "DELETE FROM vendedores WHERE idVendedores = :id";
    
   
    
    $delete = $this->db->prepare($sql);
    
    $delete->bindValue(":id", $id);
    $deletado = $delete->execute();
    
    
    if ($deletado) {


      return "Deletado com sucesso!";
      } else {

      return "Não foi possivel deletar!";
      }
    }
    
    
    
   public function checkTelefone($telefoneVendedores){
        
        $sql = "SELECT * FROM vendedores WHERE telefoneVendedores = :telefoneVendedores";
        
        $select = $this->db->prepare($sql);
        $select->bindValue(":telefoneVendedores",$telefoneVendedores);
        
        $select->execute();
        
        
        if($select->rowCount() > 0){
            
            return TRUE;
            
        }else{
            
            
            return FALSE;
            
        }
        
        
    }

}
