<?php

declare(strict_types=1);

namespace Soap\Xml;

use VeeWee\Xml\Xmlns\Xmlns as XmlXmlns;

final class Xmlns
{
    public static function wsdl(): XmlXmlns
    {
        return XmlXmlns::load('http://schemas.xmlsoap.org/wsdl/');
    }

    public static function soap(): XmlXmlns
    {
        return XmlXmlns::load('http://schemas.xmlsoap.org/wsdl/soap/');
    }

    public static function soap12(): XmlXmlns
    {
        return XmlXmlns::load('http://schemas.xmlsoap.org/wsdl/soap12/');
    }

    public static function xsd(): XmlXmlns
    {
        return XmlXmlns::load('http://www.w3.org/2001/XMLSchema');
    }

    public static function soap11Envelope(): XmlXmlns
    {
        return XmlXmlns::load('http://schemas.xmlsoap.org/soap/envelope/');
    }

    public static function soap12Envelope(): XmlXmlns
    {
        return XmlXmlns::load('http://www.w3.org/2003/05/soap-envelope/');
    }
}
