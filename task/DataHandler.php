<?php

namespace task;

class DataHandler {

    private $fieldCount;

    private $chipCount;

    private $combinationCount;

    public function __construct($fieldCount, $chipCount)
    {
        $this->fieldCount = $fieldCount;
        $this->chipCount = $chipCount;
        $this->calculateCombination();
    }

    /**
     * @return mixed
     */
    public function getCombinationCount() {
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
    public function getFieldCount() {
        return $this->fieldCount;
    }

    /**
     * @return int
     */
    public function getChipCount() {
        return $this->chipCount;
    }

    /**
     * @return int
     */
    public function calculateCombination() {
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

}