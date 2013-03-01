<?php
namespace Flownode\Babel\Grid;

/**
 * Description of Grid
 *
 * @author lcallarec
 */
class Part extends \ArrayObject
{
  protected $formatter = null;

  public function __construct()
  {

  }

  public function addContent($c)
  {
    $this->formatter->addParagraph($c);
  }

  public function setFormatter($formatter)
  {
    $this->formatter = $formatter;
  }
}

