<?php
namespace Flownode\Babel\Document\Element;
use
  Flownode\Babel\Document\Element\Element
;
/**
 * Description of Grid
 *
 * @author lcallarec
 */
class Paragraph extends Element
{
  protected $text;

  public function __construct($text = '')
  {
    $this->text = $text;
  }

  public function format()
  {
    $this->formatter->addParagraph($this->text);
  }

  public function add(ElementInterface $part)
  {
    $this->append($part);
  }
}

