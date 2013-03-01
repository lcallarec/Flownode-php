<?php
namespace Flownode\Babel\Grid;

use Flownode\Babel\Component\Document\Document;

/**
 * Description of Grid
 *
 * @author lcallarec
 */
class Grid extends Document
{
  protected $formatter = null;

  protected $parts  = null;

  protected $width  = null;

  public function __construct($formatter)
  {
    $this->formatter = $formatter;
  }

  public function addPart(Part $part)
  {
    $part->setFormatter($this->formatter);
    $this->append($part);
  }

  public function getContent()
  {
   return $this->formatter->getContent();
  }

  public function getFormatter()
  {
    return $this->formatter;
  }
}

