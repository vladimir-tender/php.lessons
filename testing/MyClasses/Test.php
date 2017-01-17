<?php

namespace MyClasses;

class Test
{
    private $questionsObjArray;

    public function __construct($dsn, $username = "", $password = "")
    {
        try {
            $this->pdo = new \PDO($dsn, $username, $password);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $ex) {
            echo "<b>Database connection error</b>: " . $ex->getMessage() . "<br>";
        }
    }

    public function getQuestionsDB()
    {
        $sql = "SELECT * FROM test";
        return $this->sqlQuery($sql);
    }

    public function constructQuestionsObjects($REMOTE_ADDR)
    {
        $arr = $this->getQuestionsDB();
        $cnt = count($arr) - 1;
        $questionObj_array = "";


        for ($i = 0; $i <= $cnt; $i++) {
            if (isset($arr[$i]['question'])) {
                if (strpos($arr[$i]['ips'], $REMOTE_ADDR) === 1) {
                    $voted = 1;
                } else {
                    $voted = 0;
                }
                //echo $arr[$i]['question']." ---".strpos($arr[$i]['ips'], $REMOTE_ADDR)." $voted "."<br>";

                /**
                 * @param Question
                 */
                $questionObj_array[] = new Question($arr[$i]['id'], $arr[$i]['question'], $arr[$i]['ans1'],
                    $arr[$i]['ans2'], $arr[$i]['ans3'], $arr[$i]['ans4'], $arr[$i]['ans5'], $arr[$i]['vote1'], $arr[$i]['vote2'],
                    $arr[$i]['vote3'], $arr[$i]['vote4'], $arr[$i]['vote5'], $arr[$i]['ips'], $voted);
            }
        }

        $this->setQuestionsObjArray($questionObj_array);
    }

    public function setQuestionsObjArray($questionObj_array)
    {
        $this->questionsObjArray = $questionObj_array;
    }

    public function showQuestions()
    {
        $result = "";
        $objArray = $this->getQuestionsObjArray();
        //var_dump($objArray);
        foreach ($objArray as $question) {
            /**
             * @var \MyClasses\Question $question
             */
            $result .= $question->showQuestionView();
        }
        return $result;
    }

    /**
     * @param $post array
     * @param $ip string
     * @return bool|string
     */
    public function postHandler($post, $ip)
    {
        //$arr = $this->getQuestionsDB();
        $checkArr = ['ans1', 'ans2', 'ans3', 'ans4', 'ans5']; //checking post answers names

        foreach ($post as $id => $ansNum) {
            if (is_int($id) && in_array($ansNum, $checkArr) && filter_var($ip, FILTER_VALIDATE_IP)) {
                $voteNum = "vote{$ansNum[3]}";
                $sql = "SELECT {$voteNum} FROM test WHERE id = '{$id}'";
                $vote = $this->sqlQuery($sql);

                $new_vote = $vote[0][$voteNum] + 1;

                $sql = "SELECT * FROM test WHERE id = $id AND ips LIKE '%$ip%'";
                $res = $this->sqlQuery($sql);

                if (count($res) > 0) {
                    return 'Vote was considered'; //CSRF
                } else {
                    $ips = ",$ip";

                    $sql = "update test SET $voteNum = $new_vote, ips = CONCAT(IFNULL(ips,''),'$ips') WHERE id = '$id'";
                    $this->sqlQuery($sql);
                }

                return 'Vote counted.';
            }
            else
            {
                return 'Some problem.';
            }
        }


    }

    private function sqlQuery($sql)
    {
        try {
            $sth = $this->pdo->prepare($sql);
        } catch (\Exception $exception) {
            echo "Some problem with preparing {$sql} <br> {$exception} <br>";
            die();
        }
        try {
            $sth->execute();
        } catch (\Exception $exception) {
            echo "Some problem with execute query {$sql} <br> {$exception} <br>";
            die();
        }

        if (stripos($sql, 'pdate') !== 1) { //not UPDATE, because error 1 symbol checking
            return $sth->fetchAll(\PDO::FETCH_ASSOC);
        }
        else
        {
            return $sth;
        }


    }

    public function getQuestionsObjArray()
    {
        return $this->questionsObjArray;
    }


}