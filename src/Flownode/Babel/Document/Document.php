<?php
namespace Flownode\Babel\Document;

use
  Flownode\Babel\Document\Element\ElementInterface,
  Flownode\Babel\Formatter\FormatterInterface
;


/**
 * Description of Grid
 *
 * @author lcallarec
 */
class Document extends \ArrayObject implements ElementInterface
{
  protected $components = array();

  protected $formatter;

  public function __construct(FormatterInterface $formatter = null)
  {
    $this->formatter = $formatter;

    parent::__construct($this->components);
  }

  public function add(ElementInterface $component)
  {
    $this->append($component);

  }


  public function setFormatter(FormatterInterface $formatter)
  {
    $this->formatter = $formatter;

    foreach($this as $component)
    {
      $component->setFormatter($formatter);
    }

    return $this;
  }

  public function format()
  {
    $this->setFormatter($this->formatter);

    foreach($this as $component)
    {
      $component->format();
    }

    return $this;
  }

  public function getContent()
  {
    return $this->formatter->getContent();
  }
}

