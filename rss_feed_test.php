<?php
$dom = new DOMDocument('1.0', 'utf-8');

$root = $dom->createElement('root');
//$root->setAttribute('attribut', 'value');
$dom->appendChild($root);

$person = $dom->createElement('person');

$name   = $dom->createElement('name', 'Cookie Monster');

$person->appendChild($name);

$person->appendChild($dom->createElement('status', 'Sulten'));

$root->appendChild($person);

$dom->formatOutput = true;

$dom->save('person.xml');
/**
 * Created by PhpStorm.
 * User: 110230
 * Date: 20-09-2016
 * Time: 08:47
 */