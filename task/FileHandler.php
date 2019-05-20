<?php

namespace task;

class FileHandler {

    private $fileName;

    public function __construct($fileName) {
        $this->fileName = $fileName;
    }

    /**
     * @return string
     */
    public function getFileName(): string {
        return $this->fileName;
    }

    public function openFile(): void {

    }

    public function closeFile(): void {

    }

    public function saveDataToFile() {

    }
}