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
  Flownode\Babel\Document\Grid\Formatter\HtmlFormatter,
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

  public function __construct()
  {
    parent::__construct();

    HtmlStyles::set('default', function($value, $formatter) {

       return array('style' => 'color: red;');

     });

     HtmlStyles::set('title.0', function($value, $formatter) {

       return array('style' => 'color: red;');

     });

     HtmlStyles::set('title.1', function($value, $formatter) {

       return array('style' => 'font-size: 1.5em; border-bottom: 1px solid grey;');

     });

     HtmlStyles::set('title.2', function($value, $formatter) {

       return array('style' => 'font-size: 1.2em; border-bottom: 1px solid grey;');

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
  public function addTitle($title = '', $level = 0)
  {
    $style = HtmlStyles::get('title.'.$level);

    $attributes = $this->formatStyle($style($title, $this));

    $this->content .= '<h'.$level.' '.$attributes.'>'.$this->getTitlePrefix($level).$title.'</h'.$level.'>';
  }

  /**
   *
   * @param array $headers
   * @param array $body
   */
  public function addGrid($columns, $datas, $rowDecorator = null)
  {

    $grid = new HtmlFormatter($this, $columns, $datas);
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

