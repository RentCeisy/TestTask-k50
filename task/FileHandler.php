<?php

namespace task;

class FileHandler {

    private static $instance = null;

    private $fileName;

    private $fileHandler;

    public static function getInstance()
    {
        if (self::$instance != null) {
            return self::$instance;
        }

        return new self();
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

    /**
     * @param mixed $fileName
     */
    public function setFileName($fileName): void
    {
        $this->fileName = $fileName;
    }

    public function closeFile(): void {
        fclose($this->fileHandler);
    }

    public function saveDataToFile($data): void {
        fwrite($this->fileHandler, $data . PHP_EOL);
    }
}