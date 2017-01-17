<?php

namespace MyClasses;

class Question
{
    private $id;
    private $question;
    private $voted;
    private $arrAnsVote;

    /**
     * @param $a1 string
     * @param $a2 string
     * @param $a3 string
     * @param $a4 string
     * @param $a5 string
     * @param $v1 int
     * @param $v2 int
     * @param $v3 int
     * @param $v4 int
     * @param $v5 int
     */
    public function setArrAnsVote($a1, $a2, $a3, $a4, $a5, $v1, $v2, $v3, $v4, $v5)
    {
        $this->arrAnsVote = [
            'ans1' => [$a1, $v1],
            'ans2' => [$a2, $v2],
            'ans3' => [$a3, $v3],
            'ans4' => [$a4, $v4],
            'ans5' => [$a5, $v5]
        ];
    }

    /**
     * @return array
     */
    public function getArrAnsVote()
    {
        return $this->arrAnsVote;
    }


    public function __construct($id, $q, $a1, $a2, $a3, $a4, $a5, $v1, $v2, $v3, $v4, $v5, $ips, $voted)
    {
        $this->setId($id);
        $this->setQuestion($q);
        $this->setVoted($voted);

        $this->setArrAnsVote($a1, $a2, $a3, $a4, $a5, $v1, $v2, $v3, $v4, $v5);
        //ArrayAnswersAndVotes
    }

    public function showQuestionView()
    {
        $result = "<b>{$this->getId()}</b>. {$this->getQuestion()} <br />";

        $ansArrAndVotes = $this->getArrAnsVote();

        $id = $this->getId();

        foreach ($ansArrAndVotes as $ansName => $answer) {
            if ($this->getVoted() > 0 && isset($answer[0])) {
                $result .= "<b>{$answer[0]}:</b> {$answer[1]} votes <br>";
            } elseif (isset($answer[0])) {
                $result .= "<input type='radio' name='$id' value='$ansName' >{$answer[0]} <br />";
            }
        }

        $result .= "<br>";
        return $result;

    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $question
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @return int
     */
    public function getVoted()
    {
        return $this->voted;
    }

    /**
     * @param int $voted
     */
    public function setVoted($voted)
    {
        $this->voted = $voted;
    }


}