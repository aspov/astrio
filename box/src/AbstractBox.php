<?php

namespace box;

abstract class AbstractBox implements BoxInterface
{
    public function setData($key, $value)
    {
        
        $foundEntry = array_filter($this->data, function ($item) use ($key) {
            return $item['id'] == $key;
        });
        if (count($foundEntry) == 0) {
            $this->data[] = ['id' => $key, 'value' => $value];
            $this->newEntries[] = ['id' => $key, 'value' => $value];
        } else {
            $this->data[key($foundEntry)]['value'] = $value;
            $this->changedEntries[] = ['id' => $this->data[key($foundEntry)]['id'], 'value' => $value];
        }
    }

    public function getData($key)
    {
        $foundEntry = array_filter($this->data, function ($item) use ($key) {
            return $item['id'] == $key;
        });
        return $this->data[key($foundEntry)];
    }
}
