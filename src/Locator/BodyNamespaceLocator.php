<?php

declare(strict_types=1);

namespace Soap\Xml\Locator;

use DOMDocument;

final class BodyNamespaceLocator
{
    public function __invoke(DOMDocument $document): ?string
    {
        return (new SoapBodyLocator())($document)?->firstChild?->namespaceURI;
    }
}
