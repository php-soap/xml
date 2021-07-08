<?php
declare(strict_types=1);

namespace SoapTest\Xml\Unit\Xpath;

use PHPUnit\Framework\TestCase;
use Soap\Xml\Xpath\EnvelopePreset;
use VeeWee\Xml\Dom\Document;
use VeeWee\Xml\Exception\RuntimeException;
use function VeeWee\Xml\Dom\Predicate\is_element;

final class EnvelopePresetTest extends TestCase
{
    public function test_it_provides_a_envelope_xpath_preset(): void
    {
        $doc = Document::fromXmlFile(FIXTURE_DIR.'/envelope-with-body.xml');
        $xpath = $doc->xpath(new EnvelopePreset($doc));


        $body = $xpath->querySingle('//soap:Body');
        static::assertTrue(is_element($body));

        $response = $xpath->querySingle('//soap:Body/application:MyResponse');
        static::assertTrue(is_element($response));
    }

    
    public function test_it_also_provides_a_preset_for_applications_without_tns(): void
    {
        $doc = Document::fromXmlFile(FIXTURE_DIR.'/empty-envelope.xml');
        $xpath = $doc->xpath(new EnvelopePreset($doc));

        $this->expectException(RuntimeException::class);
        $xpath->query('//soap:Envelope/application:x');
    }
}
