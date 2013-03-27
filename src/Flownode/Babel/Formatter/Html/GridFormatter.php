<?php

/**
 * This file is part of the Flownode package
 *
 * (c) Laurent CALLAREC <l.callarec@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Flownode\Babel\Formatter\Html;

use
  Flownode\Babel\Decorator\Decorator
;

/**
 *
 * @author Laurent CALLAREC <l.callarec@gmail.com>
 */
class GridFormatter
{
  /**
   *
   * @var Flownode\Babel\Formatter\Html\Formatter;
   */
  protected $formatter;

  /**
   *
   * @var Flownode\Babel\Decorator\Decorator;
   */
  protected $decorator;

  protected $rowDecorator = null;

  public function __construct(Formatter $formatter, $columns, $datas)
  {
    $this->formatter = $formatter;
    $this->decorator = $formatter->getDecorator();
    $this->columns   = $columns;
    $this->datas     = $datas;
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
      $attributes = '';
      if($this->rowDecorator)
      {
        $attributes = array();
        $this->formatter->executeRules($this->rowDecorator, $row, $i, $attributes);
        $attributes = $this->formatter->formatStyle($attributes);
      }

      $this->formatter->append('<tr '.$attributes.'>');

      foreach($this->columns as $column)
      {
        $value = $column->getValue($row);
        $columnDecorator = $column->getColumnDecorator();

        $attributes = '';
        if($columnDecorator)
        {
          $attributes = array();
          $this->formatter->executeRules($columnDecorator, $value, $attributes);
          $attributes = $this->formatter->formatStyle($attributes);
        }

        $this->formatter->append('<td '.$attributes.'>'.$value.'</td>');
      }

      $this->formatter->append('</tr>');
    }
  }

  /**
   * Set decorator rules triggered before each row rendering
   * @param string |array $rules
   */
  public function setRowDecorator($rules = null)
  {
    $this->rowDecorator = $rules;
  }

}