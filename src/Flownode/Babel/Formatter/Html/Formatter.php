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

use Flownode\Babel\Formatter\FormatterInterface;

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

  }

  /**
   * Add a paragraph
   * @param string $content
   */
  public function addParagraph($content = '')
  {
    $this->content .= '<p>'.$content.'</p>';
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
   * @return string
   */
  public function getContent()
  {
    return $this->content;
  }

}

