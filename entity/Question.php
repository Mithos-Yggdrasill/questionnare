<?php

require_once 'entity/Identifier.php';

/**
 * This class is the respresentation of a question which can be asked to 
 * determine the label of the house in the questionnairy. It has the weight in 
 * which this question's answer is accounted for in the algorithm to determine 
 * the ecolabel. It has an array of possible answers to this question.
 *
 * @author Pieter - #oSoc15
 */
class Question extends Identifier {
    /*
     * The sentence displayed to the user.
     */

    private $_question;

    /**
     * The amount in which this questions contributes to the value of the label.
     */
    private $_weight;

    /**
     * An array with all the possible answer to this question.
     */
    private $_answer;

    /**
     * A constructor which creates a question with it's possible answers.
     * @param $question    The sentence to be displayed to the user
     * @param $weight   The weight in which this answer contributes to the 
     * @param $answer  The array of possible answers
     */
    public function __construct($question = 'does this work?', $weight = 1, $answer = array('yes', 'no')) {
        $this->_question = $question;
        $this->_weight = $weight;
        $this->_answer = $answer;
    }

    /**
     * The getter for the sentence of the question.
     * @return The sentence to be asked.
     */
    public function getQuestion() {
        return $this->_question;
    }

    /**
     * THe getter for the weight of the question.
     * @return The weight of the question, type unsigned
     */
    public function getWeight() {
        return $this->_weight;
    }

    /**
     * The getter for the answer of the question.
     * @return The array of possible answers to this question.
     */
    public function getAnswer() {
        return $this->_answer;
    }

    /**
     * The getter for the value of the question.
     * @return The value of this question.
     */
    public function getValue() {
        return $this->_answer->getValue();
    }

}
