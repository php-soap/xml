<?php

declare(strict_types=1);

namespace Soap\Xml\Manipulator;

use DOMDocument;
use DOMElement;
use Soap\Xml\Locator\SoapEnvelopeLocator;
use VeeWee\Xml\Dom\Document;
use VeeWee\Xml\Exception\RuntimeException;

final class PrependSoapHeaders
{
    private DOMElement $soapHeaders;

    public function __construct(DOMElement $soapHeaders)
    {
        $this->soapHeaders = $soapHeaders;
    }

    /**
     * @throws RuntimeException
     * @psalm-suppress LessSpecificReturnStatement
     * @psalm-suppress MoreSpecificReturnType
     */
    public function __invoke(DOMDocument $document): DOMElement
    {
        $doc = Document::fromUnsafeDocument($document);
        $envelope = $doc->locate(new SoapEnvelopeLocator());

        return $envelope->insertBefore($this->soapHeaders, $envelope->firstChild);
    }
}
