<?php

include 'Collection.php';

//Regular Array
$array = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h'];

//New Collection
$c = new Collection();

//Add items from array
$c->addFromArray($array);

//See it!
var_dump($c);

//Push some items to collection
$c->push('i')
    ->push('j')
    ->push('k');

//See it again!
var_dump($c);

//Pop last item
var_dump($c->pop());

//Get item from index 2
var_dump($c->get(2));

//Well... See it!
var_dump($c);
