<?php

namespace task;

class Task {

    private $fileHandler;

    public function __construct($fieldsCount, $chipCount)
    {
        if($this->validate($fieldsCount, $chipCount)) {
            $this->dataHandler = new DataHandler((int)$fieldsCount, (int)$chipCount);
        } else {
           throw new \Exception('input error');
        }
    }

    public function setChipCount($chipCount)
    {
        $this->chipCount = $chipCount;
    }

    public function validate($fieldsCount, $chipCount) 
    {
        $isTrueType = is_numeric($fieldsCount) && is_numeric($chipCount);
        $isTrueNumber = (int)$fieldsCount > (int)$chipCount;
        return $isTrueNumber && $isTrueType;
    }

    public function start()
    {
        $this->dataHandler->goMission();
    }
}
