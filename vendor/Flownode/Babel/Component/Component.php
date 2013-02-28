<?php
namespace Flownode\Babel\Component;

use
  Flownode\Babel\Component\ComponentInterface,
  Flownode\Babel\Formatter\FormatterInterface
;

/**
 * Description of Grid
 *
 * @author lcallarec
 */
abstract class Component implements ComponentInterface
{

  protected $formatter = null;

  public function setFormatter(FormatterInterface $formatter)
  {
    $this->formatter = $formatter;

    return $this;
  }
}