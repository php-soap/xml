<?php
declare(strict_types=1);

namespace SoapTest\Xml\Unit\Locator;

use PHPUnit\Framework\TestCase;
use Soap\Xml\Locator\SoapHeaderLocator;
use VeeWee\Xml\Dom\Document;
use function VeeWee\Xml\Dom\Predicate\is_element;

class SoapHeaderLocatorTest extends TestCase
{
    /** @test */
    public function it_detects_nothing_on_empty_envelope(): void
    {
        $doc = Document::fromXmlFile(FIXTURE_DIR.'/empty-envelope.xml');
        $header = $doc->locate(new SoapHeaderLocator());

        self::assertNull($header);
    }

    /** @test */
    public function it_detects_header_if_it_exists(): void
    {
        $doc = Document::fromXmlFile(FIXTURE_DIR.'/empty-envelope-with-head-and-body.xml');
        $header = $doc->locate(new SoapHeaderLocator());

        self::assertTrue(is_element($header));
        self::assertSame('Header', $header->localName);
    }
}
