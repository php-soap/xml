<?php

namespace Soap\Xml\Builder;

use DOMElement;
use DOMNode;
use Soap\Xml\Locator\SoapEnvelopeLocator;
use VeeWee\Xml\Dom\Builder\Builder;
use function VeeWee\Xml\Dom\Builder\namespaced_element;
use function VeeWee\Xml\Dom\Locator\Node\detect_document;
use function VeeWee\Xml\Dom\Locator\root_namespace_uri;

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

        return namespaced_element(
            root_namespace_uri()($document) ?? '',
            'soap:Header',
            ...$this->configurators
        )($node);
    }
}
