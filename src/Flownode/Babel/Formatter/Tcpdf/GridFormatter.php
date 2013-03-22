<?php

/**
 * This file is part of the Flownode package
 *
 * (c) Laurent CALLAREC <l.callarec@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Flownode\Babel\Formatter\Tcpdf;

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

  /**
   *
   * @var array
   */
  protected $columns = array();

  protected $datas;

  protected $columnWidth = array();
  protected $rowHeight   = array();

  protected $width  = 0;
  protected $height = 0;



  /**
   *
   * @param \Flownode\Babel\Formatter\Tcpdf\Formatter $formatter
   * @param array $columns
   * @param array $datas
   */
  public function __construct(Formatter $formatter, $columns, $datas)
  {
    $this->formatter = $formatter;
    $this->decorator = $formatter->getDecorator();
    $this->columns = $columns;
    $this->datas   = $datas;
  }

  /**
   * Build headers
   * @return void
   */
  public function addHeaders()
  {
    $formatter = $this->formatter->getContent();

    $this->computeOptimalSizes();

    $this->padding = (205 - $this->width) / 2;
    $formatter->setX($this->padding);
    foreach($this->columns as $i => $column)
    {
      $formatter->MultiCell($this->columnWidth[$i], 0, $column->getName(), 0, '', false, 0);
    }

    $formatter->Ln($formatter->getLastH());

  }

  /**
   * Build rows
   * @return void
   */
  public function addRows()
  {
    $formatter = $this->formatter->getContent();

    $formatter->setX($this->padding);

    foreach($this->datas as $r => $row)
    {
      if(null !== $this->rowDecorator)
      {
        $decorator = $this->decorator->get($this->rowDecorator);
        $decorator($row, $r, $this->formatter);
      }

      foreach($this->columns as $c => $column)
      {
        $value = $column->getValue($row);
        $columnDecorator = $column->getColumnDecorator();
        if($columnDecorator instanceof \Closure)
        {
          $columnDecorator($row, $column, $this->formatter);
        }

        $formatter->MultiCell($this->columnWidth[$c], $this->rowHeight[$r], $value, 0, '', true, 0);

      }

      $formatter->Ln($formatter->getLastH());

      $formatter->setX($this->padding);

    }
  }

  /**
   *
   * @param string | array $decorator
   */
  public function setRowDecorator($decorator = null)
  {
    $this->rowDecorator = $decorator;
  }

  /**
   * Compute optimal sizes : column width and cell row height
   *
   * Data are dynamic, so we can just predicate row height and column sizes before building the document
   *
   * @return void
   */
  private function computeOptimalSizes()
  {
    $formatter = $this->formatter->getContent();
    $innerPaddings = $formatter->getCellPaddings();

    $pad = $innerPaddings['L'] + $innerPaddings['R'];

    foreach($this->columns as $i => $column)
    {
      $this->columnWidth[$i] = ($formatter->GetStringWidth($column->getName())+ $pad); //(mb_strlen($column['label']) * $this->sizeRatio) + $pad;
    }

    foreach($this->datas as $r => $row)
    {
      //Base row height
      $this->rowHeight[$r] = 0.1;

      //For each cells of that row
      foreach($row as $c => $cell)
      {

        if(isset($this->columns[$c]))
        {
          //Get logical string width
          $sWidth  = ($formatter->getStringWidth($cell) + $pad);

          $this->columnWidth[$c] = min(max($sWidth, $this->columnWidth[$c]), 30);

          $sHeight = $formatter->getStringHeight($this->columnWidth[$c], $cell);//$defaultStringHeight * $formatter->getNumLines(trim($cell), $this->columnWidth[$c] * 1.2);

          //Compute cell Height : not very very exact
          $this->rowHeight[$r] = max($this->rowHeight[$r], $sHeight);
        }
      }

    }

    $this->width  = array_sum($this->columnWidth);
    $this->height = array_sum($this->rowHeight);

  }

}