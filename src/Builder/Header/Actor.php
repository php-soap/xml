<?php
declare(strict_types=1);

namespace Soap\Xml\Builder\Header;

use DOMNode;
use VeeWee\Xml\Dom\Builder\Builder;
use VeeWee\Xml\Exception\RuntimeException;
use function VeeWee\Xml\Dom\Builder\namespaced_attribute;
use function VeeWee\Xml\Dom\Locator\Node\detect_document;
use function VeeWee\Xml\Dom\Locator\root_namespace_uri;
use function VeeWee\Xml\Dom\Predicate\is_element;

final class Actor implements Builder
{
    public function __construct(
        private string $actor
    ) {
    }

    public static function next(): self
    {
        return new self('http://schemas.xmlsoap.org/soap/actor/next');
    }

    /**
     * @psalm-suppress MissingThrowsDocblock
     */
    public function __invoke(DOMNode $node): DOMNode
    {
        $document = detect_document($node);
        $namespace = root_namespace_uri()($document) ?? '';

        if (!is_element($node)) {
            throw RuntimeException::withMessage('Unable to add attribute to '.get_class($node));
        }

        return namespaced_attribute($namespace, 'soapenv:actor', $this->actor)($node);
    }
}
