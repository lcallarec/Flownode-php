<?php
namespace Flownode\Babel\Document\Element;

use
  Flownode\Babel\Document\Element\ElementInterface,
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

  protected $childs = array();

  public function __construct()
  {
    parent::__construct($this->childs);
  }

  public function setFormatter(FormatterInterface $formatter)
  {
    $this->formatter = $formatter;

    return $this;
  }

  public function format()
  {
    foreach($this->childs as $part)
    {
      $part->format();
    }
  }

}