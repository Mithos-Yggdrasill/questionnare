<?php

/**
 * Description of House
 *
 * @author Pieter - #oSoc15
 */
class House {
    
    private $_info;
    
    public function __construct(){
        $this->_info = array();
    }
    
    public function addInfo($question, $answer){
        $this->_info[$question] = $answer;
    }
    
    public function getInfo(){
        return $this->_info;
    }
    
}
