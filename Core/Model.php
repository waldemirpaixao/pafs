<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model
 *
 * @author waldemir
 */

 namespace Core;

class Model {
 
    protected $db;
    public function __construct() {
        global $db;
        
        $this->db=$db;
    }
}
