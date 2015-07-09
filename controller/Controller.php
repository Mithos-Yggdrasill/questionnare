<?php

require_once 'service/Questionnaire.php';

/**
 * Description of Controller
 *
 * @author Pieter - #oSoc15
 */
class Controller {

    private $_service;
    private $_question;
    private $_questions;

    public function __construct() {
        if (isset($_SESSION['service'])) {
            $this->_service = $_SESSION['service'];
        } else {
            $this->_service = new Questionnaire();
            $_SESSION['service'] = $this->_service;
        }
        $this->_questions = $this->_service->getAllQuestions();
    }

    private function getQuestionId(){
        $questionId = filter_input(INPUT_GET, 'questionId', FILTER_SANITIZE_NUMBER_INT);
        return $questionId;
    }
    
    private function getAnswerId(){
        $answerIndex = filter_input(INPUT_GET, 'answerIndex', FILTER_SANITIZE_NUMBER_INT);
        $answer = $this->_service->getCurrentQuestionAnswer($answerIndex);
        return $answer->getId();
    }
    
    public function processRequest() {
        $nextPage = 'index.php';
        $action = 'home';
        if (isset($_GET['action'])) {
            $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_SPECIAL_CHARS);
        }
        switch ($action) {
            case 'home':
                $nextPage = 'index.php';
                $this->_service->reset();
                $this->_question = $this->_service->getCurrentQuestion();
                break;
            case 'answerQuestion' :
                $nextPage = 'index.php';
                $questionId = $this->getQuestionId();
                $answerId = 0;//$this->getAnswerId();
                try {
                    $this->_service->answerQuestion($questionId, $answerId);
                } catch (Exception $e){
                    $nextPage = 'result.php';
                }
                $this->_question = $this->_service->getCurrentQuestion();
                break;
            case 'previousQuestion' :
                $nextPage = 'index.php';
                $this->_service->previousQuestion();
                $this->_question = $this->_service->getCurrentQuestion();
                break;
        }
        require_once 'view/' . $nextPage;
    }
}    