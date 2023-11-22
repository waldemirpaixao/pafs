<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Email
 *
 * @author waldemir
 */

 namespace Email;
 
class Email {

   
 

   public function sendEmail($para, $assunto, $mensagem){

    $headers = 'From: naoresponda@sistema.pafs.com.br' . "\r\n" .
    'Reply-To: contato@pafs.com.br, waldemir.ufs@gmail.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

    
    $enviado  = mail($para,$assunto,$mensagem, $headers);



    return $enviado;



   }









    

}


