<?php
namespace buildok\helpers;

/**
 * ArrayWrapper class
 *
 * Helper for processing key-value arrays
 */

class ArrayWrapper
{
    /**
     * Array of data
     * @var array
     */
    protected $data;

    /**
     * Constructor
     * @param array $dataArray
     */
    public function __construct($dataArray = [])
    {
        $this->data = is_array($dataArray) ? $dataArray : [];
    }

    /**
     * Returns array of data
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Returns object of data
     * @return \stdClass
     */
    public function getObject()
    {
        return (object)$this->data;
    }

    /**
     * Reset data
     * @param array $dataArray
     */
    public function set($dataArray = [])
    {
        $this->data = is_array($dataArray) ? $dataArray : [];
    }

    /**
     * Overloaded
     * @param string $name Property name
     * @return mixed
     */
    public function __get($name)
    {
        $value = array_key_exists($name, $this->data) ? $this->data[$name] : null;

        return $value;
    }

    /**
     * Overloaded
     * @param string $name Property name
     * @param mixed $value Property value
     */
    public function __set($name, $value)
    {
        if(is_null($value)) {
            unset($this->data[$name]);
        } else {
            $this->data[$name] = $value;
        }

    }
}