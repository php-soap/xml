<?php
declare(strict_types=1);

namespace SoapTest\Xml\Unit\Manipulator;

use PHPUnit\Framework\TestCase;
use Soap\Xml\Builder\SoapHeaders;
use Soap\Xml\Manipulator\PrependSoapHeaders;
use VeeWee\Xml\Dom\Document;
use function VeeWee\Xml\Dom\Builder\attribute;

final class PrependSoapHeadersTest extends TestCase
{
    public function test_it_can_prepend_no_header(): void
    {
        $doc = Document::fromXmlFile(FIXTURE_DIR.'/empty-envelope-with-body.xml');
        $doc->manipulate(new PrependSoapHeaders());

        $expected = <<<EOXML
        <soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope/"
                       soap:encodingStyle="http://www.w3.org/2003/05/soap-encoding">
            <soap:Body></soap:Body>
        </soap:Envelope>
        EOXML;

        static::assertXmlStringEqualsXmlString($expected, $doc->toXmlString());
    }


    public function test_it_can_prepend_a_soap_header_on_an_envelope(): void
    {
        $doc = Document::fromXmlFile(FIXTURE_DIR.'/empty-envelope-with-body.xml');
        $headers = $doc->build(new SoapHeaders())[0];

        $doc->manipulate(new PrependSoapHeaders($headers));

        $expected = <<<EOXML
        <soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope/"
                       soap:encodingStyle="http://www.w3.org/2003/05/soap-encoding">
            <soap:Header></soap:Header>
            <soap:Body></soap:Body>
        </soap:Envelope>
        EOXML;

        static::assertXmlStringEqualsXmlString($expected, $doc->toXmlString());
    }

    public function test_it_can_prepend_mulitple_soap_header_on_an_envelope(): void
    {
        $doc = Document::fromXmlFile(FIXTURE_DIR.'/empty-envelope-with-body.xml');
        $headers = $doc->build(
            new SoapHeaders(),
            new SoapHeaders(attribute('id', '2')),
        );

        $doc->manipulate(new PrependSoapHeaders(...$headers));

        $expected = <<<EOXML
        <soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope/"
                       soap:encodingStyle="http://www.w3.org/2003/05/soap-encoding">
            <soap:Header></soap:Header>
            <soap:Header id="2"></soap:Header>
            <soap:Body></soap:Body>
        </soap:Envelope>
        EOXML;

        static::assertXmlStringEqualsXmlString($expected, $doc->toXmlString());
    }
}
