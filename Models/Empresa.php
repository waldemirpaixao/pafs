<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 namespace Models;
 use \Core\Model;

 
class Empresa extends Model {
    
    
    
    
    public function getEmpresaById($idEmpresa){
        
        
        $sql = "SELECT  * FROM  empresa WHERE idEmpresa = :idEmpresa";
        
        $select = $this->db->prepare($sql);
        $select->bindValue(":idEmpresa",$idEmpresa);
        $select->execute();
       if($select->rowCount() > 0){
            
           return $select->fetch();
        }else{
            
            
            
            return NULL;
        }
        
        
    }

    public function getAllEmpresa() {




        $sql = "select * from empresa";

        $select = $this->db->prepare($sql);
        $select->execute();

        if ($select->rowCount() > 0) {

            return $select->fetch;
        } else {


            return "Dados não cadastrados";
        }
    }
    
    

    public function inserir($uploadPhoto, $cnpj, $nomeEmpresa, $sigla, $telefone, $cep, $endereco, $numero, $complemento, $pontoReferencia, $bairro, $cidade, $estado, $email) {

        $sql = "INSERT INTO empresa (nomeEmpresa, enderecoEmpresa, emailEmpresa, cepEmpresa, telefoneEmpresa, cnpjEmpresa, siglaEmpresa, dataCadastroEmpresa, dataAtualizacaoEmpresa, numeroEmpresa,complementoEmpresa, pontoReferencia, bairroEmpresa, cidadeEmpresa, estadoEmpresa, logoEmpresa) VALUES( :nomeEmpresa, :enderecoEmpresa, :emailEmpresa, :cepEmpresa, :telefoneEmpresa, :cnpjEmpresa, :siglaEmpresa, now(), now(), :numeroEmpresa, :complementoEmpresa, :pontoReferencia, :bairroEmpresa, :cidadeEmpresa, :estadoEmpresa, :logoEmpresa)";

        //  $sql = "INSERT INTO empresa (telefoneEmpresa) VALUE( :telefoneEmpresa)";


        if (count($uploadPhoto['tmp_name']) > 0) {

            $type = $uploadPhoto['type'];

            if (in_array($type, array("image/jpeg", "image/png"))) {


                $nomeDaImagem = md5(time() . rand(0, 9999)) . '.jpg';

                $retorno = move_uploaded_file($uploadPhoto['tmp_name'], 'assets/profile/' . $nomeDaImagem);

                //redimensionment
                //get the width and height

                list($width_orig, $height_orig) = getimagesize('assets/profile/' . $nomeDaImagem);

                $ratio = $width_orig / $height_orig;

                $width = 500;
                $height = 500;

                if ($width / $height > $ratio) {

                    $width = $height * $ratio;
                } else {

                    $height = $width * $ratio;
                }

                $img = imagecreatetruecolor($width, $height);

                if ($type == 'image/jpeg') {
                    $origi = imagecreatefromjpeg('assets/profile/' . $nomeDaImagem);
                } else if ('image/png') {


                    $origi = imagecreatefrompng('assets/profile/' . $nomeDaImagem);
                }



                imagecopyresampled($img, $origi, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
                imagejpeg($img, 'assets/profile/' . $nomeDaImagem, 80);
            }
        }


        /* print_r($uploadPhoto)."<br/>";
          echo $cep."<br/>";
          echo $cnpj."<br/>";
          echo $nomeEmpresa."<br/>";
          echo $sigla."<br/>";
          echo $telefone."<br/>";
          echo $endereco."<br/>";
          echo $numero."<br/>";
          echo $complemento."<br/>";
          echo $pontoReferencia."<br/>";
          echo $bairro."<br/>";
          echo $cidade."<br/>";
          echo $estado."<br/>";
          echo $email."<br/>";

          exit(); */


        $insert = $this->db->prepare($sql);



        $insert->bindValue(':nomeEmpresa', $nomeEmpresa);
        $insert->bindValue(':cnpjEmpresa', $cnpj);
        $insert->bindValue(':logoEmpresa', $nomeDaImagem);
        $insert->bindValue(':siglaEmpresa', $sigla);
        $insert->bindValue(':telefoneEmpresa', $telefone);
        $insert->bindValue(':cepEmpresa', $cep);
        $insert->bindValue(':enderecoEmpresa', $endereco);
        $insert->bindValue(':numeroEmpresa', $numero);
        $insert->bindValue(':complementoEmpresa', $complemento);
        $insert->bindValue(':pontoReferencia', $pontoReferencia);
        $insert->bindValue(':bairroEmpresa', $bairro);
        $insert->bindValue(':cidadeEmpresa', $cidade);
        $insert->bindValue(':estadoEmpresa', $estado);
        $insert->bindValue(':emailEmpresa', $email);



        $retorno = $insert->execute();


        if ($retorno) {


            return "Salvo com sucesso!";
        } else {


            return "Erro ao salvar";
        }
    }
    
    
    
    
   public function atualizar($uploadPhoto, $cnpj, $nomeEmpresa, $sigla, $telefone, $cep, $endereco, $numero, $complemento, $pontoReferencia, $bairro, $cidade, $estado, $email){
       
       
       
    
       $sql = "UPDATE empresa SET nomeEmpresa = :nomeEmpresa, enderecoEmpresa = :enderecoEmpresa, emailEmpresa = :emailEmpresa, cepEmpresa = :cepEmpresa, telefoneEmpresa = :telefoneEmpresa, cnpjEmpresa = :cnpjEmpresa, siglaEmpresa = :siglaEmpresa, dataAtualizacaoEmpresa = now(), numeroEmpresa = :numeroEmpresa,complementoEmpresa = :complementoEmpresa, pontoReferencia = :pontoReferencia, bairroEmpresa = :bairroEmpresa, cidadeEmpresa = :cidadeEmpresa, estadoEmpresa = :estadoEmpresa, logoEmpresa = :logoEmpresa  WHERE idEmpresa = :idEmpresa";
       
       $caminho = BASE_URL."assets/profile/".$_SESSION['logoEmpresa'];
       
       
      // unlink($caminho); //deletar a imagem
       
     
         if ($uploadPhoto['size'] > 0) {

            $type = $uploadPhoto['type'];

            if (in_array($type, array("image/jpeg", "image/png"))) {


                $nomeDaImagem = md5(time() . rand(0, 9999)) . '.jpg';

                $retorno = move_uploaded_file($uploadPhoto['tmp_name'], 'assets/profile/' . $nomeDaImagem);

                //redimensionment
                //get the width and height

                list($width_orig, $height_orig) = getimagesize('assets/profile/' . $nomeDaImagem);

                $ratio = $width_orig / $height_orig;

                $width = 500;
                $height = 500;

                if ($width / $height > $ratio) {

                    $width = $height * $ratio;
                } else {

                    $height = $width * $ratio;
                }

                $img = imagecreatetruecolor($width, $height);

                if ($type == 'image/jpeg') {
                    $origi = imagecreatefromjpeg('assets/profile/' . $nomeDaImagem);
                } else if ('image/png') {


                    $origi = imagecreatefrompng('assets/profile/' . $nomeDaImagem);
                }



                imagecopyresampled($img, $origi, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
                imagejpeg($img, 'assets/profile/' . $nomeDaImagem, 80);
            }
        }
        
        
         $insert = $this->db->prepare($sql);


        $insert->bindValue(':idEmpresa',$_SESSION['idEmpresa']);
        $insert->bindValue(':nomeEmpresa', $nomeEmpresa);
        $insert->bindValue(':cnpjEmpresa', $cnpj);
        if(!isset($nomeDaImagem)){

            $nomeDaImagem = "";
        }
        $insert->bindValue(':logoEmpresa', $nomeDaImagem);
        $insert->bindValue(':siglaEmpresa', $sigla);
        $insert->bindValue(':telefoneEmpresa', $telefone);
        $insert->bindValue(':cepEmpresa', $cep);
        $insert->bindValue(':enderecoEmpresa', $endereco);
        $insert->bindValue(':numeroEmpresa', $numero);
        $insert->bindValue(':complementoEmpresa', $complemento);
        $insert->bindValue(':pontoReferencia', $pontoReferencia);
        $insert->bindValue(':bairroEmpresa', $bairro);
        $insert->bindValue(':cidadeEmpresa', $cidade);
        $insert->bindValue(':estadoEmpresa', $estado);
        $insert->bindValue(':emailEmpresa', $email);
        
        $inserido = $insert-> execute();
        
        if($inserido){
            
            return "Atualizado com Sucesso!";
            
        }else{
            
            
            return "Não foi possivel atualizar!";
            
        }
        
   }
   
   
   
   public function getEmpresaByIdColaborador($idColaboradores){
       
       
       $sql = "SELECT empresa_idEmpresa FROM colaboradores WHERE idColaboradores = :idColaboradores";
       
       $select = $this->db->prepare($sql);
       $select->bindValue(":idColaboradores", $idColaboradores);
       $select->execute();
        
      
       if($select ->rowCount() > 0){
           
           
           
           $idEmpresaTrabalho = $select->fetch();
       
          $empresa = new Empresa();
          return $empresa->getEmpresaById($idEmpresaTrabalho['empresa_idEmpresa']);
         
           
           
       }else{
           
           
           
           return NULL;
       }
       
       
       
       
   }

}
