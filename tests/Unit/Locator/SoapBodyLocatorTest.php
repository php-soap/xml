<?php
declare(strict_types=1);

namespace SoapTest\Xml\Unit\Locator;

use PHPUnit\Framework\TestCase;
use Soap\Xml\Locator\SoapBodyLocator;
use VeeWee\Xml\Dom\Document;
use function VeeWee\Xml\Dom\Predicate\is_element;

class SoapBodyLocatorTest extends TestCase
{
    /** @test */
    public function it_detects_nothing_on_empty_envelope(): void
    {
        $doc = Document::fromXmlFile(FIXTURE_DIR.'/empty-envelope.xml');
        $body = $doc->locate(new SoapBodyLocator());

        self::assertNull($body);
    }

    /** @test */
    public function it_detects_body_if_it_exists(): void
    {
        $doc = Document::fromXmlFile(FIXTURE_DIR.'/empty-envelope-with-body.xml');
        $body = $doc->locate(new SoapBodyLocator());

        self::assertTrue(is_element($body));
        self::assertSame('Body', $body->localName);
    }
}
