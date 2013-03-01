<?php
namespace Flownode\Babel\Document\Element;

use
  Flownode\Babel\Formatter\FormatterInterface
;

/**
 * Description of Grid
 *
 * @author lcallarec
 */
abstract class Element extends \ArrayObject implements ElementInterface
{

  protected $formatter = null;

  public function setFormatter(FormatterInterface $formatter)
  {
    $this->formatter = $formatter;

    return $this;
  }

  public function format()
  {

    foreach($this as $part)
    {
      $part->format();
    }
  }

}