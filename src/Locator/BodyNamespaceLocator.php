<?php

declare(strict_types=1);

namespace Soap\Xml\Locator;

use Dom\XMLDocument;
use VeeWee\Xml\Exception\RuntimeException;

final class BodyNamespaceLocator
{
    /**
     * @throws RuntimeException
     */
    public function __invoke(XMLDocument $document): ?string
    {
        return (new SoapBodyLocator())($document)?->firstElementChild?->namespaceURI;
    }
}
