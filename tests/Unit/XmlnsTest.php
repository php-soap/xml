<?php
declare(strict_types=1);

namespace SoapTest\Xml\Unit\Xpath;

use PHPUnit\Framework\TestCase;
use Soap\Xml\Xmlns;
use VeeWee\Xml\Xmlns\Xmlns as XmlXmlns;

final class XmlnsTest extends TestCase
{
    /**
     * @param callable(): XmlXmlns
     * @dataProvider provideKnownXmlnses
     */
    public function test_it_knows_some_xmlnses(callable $factory, string $uri): void
    {
        $xmlns = $factory();

        static::assertSame($xmlns->value(), $uri);
    }

    public function provideKnownXmlnses()
    {
        yield 'wsdl' => [
            static fn () => Xmlns::wsdl(),
            'http://schemas.xmlsoap.org/wsdl/'
        ];
        yield 'soap' => [
            static fn () => Xmlns::soap(),
            'http://schemas.xmlsoap.org/wsdl/soap/'
        ];
        yield 'soap12' => [
            static fn () => Xmlns::soap12(),
            'http://schemas.xmlsoap.org/wsdl/soap12/'
        ];
        yield 'xsd' => [
            static fn () => Xmlns::xsd(),
            'http://www.w3.org/2001/XMLSchema'
        ];
    }
}
