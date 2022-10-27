# SOAP XML

This package provides some tools on top of [veewee/xml](https://github.com/veewee/xml)'s DOM component in order to make it easier to deal with SOAP XML structures.

# Want to help out? 💚

- [Become a Sponsor](https://github.com/php-soap/.github/blob/main/HELPING_OUT.md#sponsor)
- [Let us do your implementation](https://github.com/php-soap/.github/blob/main/HELPING_OUT.md#let-us-do-your-implementation)
- [Contribute](https://github.com/php-soap/.github/blob/main/HELPING_OUT.md#contribute)
- [Help maintain these packages](https://github.com/php-soap/.github/blob/main/HELPING_OUT.md#maintain)

Want more information about the future of this project? Check out this list of the [next big projects](https://github.com/php-soap/.github/blob/main/PROJECTS.md) we'll be working on.

# Installation

```bash
composer require php-soap/xml
```

## Builder

### SoapHeaders

Makes it possible to build the content of a `soap:Header` element.

```php
use Soap\Xml\Builder\SoapHeaders;
use Soap\Xml\Builder\SoapHeader;
use Soap\Xml\Builder\Header\Actor;
use Soap\Xml\Builder\Header\MustUnderstand;
use Soap\Xml\Manipulator\PrependSoapHeaders;
use VeeWee\Xml\Dom\Document;
use function VeeWee\Xml\Dom\Builder\namespaced_element;
use function VeeWee\Xml\Dom\Builder\element;
use function VeeWee\Xml\Dom\Builder\value;

$doc = Document::fromXmlString($xml);
$builder = new SoapHeaders(
    new SoapHeader(
        $targetNamespace,
        'Auth',
        children(
            namespaced_element($targetNamespace, 'user', value('josbos')),
            namespaced_element($targetNamespace, 'password', value('topsecret'))
        ),
        // Optionally, you can provide additional configurators for setting
        // SOAP-ENV specific attributes:
        Actor::next(),
        new MustUnderstand()
    ),
    $header2,
    $header3
);

$headers = $doc->build($builder);

// You can prepend the soap:Header as first element of the soap:envelope
// Like this
$doc->manipulate(new PrependSoapHeaders(...$headers));
```

*Note*: The SoapHeader(s) can be configured by using any [DOM builder configurator](https://github.com/veewee/xml/blob/master/docs/dom.md#builders).

## Locator

### BodyNamespaceLocator

Locates the namespace of the first element inside the soap:Body.

```php
use Soap\Xml\Locator\BodyNamespaceLocator;
use VeeWee\Xml\Dom\Document;

$doc = Document::fromXmlString($xml);
$bodyNamespace = $doc->locate(new BodyNamespaceLocator());
```

### SoapBodyLocator

Locates the `soap:Body` element inside a `soap:Envelope`

```php
use Soap\Xml\Locator\SoapBodyLocator;
use VeeWee\Xml\Dom\Document;

$doc = Document::fromXmlString($xml);
$bodyElement = $doc->locate(new SoapBodyLocator());
```


### SoapEnvelopeLocator

Locates the `soap:Envelope` inside XML.

```php
use Soap\Xml\Locator\SoapEnvelopeLocator;
use VeeWee\Xml\Dom\Document;

$doc = Document::fromXmlString($xml);
$bodyElement = $doc->locate(new SoapEnvelopeLocator());
```

### SoapHeaderLocator 

Locates the `soap:Header` element inside a `soap:Envelope`

```php
use Soap\Xml\Locator\SoapHeaderLocator;
use VeeWee\Xml\Dom\Document;

$doc = Document::fromXmlString($xml);
$bodyElement = $doc->locate(new SoapHeaderLocator());
```

## Manipulator

### PrependSoapHeaders

See SoapHeaders builder:

```php
$doc = Document::fromXmlString($xml);
$doc->manipulate(new PrependSoapHeaders($soapHeader));
```

## XPath

### EnvelopePreset

This preset allows you to use following xpath prefixes:

- `application`: The namespace of the SOAP implementation.
- `soap`: The soap prefix allows you to fetch common elements like Body, header, Envelope, ...

```php
use Soap\Xml\Xpath\EnvelopePreset;
use VeeWee\Xml\Dom\Document;

$doc = Document::fromXmlString($xml);
$xpath = $doc->xpath(new EnvelopePreset($doc));

$xpath->querySingle('/soap:Envelope');
$xpath->querySingle('//soap:Body');
$xpath->querySingle('//soap:Header');
$xpath->querySingle('//soap:Body//application:Foo');
```


### WsdlPreset

This preset allows you to use following xpath prefixes:

- `wsdl`: The wsdl prefix allows you to fetch common elements like definitions, types, services, operations, ...

```php
use Soap\Xml\Xpath\WsdlPreset;
use VeeWee\Xml\Dom\Document;

$doc = Document::fromXmlString($xml);
$xpath = $doc->xpath(new WsdlPreset($doc));

$xpath->querySingle('/wsdl:definitions');
$xpath->querySingle('//wsdl:types');
$xpath->querySingle('//wsdl:services');
```
