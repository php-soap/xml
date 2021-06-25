<?php

namespace Soap\Xml\Builder;

use DOMElement;
use DOMNode;
use VeeWee\Xml\Dom\Builder\Builder;
use function VeeWee\Xml\Dom\Builder\namespaced_element;
use function VeeWee\Xml\Dom\Locator\Node\detect_document;

class SoapHeaders implements Builder
{
    /**
     * @var callable(DOMNode): DOMElement
     */
    private array $configurators;

    /**
     * @param callable(DOMNode): DOMElement ...$configurators
     */
    public function __construct(callable ... $configurators)
    {
        $this->configurators = $configurators;
    }

    /**
     * @param DOMNode $node
     * @param callable(DOMElement): DOMElement ...$configurators
     */
    public function __invoke(DOMNode $node): DOMNode
    {
        $document = detect_document($node);

        return namespaced_element($document->namespaceURI, 'soap:Header', ...$this->configurators)($node);
    }
}
