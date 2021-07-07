<?php
declare(strict_types=1);

namespace SoapTest\Xml\Unit\Locator;

use PHPUnit\Framework\TestCase;
use Soap\Xml\Locator\SoapEnvelopeLocator;
use VeeWee\Xml\Dom\Document;
use function VeeWee\Xml\Dom\Predicate\is_element;

final class SoapEnvelopeLocatorTest extends TestCase
{
    
    public function test_it_detects_envelope(): void
    {
        $doc = Document::fromXmlFile(FIXTURE_DIR.'/empty-envelope.xml');
        $envelope = $doc->locate(new SoapEnvelopeLocator());

        static::assertTrue(is_element($envelope));
        static::assertSame('Envelope', $envelope->localName);
    }
}
