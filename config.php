<?php

require './environment.php';

$config = array();
    if (ENVIRONMENT =="development"){     
        define("BASE_URL", "http://localhost/pafs/");
        $config['dbname'] = 'pafs';
        $config['host'] = 'localhost';
        $config['dbuser'] = 'waldemir';
        $config['dbpass'] = 'waldemir';
        
        //ASAAS - url base de cobranças
        define("BASE_URL_PAYMENT","https://api-sandbox.asaas.com/v3/payments");
        define("BASE_URL_CUSTOMERS","https://api-sandbox.asaas.com/v3/customers");

       
    }else{
        //alerar a configuração no servidor
        define("BASE_URL", "https://sistema.pafs.com.br/");
        $config['dbname'] = 'pafsco96_pafs';
        $config['host'] = 'localhost';
        $config['dbuser'] = 'pafsco96_systempafs';
        $config['dbpass'] = 'Sucesso@2023'; 

        //ASAAS - url base de cobranças
        define("BASE_URL_PAYMENT","https://api.asaas.com/v3/payments");
        define("BASE_URL_CUSTOMERS","https://api.asaas.com/v3/customers");
        
    }

    global $db;
   
try {
    
    $db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'],$config['dbuser'], $config['dbpass'],array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    
} catch (PDOException $pdoException) {
    
    echo $pdoException->getMessage();
    
}
