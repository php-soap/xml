<?php

declare(strict_types=1);

namespace Soap\Xml\Locator;

use Dom\Element;
use Dom\XMLDocument;

final class SoapEnvelopeLocator
{
    /** @psalm-suppress MixedReturnStatement */
    public function __invoke(XMLDocument $document): Element
    {
        return $document->documentElement;
    }
}
