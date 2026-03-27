<?php

declare(strict_types=1);

namespace Soap\Xml\Locator;

use Dom\Element;
use Dom\XMLDocument;
use function VeeWee\Xml\Dom\Locator\document_element;

final class SoapEnvelopeLocator
{
    public function __invoke(XMLDocument $document): Element
    {
        return document_element()($document);
    }
}
