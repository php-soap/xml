<?php
declare(strict_types=1);

namespace SoapTest\Xml\Unit\Locator;

use PHPUnit\Framework\TestCase;
use Soap\Xml\Locator\BodyNamespaceLocator;
use VeeWee\Xml\Dom\Document;

final class BodyNamespaceLocatorTest extends TestCase
{
    public function test_it_detects_nothing_on_empty_envelope(): void
    {
        $doc = Document::fromXmlFile(FIXTURE_DIR.'/empty-envelope.xml');
        $namespace = $doc->locate(new BodyNamespaceLocator());

        static::assertNull($namespace);
    }

    
    public function test_it_detects_nothing_on_empty_body(): void
    {
        $doc = Document::fromXmlFile(FIXTURE_DIR.'/empty-envelope-with-body.xml');
        $namespace = $doc->locate(new BodyNamespaceLocator());

        static::assertNull($namespace);
    }

    
    public function test_it_detects_ns_on_body(): void
    {
        $doc = Document::fromXmlFile(FIXTURE_DIR.'/envelope-with-body.xml');
        $namespace = $doc->locate(new BodyNamespaceLocator());

        static::assertSame('http://tns.com', $namespace);
    }
}
