<?php
declare(strict_types=1);

namespace Soap\Xml\Builder;

use Dom\Element;
use Dom\Node;
use VeeWee\Xml\Dom\Builder\Builder;
use function VeeWee\Xml\Dom\Builder\children;
use function VeeWee\Xml\Dom\Builder\namespaced_element;

final class SoapHeader implements Builder
{
    /**
     * @var list<callable(Node): Element>
     */
    private array $configurators;

    /**
     * @no-named-arguments
     * @param list<callable(Node): Element> $configurators
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
    public function __invoke(Node $node): Node
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
