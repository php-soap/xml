<?php

declare(strict_types=1);

namespace Soap\Xml\Xpath;

use DOMXPath;
use VeeWee\Xml\Dom\Document;
use VeeWee\Xml\Dom\Xpath\Configurator\Configurator;
use function VeeWee\Xml\Dom\Locator\root_namespace_uri;
use function VeeWee\Xml\Dom\Xpath\Configurator\namespaces;

class WsdlPreset implements Configurator
{
    private Document $document;

    public function __construct(Document $document)
    {
        $this->document = $document;
    }

    public function __invoke(DOMXPath $xpath): DOMXPath
    {
        namespaces([
            'wsdl', $this->document->locate(root_namespace_uri()),
        ])($xpath);
    }
}
