<?php


namespace Models;

use Core\Model;
use PDOException;

class  CarenciaPlano extends Model
{


    public function inserir($dias, $idEmpresa)
    {


        $sql = "insert into carenciaPlano(diasCarenciaPlano, empresa_idEmpresa) values(:dias, :idEmpresa)";

        $inserir = $this->db->prepare($sql);

        try {


            $this->db->beginTransaction();

            $inserir->bindValue(":dias", $dias);
            $inserir->bindValue(":idEmpresa", $idEmpresa);

            $inserido = $inserir->execute();
            $comitado = $this->db->commit();



            if ($inserido && $comitado) {

                return true;
            } else {


                return false;
            }
        } catch (PDOException $ex) {

            $this->db->rollBack();
            return $ex->getMessage();
        }
    }



    public function getAllByEmpresa($idEmpresa)
    {


        $sql = "select * from carenciaPlano where empresa_idEmpresa = :idEmpresa";

        $select = $this->db->prepare($sql);

        $select->bindValue(":idEmpresa", $idEmpresa);

        $executado = $select->execute();


        if ($executado && $select->rowCount() > 0) {

            return $select->fetch();
        }else{

            return null;
        }
    }


    public function atualizar($idDias,$dias,  $idEmpresa){



        $sql = "update carenciaPlano set diasCarenciaPlano = :dias where idcarenciaPlano = :idcarenciaPlano  and empresa_idEmpresa = :idEmpresa";

        $update = $this->db->prepare($sql);



        try{

            $this->db->beginTransaction();

            $update->bindValue(":dias",$dias);
            $update->bindValue(":idcarenciaPlano",$idDias);
            $update->bindValue(":idEmpresa",$idEmpresa);


            $executado = $update->execute();
            $comitado = $this->db->commit();

            if($executado && $comitado){

                return true;
            }else{


                return false;
            }


        }catch(PDOException $ex){


            $this->db->rollBack();
            $ex->getMessage();

        }



    }
}
