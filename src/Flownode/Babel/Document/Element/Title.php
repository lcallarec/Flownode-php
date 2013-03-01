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
class Title extends Element
{
  protected $title;

  public function __construct($title = '')
  {
    $this->title = $title;
  }

  public function format()
  {
    parent::format();
    $this->formatter->addTitle($this->title);
  }

  public function add(ElementInterface $part)
  {
    $this->append($part);
  }

}

