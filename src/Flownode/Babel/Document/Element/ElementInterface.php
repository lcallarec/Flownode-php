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
interface ElementInterface
{
  public function format();

  public function setFormatter(FormatterInterface $formatter);
}

