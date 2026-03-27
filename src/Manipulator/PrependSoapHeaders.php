<?php

declare(strict_types=1);

namespace Soap\Xml\Manipulator;

use Dom\Element;
use Dom\XMLDocument;
use Soap\Xml\Locator\SoapEnvelopeLocator;
use VeeWee\Xml\Dom\Document;
use VeeWee\Xml\Exception\RuntimeException;

final class PrependSoapHeaders
{
    /**
     * @var list<Element>
     */
    private array $soapHeaders;

    /**
     * @no-named-arguments
     */
    public function __construct(Element ... $soapHeaders)
    {
        $this->soapHeaders = $soapHeaders;
    }

    /**
     * @throws RuntimeException
     * @psalm-suppress LessSpecificReturnStatement
     * @psalm-suppress MoreSpecificReturnType
     */
    public function __invoke(XMLDocument $document): Element
    {
        $doc = Document::fromUnsafeDocument($document);
        $envelope = $doc->locate(new SoapEnvelopeLocator());

        foreach (array_reverse($this->soapHeaders) as $header) {
            /** @psalm-suppress MixedArgument */
            $envelope->insertBefore($header, $envelope->firstChild);
        }

        return $envelope;
    }
}
