<?php
require_once "../bootstrap.php";
require_once "./Document.php";

$document     = new Document;
$stateMachine = new Finite\StateMachine\StateMachine;
$loader       = new Finite\Loader\ArrayLoader([
    'class'  => 'Document',
    'states' => [
        'draft'    => ['type' => 'initial', 'properties' => []],
        'proposed' => ['type' => 'normal',  'properties' => []],
        'accepted' => ['type' => 'final',   'properties' => []],
        'refused'  => ['type' => 'final',   'properties' => []],
    ],
    'transitions' => [
        'propose' => ['from' => ['draft'],    'to' => 'proposed'],
        'accept'  => ['from' => ['proposed'], 'to' => 'accepted'],
        'refuse'  => ['from' => ['proposed'], 'to' => 'refused'],
    ]
]);

$loader->load($stateMachine);
$stateMachine->setObject($document);
$stateMachine->initialize();


echo $stateMachine->getCurrentState();
// => "draft"

var_dump($stateMachine->can('accept'));
// => bool(false)

var_dump($stateMachine->can('propose'));
// => bool(true)

$stateMachine->apply('propose');
echo $stateMachine->getCurrentState();
// => "proposed"
