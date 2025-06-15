<?php


namespace Models;

use Core\Model;
use Mpdf\Utils\Arrays;
use PDOException;

class Integracoes extends Model
{
    public function inserir($idEmpresa, $nomeDoBanco, $chave)
    {
        $sql = "INSERT INTO integracao(nomeBanco, chave, empresa_idEmpresa) VALUES(:nomeBanco, :chave, :idEmpresa)";
        $inserir = $this->db->prepare($sql);

        try {
            $this->db->beginTransaction();

            $inserir->bindValue(":nomeBanco", $nomeDoBanco);
            $inserir->bindValue(":idEmpresa", $idEmpresa);
            $inserir->bindValue(":chave", $chave);

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

    public function checKIntegracao($idEmpresa, $nomeBanco, $chave)
    {
        $sql = "SELECT * FROM integracao WHERE empresa_idEmpresa = :idEmpresa AND chave = :chave";
        $check = $this->db->prepare($sql);

        $check->bindValue(":idEmpresa", $idEmpresa);
        $check->bindValue(":chave", $chave);
        $check->execute();

         $contagem  = $check->rowCount(); // Debugging line to check for errors
        
       
        if ($check->rowCount() > 0) {
            return true; // Já existe uma integração com esse banco
        } else {
            return false; // Não existe integração com esse banco
        }
    }
    public function getIntegracoes($idEmpresa)
    {
        $sql = "SELECT * FROM integracao WHERE empresa_idEmpresa = :idEmpresa";
        $query = $this->db->prepare($sql);
        $query->bindValue(":idEmpresa", $idEmpresa);
        $query->execute();

        if ($query->rowCount() > 0) {
            return $query->fetchAll();
        } else {
            return array(); // Retorna um array vazio se não houver integrações
        }
    }
    public function excluir($idIntegracao)
    {
        $sql = "DELETE FROM integracao WHERE idIntegracao = :idIntegracao";
        $excluir = $this->db->prepare($sql);

        $excluir->bindValue(":idIntegracao", $idIntegracao);
        return $excluir->execute();
    }

    public function getIntegracaoById($idIntegracao)
    {
        $sql = "SELECT * FROM integracao WHERE idIntegracao = :idIntegracao";
        $query = $this->db->prepare($sql);
        $query->bindValue(":idIntegracao", $idIntegracao);
        $query->execute();

        if ($query->rowCount() > 0) {
            return $query->fetch();
        } else {
            return null; // Retorna null se não encontrar a integração
        }
    }
}


