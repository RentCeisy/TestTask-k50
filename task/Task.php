<?php

namespace task;

class Task {

    private $fieldsCount;
    private $chipCount;
    private $fileHandler;

    public function __construct($fieldsCount, $chipCount, $fileName)
    {
        if($this->validate($fieldsCount, $chipCount, $fileName)) {
            $this->dataHandler = new DataHandler((int)$fieldsCount, (int)$chipCount);
            $this->fileHandler = new FileHandler($fileName);
        } else {
           throw new \Exception('input error');
        }
    }

    /**
     * @return FieldCount
     */
    public function getFieldsCount()
    {
        return $this->fieldsCount;
    }

    /**
     * @param FieldCount $fieldsCount
     */
    public function setFieldsCount($fieldsCount)
    {
        $this->fieldsCount = $fieldsCount;
    }

    /**
     * @return ChipCount
     */
    public function getChipCount()
    {
        return $this->chipCount;
    }

    /**
     * @param ChipCount $chipCount
     */
    public function setChipCount($chipCount)
    {
        $this->chipCount = $chipCount;
    }

    /**
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @param string $fileName
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }

    public function validate($fieldsCount, $chipCount, $fileName) {
        $isTrueType = is_numeric($fieldsCount) && is_numeric($chipCount) && is_string($fileName);
        $isTrueNumber = (int)$fieldsCount > (int)$chipCount;
        return $isTrueNumber && $isTrueType;
    }

    public function start()
    {
        $this->dataHandler->calculateCombination();
        echo $this->dataHandler->getCombinationCount();
        $this->fileHandler->openFile();

    }


}