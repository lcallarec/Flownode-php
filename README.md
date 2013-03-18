Flownode
========

[![Build Status](https://travis-ci.org/lcallarec/Flownode-php.png)](https://travis-ci.org/lcallarec/Flownode-php)

## What is Flownode

Flownode is a libraary made of 3 pakckages : Babel, UI and Switchboard.

###1. Flownode.Babel

Babel primary goal is generating multi-format documents, likes reports. With the same code, developper will be able to output in HTML or PDF format (but all other formats could be supported...).
Some PHP librairies offer the ability to parse an HTML document for outputing in PDF format,like TCPDF ; while those solutions are very powerful to build complex PDF documents, they are definitively very slow. 

Babel will be kept fast, very simple to use in most cases. If you want to build complex document, you could create your own formatters and components, since Babel is quite simple to enhance.

Babel documents are able to skin the most parts of your data thanks to decorators, wich are noting more than closures.

Exemple of code to produce a PDF document :

```php
use
  Flownode\Babel\Formatter\Tcpdf\Formatter as PDFFormatter,
  Flownode\Babel\Styles\TcpdfStyles,
  Flownode\Babel\Document\Document,
  Flownode\Babel\Document\Element\Paragraph,
  Flownode\Babel\Document\Element\Title,
  Flownode\Babel\Document\Grid\Grid
;

$decorator = new Flownode\Babel\Decorator\PDFDecorator();

$decorator->set('background.yellow', function($row, $column, $formatter) {
  return array('style' => 'background-color: yellow;');
});

$document = new Document(new PDFFormatter($decorator));

$p = new Paragraph('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut porttitor pretium nisl eu pulvinar', 'background.yellow');
$document->add($p);

$t = new Title('My first title,level 1', 1);
$document->add($t);

$t = new Title('My second title, level 2', 2);
$document->add($t);

$t = new Title('My third title,level 1', 1);
$document->add($t);

$document->add($p);

$data    = [[1, 2], [3, 4]];

$headers = ['Column 1', 'Column2'];

$grid = new Grid($data);
$decorator->set('row.color.cycle', function($row, $i, $formatter) {

  $even = array('style' => 'background-color: blue;');
  $odd  = array('style' => 'background-color: red;');

  return $i % 2 == 1 ? $even : $odd;

});

$col1 = $grid->addColumn($headers[0], 0, 0);
$col2 = $grid->addColumn($headers[1], 1, 1, null, 'background.yellow');

$grid->setRowDecorator('row.color.cycle');

$document->add($grid);

$document->format()->getContent()->Output();
```

As you understand, if you want an HTML output, you only have to change the Formatter and Decorator classes.

Babel is in an early stage of development, but the foundations are almost done.

Later, it would be great - I don't investigate yet - to connect Babel with markup engines like Markdown or templating systems like Twig or Smarty.
 
@TODO :
* Enhance grid generation, espacially in PDF
* Decorators may accept arrays or closures, or simply callbacks from existing objects
* Stabilize the public API
* Adding more base components
* Adding more formatters
* Make HTML formatters work with Flonode.UI
* See how it would be possibile to connect Babel with markup engines or templating systems

###2. Flownode.UI

Flownode.UI has 4 goals :

* Providing foundations to easily create and manipulate DOM elements on the server-side
* Giving the base architecture to make components easily reusables : that's really the heart of this projets
* Easily extends those components to make them working with client-side library like Twitter Bootrap or jQuery UI for exemple
* To be used along with the Flownode-js library

Flownode should remains a standalone library, not a whole UI components framework. So it could be easily integrated with existing server-side frameworks or template engines.

###3. Flownode.Switchboard

See [Flownode.js](https://github.com/lcallarec/Flownode-js) for more details

(pending)

### Any helps are welcome !

### Flownode is actually (2013-03-184) *in stage of development*