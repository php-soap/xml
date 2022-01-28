<?php
declare(strict_types=1);

namespace SoapTest\Xml\Unit\Builder;

use PHPUnit\Framework\TestCase;
use Soap\Xml\Builder\Header\Actor;
use Soap\Xml\Builder\Header\MustUnderstand;
use Soap\Xml\Builder\SoapHeader;
use Soap\Xml\Builder\SoapHeaders;
use Soap\Xml\Manipulator\PrependSoapHeaders;
use VeeWee\Xml\Dom\Document;
use function VeeWee\Xml\Dom\Builder\children;
use function VeeWee\Xml\Dom\Builder\namespaced_element;
use function VeeWee\Xml\Dom\Builder\value;
use function VeeWee\Xml\Dom\Configurator\comparable;

final class SoapHeaderTest extends TestCase
{
    public function test_it_can_create_a_header_element(): void
    {
        $tns = 'https://foo.bar';
        $builder = new SoapHeaders(
            new SoapHeader(
                $tns,
                'x:Auth',
                children(
                    namespaced_element($tns, 'x:user', value('josbos')),
                    namespaced_element($tns, 'x:password', value('topsecret'))
                )
            ),
            new SoapHeader($tns, 'Acting', Actor::next()),
            new SoapHeader($tns, 'Understanding', new MustUnderstand())
        );
        $doc = Document::fromXmlFile(FIXTURE_DIR.'/empty-envelope.xml');
        $headers = $doc->build($builder);
        $doc->manipulate(new PrependSoapHeaders(...$headers));

        $expected = <<<EOXML
        <soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope/"
                       soap:encodingStyle="http://www.w3.org/2003/05/soap-encoding">
            <soap:Header xmlns:soap="http://www.w3.org/2003/05/soap-envelope/">
                <x:Auth xmlns:x="https://foo.bar">
                    <x:user>josbos</x:user>
                    <x:password>topsecret</x:password>
                </x:Auth>
                <Acting xmlns="https://foo.bar" soap:actor="http://schemas.xmlsoap.org/soap/actor/next" />
                <Understanding xmlns="https://foo.bar" soap:mustUnderstand="1" />
            </soap:Header>
        </soap:Envelope>        
        EOXML;


        static::assertXmlStringEqualsXmlString(
            Document::fromXmlString($expected, comparable())->toXmlString(),
            Document::fromUnsafeDocument($doc->toUnsafeDocument(), comparable())->toXmlString()
        );
    }
}
