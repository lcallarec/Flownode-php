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

use
  Flownode\Babel\Formatter\FormatterInterface,
  Flownode\Babel\Styles\HtmlStyles;
;

/**
 * HTML Formatter
 *
 * @author Laurent CALLAREC <lcallarec@gmail.com>
 */
class Formatter implements FormatterInterface
{

  /**
   * Formatter content
   *
   * @var string
   */
  protected $content = '';

  public function __construct()
  {
     HtmlStyles::set('default', function($value, $formatter) {

       return array('style' => 'color: red;');

     });
  }

  /**
   * Add a paragraph
   * @param string $content
   */
  public function addParagraph($content = '', $style = null)
  {
    if($style)
    {
      $attributes = $this->formatStyle($style($content, $this));
    }
    else
    {
      $attributes = '';
    }

    $this->content .= '<p '.$attributes.'>'.$content.'</p>';
  }

  /**
   *
   * @param type $title
   * @param type $level
   * @param type $suffix
   */
  public function addTitle($title = '', $level = 1, $suffix = '. ')
  {
    $this->content .= '<h'.$level.'>'.$suffix.$title.'</h'.$level.'>';
  }

  /**
   *
   * @param array $headers
   * @param array $body
   */
  public function addGrid($columns, $datas)
  {

    $this->content .= '<table>';

    echo '<pre>';
    print_r($columns);
    print_r($datas);
    echo '</pre>';

    $this->content .= '<thead><tr>';
    foreach($columns as $column)
    {
      $this->content .='<th>'.$column->getName().'</th>';
    }
    $this->content .= '</thead></tr>';

    foreach($datas as $row)
    {
      $this->content .= '<tr>';
      foreach($columns as $column)
      {
        $value = $column->getValue($row);
        $columnDecorator = $column->getColumnDecorator();
        if($columnDecorator instanceof \Closure)
        {
          $attributes = $this->formatStyle($columnDecorator($row, $column, $this));
        }
        else
        {
          $attributes = '';
        }

        $this->content .='<td '.$attributes.'>'.$value.'</td>';
      }

      $this->content .= '</tr>';
    }



//    foreach($columns as $column)
//    {
//      $item = new $column[1]($column[0]);
//      $item->setFormatter($this);
//      if($column[2] instanceof \Closure)
//      {
//        $attributes = $this->formatStyle($column[2]($column[0], $this));
//      }
//      else
//      {
//        $attributes = '';
//      }
//
//      $this->content .= $this->addCell($item, $attributes);
//
//    }

    $this->content .= '</table>';
  }

  protected function addCell($item, $attributes)
  {
     $this->content .='<td '.$attributes.'>'.$item->render().'</td>';
  }

  /**
   *
   * @return string
   */
  public function getContent()
  {
    return $this->content;
  }

  /**
   * Transform an array of attributes into a string
   * @param array $styles
   * @return string
   */
  protected function formatStyle($styles)
  {
    $sStyles = '';
    foreach($styles as $attribute => $value)
    {
      $sStyles .= $attribute.'="'.$value.'" ';
    }
    return $sStyles;
  }

}

