<?php

namespace task;

class Task {

    private $fieldsCount;
    private $chipCount;
    private $fileHandler;

    public function __construct($fieldsCount, $chipCount, $fileName)
    {
        if($this->validate($fieldsCount, $chipCount, $fileName)) {
            $this->fileHandler = FileHandler::getInstance($fileName);
            $this->dataHandler = new DataHandler((int)$fieldsCount, (int)$chipCount);
        } else {
           throw new \Exception('input error');
        }
    }

    public function getFieldsCount()
    {
        return $this->fieldsCount;
    }

    public function setFieldsCount($fieldsCount)
    {
        $this->fieldsCount = $fieldsCount;
    }

    public function getChipCount()
    {
        return $this->chipCount;
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
        $this->fileHandler->openFile();
        if($this->dataHandler->getCombinationCount() < 10) {
            $this->fileHandler->saveDataToFile('менее 10 вариантов');
        } else {
            $this->fileHandler->saveDataToFile($this->dataHandler->getCombinationCount());
            $this->dataHandler->presentCombination();
        }

        $this->fileHandler->closeFile();

    }
}