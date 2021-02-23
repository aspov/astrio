<?php
namespace box\tests;

use PHPUnit\Framework\TestCase;

class BoxTest extends TestCase
{
    public function testFileBox()
    {
        $obj = \box\FileBox::getInstance();
        $obj->load();
        $key = 'key1';
        $value = 'value7';
        $obj->setData($key, $value);
        $obj->save();

        $obj->load();
        $data = $obj->getData($key);
        $this->assertTrue($data['value'] == $value);
    }

    public function testDbBox()
    {
        $obj = \box\DbBox::getInstance();
        $obj->load();
        $key = 'key1';
        $value = 'value13';
        $obj->setData($key, $value);
        $obj->save();

        $obj->load();
        $data = $obj->getData($key);
        $this->assertTrue($data['value'] == $value);
    }
}
