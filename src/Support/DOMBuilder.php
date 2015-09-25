<?php
namespace VanLonden\Html\Support;

use VanLonden\Html\Elements\Element;

class DOMBuilder
{
    /**
     * @var \DOMDocument
     */
    protected $doc;


    /**
     * @param \DOMDocument $doc
     */
    public function __construct(\DOMDocument $doc)
    {
        $this->doc = $doc;
    }

    /**
     * @param Element $element
     * @return \DOMElement
     */
    public function build(Element $element)
    {
        $dom = $this->createElement($element);
        return $dom;
    }

    /**
     * @param Element $element
     * @return \DOMElement
     */
    protected function createElement(Element $element)
    {
        $dom = $this->doc->createElement($element->getName(), $element->getValue());

        foreach ($element->getAttributes() as $attribute)
        {
            $dom->setAttribute($attribute->getName(), $attribute->getValue());
        }

        foreach ($element->getChildren() as $child)
        {
            $child = $this->createElement($child);
            $dom->appendChild($child);
        }

        return $this->doc->appendChild($dom);
    }
}