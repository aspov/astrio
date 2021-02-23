<?php

namespace box;

class DbBox extends AbstractBox
{
    protected $data = [];
    protected $newEntries = [];
    protected $changedEntries = [];
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
        $mysqli = mysqli_connect("localhost", "root", "", "test");
        $result = $mysqli->query('SELECT * FROM storage');
        $this->data = $result->fetch_all(MYSQLI_ASSOC);
        $result->close();
        $mysqli->close();
    }
    public function save()
    {
        try {
            $mysqli = mysqli_connect("localhost", "root", "", "test");
            $mysqli->begin_transaction();
            if (count($this->newEntries) > 0) {
                foreach ($this->newEntries as $newEntry) {
                    $mysqli->query("INSERT INTO storage VALUES ('{$newEntry['id']}', '{$newEntry['value']}')");
                }
            }
            if (count($this->changedEntries) > 0) {
                foreach ($this->changedEntries as $changedEntry) {
                    $mysqli->query("UPDATE storage SET value ='{$changedEntry['value']}' WHERE id ='{$changedEntry['id']}'");
                }
            }
            $mysqli->commit();
        } catch (mysqli_sql_exception $exception) {
            $mysqli->rollback();
            throw $exception;
        }
    }
}
