<?php

namespace App\Data\Entities;


class Value
{
    private $values = [];

    public function add($name, $value)
    {
        $this->values[$name] = $value;
        return $this;
    }

    public function has($name)
    {
        return !empty($this->values[$name]);
    }

    public function count()
    {
        return count($this->values);
    }

    public function get($name)
    {
        return $this->has($name) ? $this->values[$name] : null;
    }

    public function toArray()
    {
        return $this->values;
    }
}
