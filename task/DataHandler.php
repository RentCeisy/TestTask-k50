<?php

namespace task;


use task\lib\Task_Data_Handler;

class DataHandler  implements Task_Data_Handler {

    private $fieldCount;

    private $chipCount;

    private $combinationCount;

    private $fileHandler;

    private $arrayValue = [];

    private $signDollar = "$";

    private $signUnderline = '_';

    /**
     * @return array
     */
    public function getArrayValue(): array
    {
        return $this->arrayValue;
    }

    public function __construct($fieldCount, $chipCount) {
        $this->fieldCount = $fieldCount;
        $this->chipCount = $chipCount;
        $this->setArrayValue();
        $this->fileHandler = FileHandler::getInstance();
        $this->calculateCombination();
    }

    /**
     * @return int
     */
    public function getCombinationCount(): int {
        return $this->combinationCount;
    }

    /**
     * @param int $combinationCount
     */
    public function setCombinationCount($combinationCount): void {
        $this->combinationCount = $combinationCount;
    }

    /**
     * @return int
     */
    public function getFieldCount(): int {
        return $this->fieldCount;
    }

    /**
     * @return int
     */
    public function getChipCount(): int {
        return $this->chipCount;
    }

    /**
     * @return int
     */
    public function calculateCombination(): void {
        $this->combinationCount = $this->factorial($this->fieldCount) / ($this->factorial($this->chipCount) * $this->factorial($this->fieldCount - $this->chipCount));
    }

    /**
     * @return int
     */
    public function factorial($num) {
        $result = 1;
        for($i = 1; $i <= $num; $i++) {
            $result = bcmul($result, $i);
        }
        return $result;
    }

    public function setArrayValue() {
        $signDollar = "$";
        $signUnderline = '_';
        for($i = 0; $i < $this->fieldCount; $i++) {
            if($i < $this->chipCount)
                $this->arrayValue[] = $signDollar;
            else
                $this->arrayValue[] = $signUnderline;
        }

    }


    public function presentCombination($arrayValue, $a, $b, $c = 0, $z = 0) {
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

    public function goMission() {
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