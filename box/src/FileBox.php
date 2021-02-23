<?php

namespace box;

class FileBox extends AbstractBox
{
    protected $data = [];
    protected $newEntries = [];
    protected $changedEntries = [];
    private $filePath = __DIR__ . '/../file';
    protected static $instance;

    private function __construct()
    {
        //
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self;
        }
 
        return self::$instance;
    }
 
    private function __clone()
    {
        //
    }

    private function __wakeup()
    {
        //
    }

    public function load()
    {
        $this->data = unserialize(file_get_contents($this->filePath));
    }
    public function save()
    {
        $this->data = file_put_contents($this->filePath, serialize($this->data));
        $this->newEntries = [];
        $this->changedEntries = [];
    }
}
