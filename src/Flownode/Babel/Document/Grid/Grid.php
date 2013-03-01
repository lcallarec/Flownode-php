<?php
namespace Flownode\Babel\Document\Grid;

use
  Flownode\Babel\Document\Element\Element,
  Flownode\Babel\Document\Grid\Cell
;

/**
 * Description of Grid
 *
 * @author lcallarec
 */
class Grid extends Element
{
  protected $formatter = null;

  protected $columns = array();

  protected $width  = null;

  public function __construct()
  {
    parent::__construct($this->childs);
  }

  public function addHeader(Cell $cell)
  {
    $this->append($cell);
  }


}

