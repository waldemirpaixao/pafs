<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 namespace Models;
 use \Core\Model;

class SeguroDependente extends Model{
    
    
    
    
    //inserir planos
    
    public function inserir($valorSeguroApolice,$numeroApolice,$idClientes,$idEmpresa){
        
        
      
        
        $sql = "INSERT INTO seguroDependente(valorSeguroDependente, numeroApoliceSeguroDependente, dataSeguroDependenteInicio,dataSeguroDependentefinal, dataCadastroSeguroDependente,Dependentes_idDependentes,Dependentes_clientes_idclientes,empresa_idEmpresa)"
                . " VALUES (:valorSeguroApolice,:numeroApolice,now(),now(),now(),:idClientes,:idEmpresa)";
          
       
        $inserir = $this->db->prepare($sql);
        $inserir->bindValue(':valorSeguroApolice',$valorSeguroApolice);
        $inserir->bindValue(':numeroApolice',$numeroApolice);
        $inserir->bindValue(':idClientes', $idClientes);
        $inserir->bindValue(':idEmpresa', $idEmpresa);
        
        
        
        $inserido = $inserir->execute();
        
        
        
   
    }
    
    
    
}