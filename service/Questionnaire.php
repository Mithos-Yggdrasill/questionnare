<?php

//TODO: door uw questions kunnen lopen

require_once 'entity/Answer.php';
require_once 'entity/House.php';
require_once 'db/QuestionRepository.php';
require_once 'db/AnswerRepository.php';

/**
 * Description of Questionnaire
 *
 * @author Pieter - #oSoc15
 */
class Questionnaire {

    private $_questionDb;
    private $_answerDb;
    private $_house;

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

        $answer9 = new Answer('Gemengd', 2);
        $answer10 = new Answer('Schuin', 2);
        $answer11 = new Answer('Plat', 3);

        $this->addAnswer($answer1);
        $this->addAnswer($answer2);
        $this->addAnswer($answer3);
        $this->addAnswer($answer4);
        $this->addAnswer($answer5);
        $this->addAnswer($answer6);
        $this->addAnswer($answer7);
        $this->addAnswer($answer8);
        $this->addAnswer($answer9);
        $this->addAnswer($answer10);
        $this->addAnswer($answer11);

        $question1 = new Question('Ik woon in?', 2, array($answer1, $answer2, $answer3));
        $question2 = new Question('Mijn huis is gebouwd', 3, array($answer4, $answer5, $answer6, $answer7, $answer8));
        $question3 = new Question('Mijn dak is?', 5, array($answer9, $answer10, $answer11));

        $this->addQuestion($question1);
        $this->addQuestion($question2);
        $this->addQuestion($question3);

        //setup service
        $this->_currentQuestion = $this->getAllQuestions()[0];
        $this->_house = new House();
    }

    public function reset() {
        $this->_house = new House();
        $this->_currentQuestion = $this->getAllQuestions()[0];
    }

    public function getAllQuestions() {
        return $this->_questionDb->getAllQuestions();
    }

    public function getCurrentQuestion() {
        if (empty($this->_currentQuestion)) {
            $this->_currentQuestion = $this->getAllQuestions()[0];
        }
        return $this->_currentQuestion;
    }

    public function getCurrentQuestionAnswer($index) {
        return $this->_currentQuestion->getAnswer()[$index];
    }

    public function answerQuestion($questionId, $answerId) {
        $this->_house->addInfo($questionId, $answerId);
        $this->nextQuestion();
    }

    public function nextQuestion() {
        $answerdQuestionIds = array_keys($this->_house->getInfo());
        $notAnsweredQuestions = $this->getNotAnsweredQuestion($answerdQuestionIds);
        if (empty($notAnsweredQuestions)) {
            throw new Exception('kaka');
        }
        $this->_currentQuestion = $notAnsweredQuestions[0];
    }

    /*     * ********************************************
     * CREATE ANSWERS
     * ********************************************* */

    public function addAnswer($answer) {
        $this->_answerDb->addAnswer($answer);
    }

    public function getAnswer($answerId) {
        return $this->_answerDb->getAnswer($answerId);
    }

    /*     * ********************************************
     * CREATE QUESTIONS
     * ********************************************* */

    public function addQuestion($question) {
        $this->_questionDb->addQuestion($question);
    }

    public function getNotAnsweredQuestion($answeredQuestionIds) {
        return $this->_questionDb->getAllQuestionsButThese($answeredQuestionIds);
    }

    public function getQuestion($questionId) {
        return $this->_questionDb->getQuestion($questionId);
    }

}
