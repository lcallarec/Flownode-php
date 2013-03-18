<?php

/**
 * This file is part of the Flownode package
 *
 * (c) Laurent CALLAREC <lcallarec@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Flownode\Babel\Formatter\Html;

/**
 *
 * @author Laurent CALLAREC <lcallarec@gmail.com>
 */
class GridFormatter
{
  /**
   *
   * @var Flownode\Babel\Formatter\Html\Formatter;
   */
  protected $formatter;

  protected $rowDecorator = null;

  public function __construct(Formatter $formatter, $columns, $datas)
  {
    $this->formatter = $formatter;
    $this->columns = $columns;
    $this->datas   = $datas;
  }

  public function addHeaders()
  {
    $this->formatter->append('<thead><tr>');
    foreach($this->columns as $column)
    {
      $this->formatter->append('<th>'.$column->getName().'</th>');
    }
    $this->formatter->append('</thead></tr>');
  }

  public function addRows()
  {

    foreach($this->datas as $i => $row)
    {
      if(null !== $decorator = $this->rowDecorator)
      {
        $attributes = $this->formatter->formatStyle($decorator($row, $i, $this));
      }
      else
      {
        $attributes = '';
      }

      $this->formatter->append('<tr '.$attributes.'>');
      foreach($this->columns as $column)
      {
        $value = $column->getValue($row);
        $columnDecorator = $column->getColumnDecorator();
        if($columnDecorator instanceof \Closure)
        {
          $attributes = $this->formatter->formatStyle($columnDecorator($row, $column, $this));
        }
        else
        {
          $attributes = '';
        }

        $this->formatter->append('<td '.$attributes.'>'.$value.'</td>');
      }

      $this->formatter->append('</tr>');
    }
  }

  public function setRowDecorator($decorator = null)
  {
    $this->rowDecorator = $decorator;
  }

}