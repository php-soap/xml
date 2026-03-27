<?php declare(strict_types=1);

namespace Soap\Xml\Builder;

use Dom\Element;
use Dom\Node;
use VeeWee\Xml\Dom\Builder\Builder;
use function VeeWee\Xml\Dom\Builder\namespaced_element;
use function VeeWee\Xml\Dom\Locator\Node\detect_document;
use function VeeWee\Xml\Dom\Locator\root_namespace_uri;

final class SoapHeaders implements Builder
{
    /**
     * @var list<callable(Node): Element>
     */
    private array $configurators;

    /**
     * @no-named-arguments
     * @param list<callable(Node): Element> $configurators
     */
    public function __construct(callable ... $configurators)
    {
        $this->configurators = $configurators;
    }

    /**
     * @psalm-suppress MissingThrowsDocblock
     */
    public function __invoke(Node $node): Node
    {
        $document = detect_document($node);

        return namespaced_element(
            root_namespace_uri()($document) ?? '',
            'soap:Header',
            ...$this->configurators,
        )($node);
    }
}
