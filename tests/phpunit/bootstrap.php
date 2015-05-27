<?php
/*
 * Demo of UI interaction with jQuery+Uniter
 *
 * MIT license.
 */

$autoloader = require __DIR__ . '/../../vendor/autoload.php';
$autoloader->add('Demo\\Tests\\', __DIR__);

QueryPath::enable('Demo\QueryPath\Extension\DomEventExtension');
QueryPath::enable('Demo\QueryPath\Extension\DomDataExtension');
