<?php
namespace Flownode\Babel\Formatter\Html;

use Flownode\Babel\Formatter\FormatterInterface;

/**
 * Description of Grid
 *
 * @author lcallarec
 */

class Formatter implements FormatterInterface
{
  protected $content = '';

  public function __construct()
  {

  }

  public function addParagraph($content = '')
  {
    $this->content .= '<p>'.$content.'</p>';
  }

  public function addTitle($title = '', $level = 1, $suffix = '. ')
  {
    $this->content .= '<h'.$level.'>'.$suffix.$title.'</h'.$level.'>';
  }

  public function addCell($value)
  {
    $this->content .= '<td>'.$value.'</td>';
  }

  public function getContent()
  {
    return $this->content;
  }

}

