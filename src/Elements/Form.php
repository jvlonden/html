<?php
namespace VanLonden\Html\Elements;


class Form extends Element
{
    public function __construct($value, $action, $method = 'POST')
    {
        parent::__construct('form', $value);


    }

}