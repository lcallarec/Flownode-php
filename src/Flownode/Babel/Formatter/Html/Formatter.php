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
  Flownode\Babel\Formatter\Formatter as AbstractFormatter,
  Flownode\Babel\Formatter\Html\GridFormatter,
  Flownode\Babel\Styles\HtmlStyles;
;

/**
 * HTML Formatter
 *
 * @author Laurent CALLAREC <lcallarec@gmail.com>
 */
class Formatter extends AbstractFormatter
{

  /**
   * Formatter content
   *
   * @var string
   */
  protected $content = '';

  public function __construct($decorator)
  {
    parent::__construct($decorator);
  }

  /**
   * Add a paragraph
   * @param string $content
   */
  public function addParagraph($content = '', $rules = null)
  {
    if($rules)
    {
      $decorator = $this->decorator->get($rules);
      $attributes = $this->formatStyle($decorator($content, $this));
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
  public function addTitle($title = '', $level = 0, $rules = null)
  {
    $attributes = array();
    if(null !== $rules)
    {
      $decorator = $this->decorator->get($rules);
      $attributes = $this->formatStyle($decorator($content, $this));
    }

    $this->content .= '<h'.$level.' '.$this->formatStyle($attributes).'>'.$this->titleManager->getTitlePrefix($level).$title.'</h'.$level.'>';
  }

  /**
   *
   * @param array $headers
   * @param array $body
   */
  public function addGrid($columns, $datas, $rowDecorator = null)
  {

    $grid = new GridFormatter($this, $columns, $datas);
    $grid->setRowDecorator($rowDecorator);

    $this->content .= '<table>';

    $grid->addHeaders();
    $grid->addRows();

    $this->content .= '</table>';
  }


  public function append($content = '')
  {
    $this->content .= $content;
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
  public function formatStyle($styles)
  {
    $sStyles = '';
    foreach($styles as $attribute => $value)
    {
      $sStyles .= $attribute.'="'.$value.'" ';
    }
    return $sStyles;
  }

}

