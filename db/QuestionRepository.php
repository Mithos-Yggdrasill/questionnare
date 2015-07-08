<?php

require_once 'entity/Question.php';

/**
 * Description of QuestionRepository
 *
 * @author Pieter - #oSoc15
 */
class QuestionRepository {

    /**
     * The questions in this questionnaire.
     */
    public $_questions;
    
    /**
     * The next id for the questions.
     * @var type 
     */
    private $_questionId;

    public function __construct() {
        $this->_questions = array();
        $this->_questionId = 0;
    }

    public static function getInstance() {
        static $inst = null;
        if ($inst === null) {
            $inst = new QuestionRepository();
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

    public function addQuestion($question) {
        while(!empty($this->_questions[$this->_questionId])){
            $this->_questionId +=1;
        }
        $question->setId($this->_questionId);
        $this->_questions[$this->_questionId] = $question;
        $this->_questionId = $this->_questionId+1;
    }

    public function getAllQuestions() {
        return $this->_questions;
    }

}
