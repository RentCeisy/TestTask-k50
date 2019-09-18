<?php

namespace task;

class FileHandler {

    private static $instance;

    private $fileName = 'text.txt';

    private $fileHandler;
    public function __construct() 
    {

    }

    public static function getInstance()
    {
        if (self::$instance != null) {
            return self::$instance;
        }

        return new self();
    }

    public function getFileName()
    {
        return $this->fileName;
    }

    public function openFile()
    {
        try {
            $this->fileHandler = fopen($this->fileName, 'w');
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }

    public function closeFile()
    {
        fclose($this->fileHandler);
    }

    public function saveDataToFile($data)
    {
        fwrite($this->fileHandler, $data . PHP_EOL);
    }
}
