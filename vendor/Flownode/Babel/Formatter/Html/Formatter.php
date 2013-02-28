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

  public function addParagraph($content)
  {
    $this->content .= '[]'.$content.'[]';
  }

  public function getContent()
  {
    return $this->content;
  }

}

