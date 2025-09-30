<?php
declare(strict_types=1);

namespace SoapTest\Xml\Unit\Xpath;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Soap\Xml\Xmlns;
use VeeWee\Xml\Xmlns\Xmlns as XmlXmlns;

final class XmlnsTest extends TestCase
{
    /**
     * @param callable(): XmlXmlns
     */
    #[DataProvider('provideKnownXmlnses')]
    public function test_it_knows_some_xmlnses(callable $factory, string $uri): void
    {
        $xmlns = $factory();

        static::assertSame($xmlns->value(), $uri);
    }

    public static function provideKnownXmlnses()
    {
        yield 'wsdl' => [
            static fn () => Xmlns::wsdl(),
            'http://schemas.xmlsoap.org/wsdl/',
        ];
        yield 'soap' => [
            static fn () => Xmlns::soap(),
            'http://schemas.xmlsoap.org/wsdl/soap/',
        ];
        yield 'soap12' => [
            static fn () => Xmlns::soap12(),
            'http://schemas.xmlsoap.org/wsdl/soap12/',
        ];
        yield 'xsd' => [
            static fn () => Xmlns::xsd(),
            'http://www.w3.org/2001/XMLSchema',
        ];
        yield 'envelope11' => [
            static fn () => Xmlns::soap11Envelope(),
            'http://schemas.xmlsoap.org/soap/envelope/',
        ];
        yield 'envelope12' => [
            static fn () => Xmlns::soap12Envelope(),
            'http://www.w3.org/2003/05/soap-envelope/',
        ];
    }
}
