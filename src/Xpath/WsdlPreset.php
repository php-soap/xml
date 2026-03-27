<?php

declare(strict_types=1);

namespace Soap\Xml\Xpath;

use Dom\XPath;
use Soap\Xml\Xmlns;
use VeeWee\Xml\Dom\Document;
use VeeWee\Xml\Dom\Xpath\Configurator\Configurator;
use function Psl\Dict\filter;
use function Psl\Dict\merge;
use function VeeWee\Xml\Dom\Locator\document_element;
use function VeeWee\Xml\Dom\Xpath\Configurator\namespaces;

final class WsdlPreset implements Configurator
{
    private Document $document;

    public function __construct(Document $document)
    {
        $this->document = $document;
    }

    public function __invoke(XPath $xpath): XPath
    {
        $tns = $this->document->map(document_element())->getAttribute('targetNamespace');

        return namespaces(filter(
            merge(
                [
                    'schema' => Xmlns::xsd()->value(),
                    'soap' => Xmlns::soap()->value(),
                    'soap12' => Xmlns::soap12()->value(),
                    'wsdl' => Xmlns::wsdl()->value(),
                ],
                $tns !== null && $tns !== '' ? ['tns' => $tns] : []
            )
        ))($xpath);
    }
}
