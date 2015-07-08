<?php

require_once 'Identifier.php';

/**
 * This class is the respresentation of a answer to a certain question. It
 * has a value to which this answer is accounted for in the algorithm to 
 * determine the ecolabel.
 *
 * @author Pieter - #oSoc15
 */
class Answer extends Identifier {

    /**
     *  The answer to be displayed to the user.
     */
    private $_answer;

    /**
     *  The value this answer has for the algorithm to calculate the ecolabel.
     */
    private $_value;

    /**
     * The constructor for an Answer
     * @param $answer The sentence which is the answer
     * @param $value The value this answer has for the ecolabel-algorithm
     */
    public function __construct($answer = 'BEST ANSWER EVER', $value = 1) {
        $this->_answer = $answer;
        $this->_value = $value;
    }

    /**
     * The setter for the anwer
     * @param The sentence of the answer
     */
    public function setAnswer($answer) {
        $this->_answer = $answer;
    }

    /**
     * The getter for the answer.
     * @return The sentence of the answer
     */
    public function getAnswer() {
        return $this->_answer;
    }

    /**
     * The setter for the value.
     * @param The value of the answer
     */
    public function setValue($value) {
        $this->_value = $value;
    }

    /**
     * The getter for the value.
     * @return The value of the value. 
     */
    public function getValue() {
        return $this->_value;
    }

}
