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
  public function addParagraph($content = '', $style)
  {
    $attributes = $this->formatStyle($style($content, $this));
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
   * @param type $value
   */
  public function addCell($value)
  {
    $this->content .= '<td>'.$value.'</td>';
  }

  /**
   *
   * @param array $headers
   * @param array $body
   */
  public function addGrid($headers, $body)
  {
    $gridParts = array_merge($headers, $body);
    $contents = '';
    foreach($gridParts as $parts)
    {
      $contents .= '<tr>';
      foreach($parts as $content => $style)
      {
        if($style instanceof \Closure)
        {
          $attributes = $this->formatStyle($style($content, $this));
        }
        else
        {
          $attributes = '';
        }

        $contents .= '<td '.$attributes.'>'.$content.'</td>';

      }
      $contents .= '</tr>';
    }

    $this->content .= '<table>'.$contents.'</table>';
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

