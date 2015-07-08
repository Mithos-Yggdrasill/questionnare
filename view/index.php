<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Question</title>
    </head>
    <body>
        <h1><?php echo $this->_question->getQuestion(); ?></h1>
        <form method="GET" action="index.php">
            <input type="hidden" id="action" name="action" value="answerQuestion" />
            <input type="hidden" id="questionId" name="questionId" value="<?php echo $this->_question->getId(); ?>" />
            <p>
                <select id="answerIndex" name="answerIndex" class="selectpicker">
                    <?php foreach ($this->_question->getAnswer() as $key => $answer) { ?>
                        <option value="<?php echo $key; ?>"><?php echo $answer->getAnswer(); ?></option>
                    <?php } ?>
                </select>
            </p>
            <p>
                <button type="submit">Volgende</button>
            </p>
        </form>
        <?php foreach ($this->_answers as $questionId => $answer) { ?>
            <p><?php //echo $this->_questions[$questionId]->getQuestion() . $answer->getAnswer(); ?></p>
        <?php } ?>
    </body>
</html>
<br>