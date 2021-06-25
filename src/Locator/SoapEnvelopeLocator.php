<?php

declare(strict_types=1);

namespace Soap\Xml\Locator;

use DOMDocument;
use DOMElement;

final class SoapEnvelopeLocator
{
    public function __invoke(DOMDocument $document): DOMElement
    {
        return $document->documentElement;
    }
}
