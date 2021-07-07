<?php
declare(strict_types=1);

namespace SoapTest\Xml\Unit\Builder;

use PHPUnit\Framework\TestCase;
use Soap\Xml\Builder\SoapHeaders;
use VeeWee\Xml\Dom\Document;
use function VeeWee\Xml\Dom\Builder\children;
use function VeeWee\Xml\Dom\Builder\element;
use function VeeWee\Xml\Dom\Builder\value;
use function VeeWee\Xml\Dom\Mapper\xml_string;

class SoapHeadersTest extends TestCase
{
    /** @test */
    public function it_can_create_a_header_element(): void
    {
        $builder = new SoapHeaders(
            children(
                element('user', value('josbos')),
                element('password', value('topsecret'))
            )
        );
        $doc = Document::fromXmlFile(FIXTURE_DIR.'/empty-envelope.xml');
        $headers = $doc->build($builder);

        $expected = <<<EOXML
        <soap:Header xmlns:soap="http://www.w3.org/2003/05/soap-envelope/">
            <user>josbos</user>
            <password>topsecret</password>
        </soap:Header>
        EOXML;

        self::assertXmlStringEqualsXmlString(
            $expected,
            xml_string()($headers[0])
        );
    }
}
