<?php

namespace App\Data\Entities;

use Illuminate\Validation\Validator;

class Error
{
    /**
     * @var array $errors
     */
    private $errors = [];

    /**
     * @param Validator $validator
     * @return void
     */
    public function addValidator(Validator $validator = null)
    {
        if ($validator) {
            foreach ($validator->errors()->messages() as $name => $messages) {
                $this->add($name, $messages[0]);
            }
        }
    }

    /**
     * @param string $name
     * @param string $message
     * @return void
     */
    public function add($name, $message)
    {
        $index = $this->indexOf($name);
        if ($index >= 0) {
            $this->errors[$index]['message'] .= "\n $message";
        } else {
            $this->errors[] = [
                'name' => $name,
                'message' => $message
            ];
        }

        return $this;
    }

    /**
     * @param string $name
     * @return integer $index
     */
    public function indexOf($name)
    {
        for ($index = 0; $index < $this->count(); $index++) {
            if ($this->errors[$index]['name'] == $name) {
                return $index;
            }
        }

        return -1;
    }

    /**
     * @return integer count
     */
    public function count()
    {
        return count($this->errors);
    }

    /**
     * @param string $name
     * @return string $message
     */
    public function get($name)
    {
        $index = $this->indexOf($name);
        return $index >= 0 ? $this->errors[$index]['message'] : null;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->errors;
    }
}
