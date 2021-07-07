<?php
declare(strict_types=1);

namespace SoapTest\Xml\Unit\Xpath;

use PHPUnit\Framework\TestCase;
use Soap\Xml\Xpath\WsdlPreset;
use VeeWee\Xml\Dom\Document;
use function VeeWee\Xml\Dom\Predicate\is_element;

class WsdlPresetTest extends TestCase
{
    /** @test */
    public function it_provides_a_wsdl_xpath_preset(): void
    {
        $doc = Document::fromXmlFile(FIXTURE_DIR.'/weather-ws.wsdl');
        $xpath = $doc->xpath(new WsdlPreset($doc));

        $definitions = $xpath->querySingle('/wsdl:definitions');
        self::assertTrue(is_element($definitions));
    }
}