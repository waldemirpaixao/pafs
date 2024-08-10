<?php

namespace Models;
use \Core\Model;
use PDO;
use PDOException;

class DependentesExtras extends Model{






    public function cadastrar($quantidadeMaxima, $preco, $idEmpresa){


        $sql = "insert into dependenteExtra (quatidadeMaxima,valor, empresa_idEmpresa) values(:quantidadeMaxima,:preco,:idEmpresa)";

        $inserir = $this->db->prepare($sql);



        try{



            $this->db->beginTransaction();


            $inserir->bindValue(":quantidadeMaxima", $quantidadeMaxima);
            $inserir->bindValue(":preco", $preco);
            $inserir->bindValue(":idEmpresa", $idEmpresa);



           $executado =  $inserir->execute();
           $comitado = $this->db->commit();


           if($executado && $comitado){


            return true;

           }else{


            return false;

           }

        }catch(PDOException $ex){

            $this->db->rollBack();

            return $ex->getMessage();

        }
       




    }


    public function atualizar($idDependenteExtra,$quantidadeMaximaAtualizar, $precoAtualizar, $idEmpresa){



        $sql = "update dependenteExtra 
        set quatidadeMaxima = :quatidadeMaxima, valor = :valor, empresa_idEmpresa = :idEmpresa 
        where iddependenteExtra = :iddependenteExtra";


        $update  = $this-> db->prepare($sql);


        try{

            $this->db->beginTransaction();


            $update->bindValue(":quatidadeMaxima",$quantidadeMaximaAtualizar);
            $update->bindValue(":valor",$precoAtualizar);
            $update->bindValue(":iddependenteExtra",$idDependenteExtra);
            $update->bindValue(":idEmpresa",$idEmpresa); 
            $executado = $update->execute();
            $comitado =  $this->db->commit();


            if($executado && $comitado){

                return true;
            }else{

                return false;
            }



        }catch(PDOException $ex){


            $this->db->rollBack();

            return $ex->getMessage();
        }





    }



    public function getAllDependentesExtras(){


        $sql = "select * from dependenteExtra";

        $select = $this->db->prepare($sql);


        $executado = $select->execute();


        if($select->rowCount() > 0 && $executado){


            return $select->fetchAll();


        }else{


            return null;
        }


    }


    public function getDependentesExtrasByEmpresa($idEmpresa){


        $sql = "select * from dependenteExtra where empresa_idEmpresa = :idEmpresa";

        $select = $this->db->prepare($sql);

        $select->bindValue(":idEmpresa",$idEmpresa);

        $executado = $select->execute();


        if($select->rowCount() > 0 && $executado){


            return $select->fetch();


        }else{


            return null;
        }


    }

}