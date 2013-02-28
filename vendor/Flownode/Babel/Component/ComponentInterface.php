<?php
namespace Flownode\Babel\Component;
use
  Flownode\Babel\Formatter\FormatterInterface
;
/**
 * Description of Grid
 *
 * @author lcallarec
 */
interface ComponentInterface
{
  public function format();

  public function setFormatter(FormatterInterface $formatter);
}

