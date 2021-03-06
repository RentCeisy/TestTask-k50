<?php

namespace task;


use task\lib\TaskDataHandler;

class DataHandler  implements TaskDataHandler {

    private $fieldCount;

    private $chipCount;

    private $combinationCount;

    private $fileHandler;

    private $arrayValue = [];

    private $signDollar = "$";

    private $signUnderline = '_';

    public function getArrayValue()
    {
        return $this->arrayValue;
    }

    public function __construct($fieldCount, $chipCount) 
    {
        $this->fieldCount = $fieldCount;
        $this->chipCount = $chipCount;
        $this->setArrayValue();
        $this->fileHandler = FileHandler::getInstance();
        $this->calculateCombination();
    }

    public function getCombinationCount() 
    {
        return $this->combinationCount;
    }

    public function setCombinationCount($combinationCount) 
    {
        $this->combinationCount = $combinationCount;
    }

    public function getFieldCount() 
    {
        return $this->fieldCount;
    }

    public function getChipCount() 
    {
        return $this->chipCount;
    }

    public function calculateCombination() 
    {
        $this->combinationCount = $this->factorial($this->fieldCount) / ($this->factorial($this->chipCount) * $this->factorial($this->fieldCount - $this->chipCount));
    }

    public function factorial($num) 
    {
        $result = 1;
        for($i = 1; $i <= $num; $i++) {
            $result = bcmul($result, $i);
        }
        return $result;
    }

    public function setArrayValue() 
    {
        $signDollar = "$";
        $signUnderline = '_';
        for($i = 0; $i < $this->fieldCount; $i++) {
            if($i < $this->chipCount)
                $this->arrayValue[] = $signDollar;
            else
                $this->arrayValue[] = $signUnderline;
        }

    }

    public function presentCombination($arrayValue, $a, $b, $c = 0, $z = 0) 
    {
        for ($i = 0 + $z; $i < $a - $b; ) {
            if ($c < $this->chipCount - 1) {
                $arrayValue = $this->presentCombination($arrayValue, $a, $b, $c+1, $z);
                for($j = 0; $j < $b-$c-1; $j++) {
                    $arrayValue[$c + $a - $b + 1 + $j] = $this->signUnderline;
                    $arrayValue[$c + 2 + $z + $j] = $this->signDollar;
                }

            }
            $arrayValue[$c + $i] = $this->signUnderline;
            $arrayValue[$c + ++$i] = $this->signDollar;
            $stringValue = implode('', $arrayValue);
            $this->fileHandler->saveDataToFile($stringValue);
            $z++;
        }
        return $arrayValue;
    }

    public function goMission() 
    {
        try {
            $this->fileHandler->openFile();
            if($this->getCombinationCount() < 10) {
                $this->fileHandler->saveDataToFile('менее 10 вариантов');
            } else {
                $this->fileHandler->saveDataToFile($this->getCombinationCount());
                $this->fileHandler->saveDataToFile(implode($this->getArrayValue()));
                $this->presentCombination($this->getArrayValue(), $this->getFieldCount(), $this->getChipCount());
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        } finally {
            $this->fileHandler->closeFile();
        }
    }
}
