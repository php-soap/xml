<?php declare(strict_types=1);

namespace Soap\Xml\Builder;

use DOMElement;
use DOMNode;
use VeeWee\Xml\Dom\Builder\Builder;
use function VeeWee\Xml\Dom\Builder\namespaced_element;
use function VeeWee\Xml\Dom\Locator\Node\detect_document;
use function VeeWee\Xml\Dom\Locator\root_namespace_uri;

final class SoapHeaders implements Builder
{
    /**
     * @var list<callable(DOMNode): DOMElement>
     */
    private array $configurators;

    /**
     * @no-named-arguments
     * @param list<callable(DOMNode): DOMElement> $configurators
     */
    public function __construct(callable ... $configurators)
    {
        $this->configurators = $configurators;
    }

    /**
     * @psalm-suppress MissingThrowsDocblock
     */
    public function __invoke(DOMNode $node): DOMNode
    {
        $document = detect_document($node);

        return namespaced_element(
            root_namespace_uri()($document) ?? '',
            'soap:Header',
            ...$this->configurators,
        )($node);
    }
}
