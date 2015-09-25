<?php
namespace VanLonden\Html\Elements;

use VanLonden\Html\Attributes\Attribute;

class Element
{
    /**
     * @var Element
     */
    protected $parent;
    /**
     * @var Element[]
     */
    protected $children;

    /**
     * @var string
     */
    protected $name;
    /**
     * @var string
     */
    protected $value;
    /**
     * @var Attribute[]
     */
    protected $attributes;

    /**
     * @param string $name
     * @param string $value
     */
    public function __construct($name, $value = null)
    {
        $this->name = $name;
        $this->value = $value;
        $this->attributes = array();
        $this->children = array();
    }

    /**
     * @param Element $element
     */
    public function appendChild(Element $element)
    {
        $this->children[] = $element;
    }

    /**
     * @param Element[] $elements
     */
    public function appendChildren(array $elements = array())
    {
        foreach ($elements as $element)
        {
            $this->appendChild($element);
        }
    }

    /**
     * @param Element $element
     */
    public function prependChild(Element $element)
    {
        $this->children = array_merge([$element], $this->children);
    }

    /**
     * @param Element $element
     */
    public function removeChild(Element $element)
    {
        $key = array_search($element, $this->children, true);
        if ($key !== false)
        {
            unset($this->children[$key]);
        }
    }

    /**
     * @param Attribute $attribute
     */
    public function addAttribute(Attribute $attribute)
    {
        $this->attributes[] = $attribute;
    }

    /**
     * @param Attribute[] $attributes
     */
    public function addAttributes(array $attributes = array())
    {
        foreach ($attributes as $attribute)
        {
            $this->addAttribute($attribute);
        }
    }

    /**
     * @param Attribute $attribute
     */
    public function removeAttribute(Attribute $attribute)
    {
        $key = array_search($attribute, $this->attributes, true);
        if ($key !== false)
        {
            unset($this->attributes[$key]);
        }
    }

    /**
     * @return $this|Element
     */
    public function getRoot()
    {
        if ($this->parent = null)
            return $this;
        else
            return $this->parent->getRoot();
    }

    /**
     * @return Element
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @return Element[]
     */
    public function getChildren()
    {
        return $this->children;
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

    /**
     * @return \VanLonden\Html\Attributes\Attribute[]
     */
    public function getAttributes()
    {
        return $this->attributes;
    }
}