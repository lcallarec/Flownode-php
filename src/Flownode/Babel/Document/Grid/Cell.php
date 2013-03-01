<?php
namespace Flownode\Babel\Component\Grid;

use
  Flownode\Babel\Document\Element\Element
;

/**
 * Description of Grid
 *
 * @author lcallarec
 */
class Cell extends Element
{
  protected $content = '';

  public function __construct($content)
  {
    $this->content = $content;
  }

  public function add(GridItem $item)
  {
    $this->append($item);
  }

  public function format()
  {
    $this->formatter->addCell($this->content);
  }

}

