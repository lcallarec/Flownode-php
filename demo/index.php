<?php
use
    Flownode\UI\Common\DOM\Element
;
//
//
//require_once dirname(__FILE__).'/../vendor/autoload.php';
//
//$node = new Element('div-8', 'div');
//
//$node->set('class', 'goik')
//     ->close();
//
//echo $node->getText();

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


use
  Flownode\Babel\Formatter\Html\Formatter,
  Flownode\Babel\Grid\Grid,
  Flownode\Babel\Grid\Part,
  Flownode\Babel\Component\Document\Document,
  Flownode\Babel\Component\Base\Paragraph
;


require_once dirname(__FILE__).'/../vendor/autoload.php';

$d = new Document(new Formatter());

$p = new Paragraph('I am happy');

$d->add($p);

$a = $d->format()->getContent();

echo $a;

//
//
//$g = new Grid($f);
//
//$p = new Part();
//
//$g->addPart($p);
//
//$p->addContent('trtt');
//
//$a = $g->getContent();
//
//echo $a;


