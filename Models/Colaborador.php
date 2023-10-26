<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 namespace Models;
 use \Core\Model;
 
class Colaborador extends Model{
    
    
    
    //function to check logiin and password
    
    public function checkLogin($login, $senha){
        
        $sql = "SELECT *  FROM colaboradores WHERE emailColaboradores = :email AND senhaColaboradores = :senha";
        
        $select = $this->db->prepare($sql);
        $select->bindValue(":email",$login);
        $select->bindValue(":senha",$senha);
        $select->execute();
        
        
        if($select->rowCount() > 0){
            
            
            
            return $select->fetch();
        }
       
    }
    
    
    
    
    
}