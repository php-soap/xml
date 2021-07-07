<?php
declare(strict_types=1);

namespace SoapTest\Xml\Unit\Locator;

use PHPUnit\Framework\TestCase;
use Soap\Xml\Locator\SoapEnvelopeLocator;
use VeeWee\Xml\Dom\Document;
use function VeeWee\Xml\Dom\Predicate\is_element;

class SoapEnvelopeLocatorTest extends TestCase
{
    /** @test */
    public function it_detects_envelope(): void
    {
        $doc = Document::fromXmlFile(FIXTURE_DIR.'/empty-envelope.xml');
        $envelope = $doc->locate(new SoapEnvelopeLocator());

        self::assertTrue(is_element($envelope));
        self::assertSame('Envelope', $envelope->localName);
    }
}