<?php

//TODO: door uw questions kunnen lopen
//TODO: vragen bijhouden

require_once 'entity/Answer.php';
require_once 'db/QuestionRepository.php';
require_once 'db/AnswerRepository.php';

/**
 * Description of Questionnaire
 *
 * @author Pieter - #oSoc15
 */
class Questionnaire {

    public $_answers;
    private $_questionDb;
    private $_answerDb;
    private $_current;

    /**
     *  The current question in the questionnaire.
     */
    private $_currentQuestion;

    public function __construct() {
        //initialize db
        $this->_questionDb = QuestionRepository::getInstance();
        $this->_answerDb = AnswerRepository::getInstance();

        //fill db with dummy data
        $answer1 = new Answer('Open bebouwing', 2);
        $answer2 = new Answer('Halfopen bebouwing', 3);
        $answer3 = new Answer('Gesloten bebouwing', 4);

        $answer4 = new Answer('< 1900', 5);
        $answer5 = new Answer('1901-1945', 4);
        $answer6 = new Answer('1946-1970', 3);
        $answer7 = new Answer('1970-2000', 2);
        $answer8 = new Answer('> 2000', 1);

        $this->addAnswer($answer1);
        $this->addAnswer($answer2);
        $this->addAnswer($answer3);
        $this->addAnswer($answer4);
        $this->addAnswer($answer5);
        $this->addAnswer($answer6);
        $this->addAnswer($answer7);
        $this->addAnswer($answer8);

        $question1 = new Question('Ik woon in?', 2, array($answer1, $answer2, $answer3));
        $question2 = new Question('Mijn huis is gebouwd', 3, array($answer4, $answer5, $answer6, $answer7, $answer8));
        $question3 = new Question('Mijn dak is?', 5, array(new Answer('Gemengd', 2), new Answer('Schuin', 2), new Answer('Plat', 3)));

        $this->addQuestion($question1);
        $this->addQuestion($question2);
        $this->addQuestion($question3);

        //setup service
        $this->_current = 0;
        $this->_currentQuestion = $this->getAllQuestions()[$this->_current];
        $this->_answers = array();
        
    }

    public function reset(){
        $this->_current = 0;
    }
    
    public function getAllQuestions() {
        return $this->_questionDb->getAllQuestions();
    }

    public function getCurrentQuestion() {
        if(empty($this->_currentQuestion)){
            $this->_currentQuestion = $this->getAllQuestions()[0];
        }
        return $this->_currentQuestion;
    }

    public function getCurrentQuestionAnswer($index) {
        return $this->_currentQuestion->getAnswer()[$index];
    }

    public function nextQuestion() {
        if($this->_current > count($this->getAllQuestions())-2){
            throw new Exception('kaka');
        }
        $this->_current = $this->_current + 1;
        $this->_currentQuestion = $this->getAllQuestions()[$this->_current];
    }

    public function previousQuestion() {
        //if($this->_current > 0) {
            //$this->_current -=1;
        //}
        $this->_currentQuestion = $this->getAllQuestions()[$this->_current];
    }

    public function answerQuestion($questionId, $answer) {
        $this->_answers[$questionId] = $answer;
        $this->nextQuestion();
    }

    /* *********************************************
     * CREATE ANSWERS
     * ********************************************* */

    public function addAnswer($answer) {
        $this->_answerDb->addAnswer($answer);
    }

    /* *********************************************
     * CREATE QUESTIONS
     * ********************************************* */

    public function addQuestion($question) {
        $this->_questionDb->addQuestion($question);
    }

}
