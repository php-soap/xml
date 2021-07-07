<?php
declare(strict_types=1);

namespace SoapTest\Xml\Unit\Locator;

use PHPUnit\Framework\TestCase;
use Soap\Xml\Locator\BodyNamespaceLocator;
use Soap\Xml\Locator\SoapBodyLocator;
use VeeWee\Xml\Dom\Document;
use function VeeWee\Xml\Dom\Predicate\is_element;

class BodyNamespaceLocatorTest extends TestCase
{
    /** @test */
    public function it_detects_nothing_on_empty_envelope(): void
    {
        $doc = Document::fromXmlFile(FIXTURE_DIR.'/empty-envelope.xml');
        $namespace = $doc->locate(new BodyNamespaceLocator());

        self::assertNull($namespace);
    }

    /** @test */
    public function it_detects_nothing_on_empty_body(): void
    {
        $doc = Document::fromXmlFile(FIXTURE_DIR.'/empty-envelope-with-body.xml');
        $namespace = $doc->locate(new BodyNamespaceLocator());

        self::assertNull($namespace);
    }

    /** @test */
    public function it_detects_ns_on_body(): void
    {
        $doc = Document::fromXmlFile(FIXTURE_DIR.'/envelope-with-body.xml');
        $namespace = $doc->locate(new BodyNamespaceLocator());

        self::assertSame('http://tns.com', $namespace);
    }
}
