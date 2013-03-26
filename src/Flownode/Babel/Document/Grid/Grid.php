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
  Flownode\Babel\Document\Grid\Column
;
/**
 *
 * @author Laurent CALLAREC <lcallarec@gmail.com>
 */
class Grid extends Element
{
  const TYPE = 'grid';

  protected $formatter = null;

  protected $columns = array();

  protected $rowDecorator = null;

  /**
   * Add headers, only one set of headers can be set
   * @param array $headers
   * @return \Flownode\Babel\Document\Grid\Grid
   */
  public function addColumn($name, $columnId, $dataKey, $valueDecorator = null, $columnDecorator = null, $element = null)
  {
    return $this->columns[$columnId] = new Column($name, $dataKey, $valueDecorator, $columnDecorator, $element);
  }

  /**
   *
   * @param string $decorator
   */
  public function setRowDecorator($decorator = null)
  {
    $this->rowDecorator = $decorator;
  }

  public function getRowDecorator()
  {
    return $this->rowDecorator;
  }

  /**
   *
   * @return Flownode\Babel\Document\Grid\Column
   */
  public function getColumns()
  {
    return $this->columns;
  }
}