<?php

namespace App\Data\Entities;


class Order extends BaseEntity
{
    private $columnName;
    private $value;

    /**
     * @return mixed
     */
    public function getColumnName()
    {
        return $this->columnName;
    }

    /**
     * @param mixed $columnName
     */
    public function setColumnName($columnName): void
    {
        $this->columnName = $columnName;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value): void
    {
        $this->value = $value;
    }


}