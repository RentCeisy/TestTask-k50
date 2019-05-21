<?php

namespace task;

class FileHandler {

    private static $instance = null;

    private $fileName;

    private $fileHandler;

    public function __construct($fileName) {
        $this->fileName = $fileName;
    }

    public static function getInstance($fileName = null)
    {
        if (self::$instance != null) {
            return self::$instance;
        }

        return new self($fileName);
    }

    /**
     * @return string
     */
    public function getFileName(): string {
        return $this->fileName;
    }

    public function openFile(): void {
        try {
            $this->fileHandler = fopen($this->fileName, 'w');
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function closeFile(): void {
        fclose($this->fileHandler);
    }

    public function saveDataToFile($data): void {
        fwrite($this->fileHandler, $data . PHP_EOL);
    }
}