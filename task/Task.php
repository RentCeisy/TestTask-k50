<?php

namespace task;

class Task {

    private $fileHandler;

    public function __construct($fieldsCount, $chipCount, $fileName)
    {
        if($this->validate($fieldsCount, $chipCount, $fileName)) {
            $this->dataHandler = new DataHandler((int)$fieldsCount, (int)$chipCount, $fileName);
        } else {
           throw new \Exception('input error');
        }
    }

    public function setChipCount($chipCount)
    {
        $this->chipCount = $chipCount;
    }

    public function validate($fieldsCount, $chipCount, $fileName) {
        $isTrueType = is_numeric($fieldsCount) && is_numeric($chipCount) && is_string($fileName);
        $isTrueNumber = (int)$fieldsCount > (int)$chipCount;
        return $isTrueNumber && $isTrueType;
    }

    public function start()
    {
        $this->dataHandler->goMission();
        die();

    }
}