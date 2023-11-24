<?php

declare(strict_types=1);

namespace Soap\Xml\Locator;

use DOMDocument;
use DOMElement;
use VeeWee\Xml\Dom\Document;
use VeeWee\Xml\Exception\RuntimeException;
use function VeeWee\Xml\Dom\Locator\root_namespace_uri;
use function VeeWee\Xml\Dom\Xpath\Configurator\namespaces;

final class SoapBodyLocator
{
    /**
     * @throws RuntimeException
     */
    public function __invoke(DOMDocument $document): ?DOMElement
    {
        $soapNs = root_namespace_uri()($document) ?? '';
        $xpath = Document::fromUnsafeDocument($document)->xpath(namespaces(['soap' => $soapNs]));

        return $xpath->query('//soap:Envelope/soap:Body')->expectAllOfType(DOMElement::class)->first();
    }
}
