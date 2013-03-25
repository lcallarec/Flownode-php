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
    $attributes = '';
    if($rules)
    {
      $attributes = array();
      $this->executeRules($rules, $content, $attributes);
      $attributes = $this->formatStyle($attributes);
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
    $attributes = '';
    if($rules)
    {
      $attributes = array();
      $this->executeRules($rules, $title, $attributes);
      $attributes = $this->formatStyle($attributes);
    }

    $this->content .= '<h'.$level.' '.$attributes.'>'.$this->getManager('title')->getTitlePrefix($level).$title.'</h'.$level.'>';
  }

  /**
   *
   * @param string        $src
   * @param string        $alt
   * @param string |array $rules
   */
  public function addImage($src, $alt, $rules = null)
  {
    $attributes = '';
    if($rules)
    {
      $attributes = array();
      $this->executeRules($rules, $src, $attributes);
      $attributes = $this->formatStyle($attributes);
    }

    $this->content .= '<img '.$attributes.' src="'.$src.'" alt="'.$alt.'" />';

  }

  /**
   * Add an horizontal rule
   *
   * @param string |array $rules
   */
  public function addHr($rules = null)
  {
    $attributes = '';
    if($rules)
    {
      $attributes = array();
      $this->executeRules($rules, $attributes);
      $attributes = $this->formatStyle($attributes);
    }

    $this->content .= '<hr '.$attributes.' />';
  }

    /**
   * Add an horizontal rule
   *
   * @param string |array $rules
   */
  public function addLink($href, $name, $target = '_blank', $rel = 'nofollow', $rules = 'default')
  {
    $attributes = array();

    if($target)
    {
      $attribute['target'] = $target;
    }

    if($rel)
    {
      $attribute['rel'] = $rel;
    }

    $this->executeRules($rules, $attributes);

    $attributes = $this->formatStyle($attributes);

    $this->content .= '<a href="'.$href.'" '.$attributes.'>'.$name.'</a>';
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

