<?php
declare(strict_types=1);

namespace SoapTest\Xml\Unit\Locator;

use PHPUnit\Framework\TestCase;
use Soap\Xml\Locator\SoapBodyLocator;
use VeeWee\Xml\Dom\Document;
use function VeeWee\Xml\Dom\Predicate\is_element;

final class SoapBodyLocatorTest extends TestCase
{
    
    public function test_it_detects_nothing_on_empty_envelope(): void
    {
        $doc = Document::fromXmlFile(FIXTURE_DIR.'/empty-envelope.xml');
        $body = $doc->locate(new SoapBodyLocator());

        static::assertNull($body);
    }

    
    public function test_it_detects_body_if_it_exists(): void
    {
        $doc = Document::fromXmlFile(FIXTURE_DIR.'/empty-envelope-with-body.xml');
        $body = $doc->locate(new SoapBodyLocator());

        static::assertTrue(is_element($body));
        static::assertSame('Body', $body->localName);
    }
}
