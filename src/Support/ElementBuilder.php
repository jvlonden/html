<?php
namespace VanLonden\Html\Support;


use VanLonden\Html\Attributes\Attribute;
use VanLonden\Html\Elements\Element;
use Mockery\CountValidator\Exception;

class ElementBuilder
{
    const TEXT = 'text';
    const ELEMENT = 'element';
    const ATTRIBUTE = 'attribute';

    /**
     * @param array $array
     * @return Element[]
     */
    public function create(array $array = array())
    {
        $elements = array();

        foreach ($array as $key => $value)
        {
            $type = $this->determineType($key, $value);
            if ($type !== self::ELEMENT)
                // TODO: Exception
                throw new Exception();

            $elements[] = $this->parseElement($key, $value);

        }

        return $elements;
    }

    protected function parseElement($tag, array $description = array())
    {
        $text = null;
        $children = array();
        $attributes = array();


        foreach ($description as $key => $value)
        {
            $type = $this->determineType($key, $value);

            switch ($type)
            {
                case self::ELEMENT:
                    $children[] = $this->parseElement($key, $value);
                    break;
                case self::ATTRIBUTE:
                    $attributes = array_merge($attributes, $this->parseAttributes($value));
                    break;
                case self::TEXT:
                    $text = $value;
                    break;
            }
        }

        $element = new Element($tag, $text);
        $element->addAttributes($attributes);
        $element->appendChildren($children);

        return $element;

    }

    /**
     * @param array $attributes
     * @return Attribute[]
     */
    protected function parseAttributes(array $attributes = array())
    {
        $result = array();

        foreach ($attributes as $key => $value)
        {
            if ($this->attrHasVal($key, $value))
                $result[] = new Attribute($key, $value);
            else
                $result[] = new Attribute($value);
        }

        return $result;
    }

    /**
     * @param $key
     * @param $value
     * @return bool
     */
    protected function attrHasVal($key, $value)
    {
        if (is_int($key))
            return false;

        return true;
    }

    /**
     * @param $key
     * @param $value
     * @return string
     */
    protected function determineType($key, $value)
    {
        if (is_array($value))
        {
            if (is_string($key))
            {
                return self::ELEMENT;
            }
            elseif (is_int($key))
            {
                return self::ATTRIBUTE;
            }
            else
            {
                // TODO: Exception
                throw new Exception();
            }
        }
        elseif (is_string($value))
        {
            return self::TEXT;
        }

        // TODO: Exception
        throw new Exception();
    }
}