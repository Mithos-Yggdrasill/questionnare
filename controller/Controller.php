<?php

require_once 'service/Questionnaire.php';

/**
 * Description of Controller
 *
 * @author Pieter
 */
class Controller {

    private $_service;
    private $_question;
    private $_questions;
    private $_answers;

    public function __construct() {
        if (isset($_SESSION['service'])) {
            $this->_service = $_SESSION['service'];
        } else {
            $this->_service = new Questionnaire();
            $_SESSION['service'] = $this->_service;
        }
        $this->_answers = array();
        $this->_questions = $this->_service->getAllQuestions();
    }

    private function getQuestionId(){
        $questionId = filter_input(INPUT_GET, 'questionId', FILTER_SANITIZE_NUMBER_INT);
        return $questionId;
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
                $this->_question = $this->_service->getCurrentQuestion();
                break;
            case 'answerQuestion' :
                $nextPage = 'index.php';
                $answerIndex = filter_input(INPUT_GET, 'answerIndex', FILTER_SANITIZE_NUMBER_INT);               
                $this->_service->answerQuestion($this->getQuestionId(), $this->_service->getCurrentQuestionAnswer($answerIndex));
                $this->_question = $this->_service->getCurrentQuestion();
                $this->_answers = $this->_service->_answers;
                break;
            case 'previousQuestion' :
                $nextPage = 'index.php';
                break;
        }
        require_once 'view/' . $nextPage;
    }
}    