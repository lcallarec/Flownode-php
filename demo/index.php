<?php
use
    Flownode\UI\Common\DOM\Element
;


require_once dirname(__FILE__).'/../vendor/autoload.php';

$node = new Element('div-8', 'div');

$node->set('class', 'goik')
     ->close();

echo $node->getText();

//$choices = new Flownode\Common\DOM\NodeCollection();
//
//$choices->add('a')->href()->class()->title()->close();
//$choices->add('a')->href()->class()->title()->close();
//$choices->add('a')->href()->class()->title()->close();
//$choices->add('a')->href()->class()->title()->setText('trdtrtrddt')->close();
//$choices->add('a')->href()->class()->title()->close();
//$choices->add('a')->href()->class()->title()->close();
//
//$choices->addDivider();
//
//$choices->add('a')->href()->class()->title()->setText('trdtrtrddt')->close();
//$choices->add('a')->href()->class()->title()->setText('trdtrtrddt')->close();

//$dd = new Dropdown('dropdown', $choices);

//echo $dd->getContent();