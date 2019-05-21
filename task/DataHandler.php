<?php

namespace task;


use task\lib\Task_Data_Handler;

class DataHandler  implements Task_Data_Handler {

    private $fieldCount;

    private $chipCount;

    private $combinationCount;

    private $fileHandler;

    public function __construct($fieldCount, $chipCount) {
        $this->fieldCount = $fieldCount;
        $this->chipCount = $chipCount;
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
    public function factorial($num): int {
        $result = 1;
        for($i = 1; $i <= $num; $i++) {
            $result *= $i;
        }
        return $result;
    }


    public function presentCombination() {
        for ($i = 1; $i < $this->fieldCount;) {

        }
    }
}