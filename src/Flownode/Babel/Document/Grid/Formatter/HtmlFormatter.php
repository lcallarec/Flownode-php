<?php

/**
 * This file is part of the Flownode package
 *
 * (c) Laurent CALLAREC <lcallarec@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Flownode\Babel\Document\Grid\Formatter;

use
  Flownode\Babel\Formatter\Html\Formatter
;

/**
 *
 * @author Laurent CALLAREC <lcallarec@gmail.com>
 */
class HtmlFormatter
{
  /**
   *
   * @var Flownode\Babel\Formatter\Html\Formatter;
   */
  protected $formatter;

  public function __construct(Formatter $formatter)
  {
    $this->formatter = $formatter;
  }

  public function addHeaders($columns = array())
  {
    $this->formatter->append('<thead><tr>');
    foreach($columns as $column)
    {
      $this->formatter->append('<th>'.$column->getName().'</th>');
    }
    $this->formatter->append('</thead></tr>');
  }

  public function addRows($columns, $datas)
  {
    foreach($datas as $row)
    {
      $this->formatter->append('<tr>');
      foreach($columns as $column)
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

}