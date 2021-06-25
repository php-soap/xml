<?php

declare(strict_types=1);

namespace Soap\Xml\Locator;

use DOMDocument;
use DOMElement;
use VeeWee\Xml\Dom\Document;
use function VeeWee\Xml\Dom\Xpath\Configurator\namespaces;

final class SoapHeaderLocator
{
    public function __invoke(DOMDocument $document): ?DOMElement
    {
        $soapNs = $document->documentElement->namespaceURI ?? '';
        $xpath = Document::fromUnsafeDocument($document)->xpath(namespaces(['soap' => $soapNs]));

        return $xpath->query('//soap:Envelope/soap:Header')->first();
    }
}
