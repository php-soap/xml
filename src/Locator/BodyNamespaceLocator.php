<?php

declare(strict_types=1);

namespace Soap\Xml\Locator;

use DOMDocument;
use VeeWee\Xml\Exception\RuntimeException;

final class BodyNamespaceLocator
{
    /**
     * @psalm-suppress UndefinedPropertyFetch - psalm gets lost
     * @psalm-suppress MixedReturnStatement - psalm gets lost
     * @psalm-suppress MixedPropertyFetch - psalm gets lost
     * @psalm-suppress MixedInferredReturnType - psalm gets lost
     * @throws RuntimeException
     */
    public function __invoke(DOMDocument $document): ?string
    {
        return (new SoapBodyLocator())($document)?->firstElementChild?->namespaceURI;
    }
}
