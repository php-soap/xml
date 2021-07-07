<?php

declare(strict_types=1);

namespace Soap\Xml\Xpath;

use DOMXPath;
use Soap\Xml\Locator\BodyNamespaceLocator;
use VeeWee\Xml\Dom\Document;
use VeeWee\Xml\Dom\Xpath\Configurator\Configurator;
use VeeWee\Xml\Exception\RuntimeException;
use function VeeWee\Xml\Dom\Locator\root_namespace_uri;
use function VeeWee\Xml\Dom\Xpath\Configurator\namespaces;

final class EnvelopePreset implements Configurator
{
    private Document $document;

    public function __construct(Document $document)
    {
        $this->document = $document;
    }

    /**
     * @throws RuntimeException
     */
    public function __invoke(DOMXPath $xpath): DOMXPath
    {
        return namespaces(array_filter([
            'soap' => $this->document->locate(root_namespace_uri()),
            'application' => $this->document->locate(new BodyNamespaceLocator()),
        ]))($xpath);
    }
}
