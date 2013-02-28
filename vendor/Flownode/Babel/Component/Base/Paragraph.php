<?php
namespace Flownode\Babel\Component\Base;

use
  Flownode\Babel\Component\Component
;

/**
 * Description of Grid
 *
 * @author lcallarec
 */
class Paragraph extends Component
{
  protected $text;

  public function __construct($text = '')
  {
    $this->text = $text;
  }

  public function format()
  {
    $this->formatter->addParagraph($this->text);
  }
}

