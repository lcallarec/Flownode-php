<?php
/**
 * This file is part of the Flownode package
 *
 * (c) Laurent CALLAREC <lcallarec@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Flownode\Babel\Document\Grid;

use
  Flownode\Babel\Document\Element\Element,
  Flownode\Babel\Document\Grid\Cell
;
/**
 *
 * @author Laurent CALLAREC <lcallarec@gmail.com>
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

