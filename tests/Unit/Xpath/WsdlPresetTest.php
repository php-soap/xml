<?php
declare(strict_types=1);

namespace SoapTest\Xml\Unit\Xpath;

use PHPUnit\Framework\TestCase;
use Soap\Xml\Xpath\WsdlPreset;
use VeeWee\Xml\Dom\Document;
use function VeeWee\Xml\Dom\Predicate\is_element;

final class WsdlPresetTest extends TestCase
{
    public function test_it_provides_a_wsdl_prefix_in_xpath_preset(): void
    {
        $doc = Document::fromXmlFile(FIXTURE_DIR.'/weather-ws.wsdl');
        $xpath = $doc->xpath(new WsdlPreset($doc));

        $definitions = $xpath->querySingle('/wsdl:definitions');
        static::assertTrue(is_element($definitions));
    }

    public function test_it_provides_a_soap_prefix_in_xpath_preset(): void
    {
        $doc = Document::fromXmlFile(FIXTURE_DIR.'/weather-ws.wsdl');
        $xpath = $doc->xpath(new WsdlPreset($doc));

        $address = $xpath->querySingle('//soap:address');
        static::assertTrue(is_element($address));
    }

    public function test_it_provides_a_soap12_prefix_in_xpath_preset(): void
    {
        $doc = Document::fromXmlFile(FIXTURE_DIR.'/weather-ws.wsdl');
        $xpath = $doc->xpath(new WsdlPreset($doc));

        $address = $xpath->querySingle('//soap12:address');
        static::assertTrue(is_element($address));
    }

    public function test_it_provides_a_schema_prefix_in_xpath_preset(): void
    {
        $doc = Document::fromXmlFile(FIXTURE_DIR.'/weather-ws.wsdl');
        $xpath = $doc->xpath(new WsdlPreset($doc));

        $schema = $xpath->querySingle('//schema:schema');
        static::assertTrue(is_element($schema));
    }

    public function test_it_provides_a_tns_prefix_in_xpath_preset(): void
    {
        $doc = Document::fromXmlFile(FIXTURE_DIR.'/weather-ws.wsdl');
        $xpath = $doc->xpath(new WsdlPreset($doc));

        $definitions = $xpath->querySingle('//tns:hello');
        static::assertTrue(is_element($definitions));
    }
}
