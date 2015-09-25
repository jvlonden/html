<?php
namespace VanLonden\Html\Attributes;

class Attribute
{
    /**
     * @var string $name
     */
    protected $name;
    /**
     * @var string|null $value
     */
    protected $value;

    /**
     * @param string $name
     * @param string $value
     */
    public function __construct($name, $value = null)
    {
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }


}