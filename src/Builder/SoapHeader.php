<?php
declare(strict_types=1);

namespace Soap\Xml\Builder;

use DOMElement;
use DOMNode;
use VeeWee\Xml\Dom\Builder\Builder;
use function VeeWee\Xml\Dom\Builder\children;
use function VeeWee\Xml\Dom\Builder\namespaced_element;

final class SoapHeader implements Builder
{
    /**
     * @var list<callable(DOMNode): DOMElement>
     */
    private array $configurators;

    /**
     * @no-named-arguments
     * @param list<callable(DOMNode): DOMElement> $configurators
     */
    public function __construct(
        private string $namespace,
        private string $name,
        callable ... $configurators,
    ) {
        $this->configurators = $configurators;
    }

    /**
     * @psalm-suppress MissingThrowsDocblock
     */
    public function __invoke(DOMNode $node): DOMNode
    {
        return children(
            namespaced_element(
                $this->namespace,
                $this->name,
                ...$this->configurators,
            )
        )($node);
    }
}
