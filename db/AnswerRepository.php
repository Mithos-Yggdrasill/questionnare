<?php

require_once 'entity/Answer.php';

/**
 * Description of AnswerRepository
 *
 * @author Pieter - #oSoc15
 */
class AnswerRepository {

    /**
     * The answers in this questionnaire.
     */
    public $_answers;
    
    /**
     * The next id for the answers.
     */
    private $_answerId;

    public function __construct() {
        $this->_answers = array();
        $this->_answerId = 0;
    }

    public static function getInstance() {
        static $inst = null;
        if ($inst === null) {
            $inst = new AnswerRepository();
        }
        return $inst;
    }

    /**
     * Private clone method to prevent cloning of the instance of the
     * *Singleton* instance.
     *
     * @return void
     */
    private function __clone() {
        
    }

    public function addAnswer($answer) {
        while(!empty($this->_answers[$this->_answerId])){
            $this->_answerId +=1;
        }
        $answer->setId($this->_answerId);
        $this->_answers[$this->_answerId] = $answer;
        $this->_answerId = $this->_answerId+1;
    }
    
    public function getAnswer($answerId){
        return $this->_answers[$answerId];
    }

    public function getAllAnswers() {
        return $this->_answers;
    }

}
