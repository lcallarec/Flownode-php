<?php
/**
 * This file is part of the Flownode package
 *
 * (c) Laurent CALLAREC <lcallarec@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Flownode\Babel\Document\Element;

use
  Flownode\Babel\Formatter\FormatterInterface,
  Flownode\Babel\Document\Document,
  Flownode\Babel\Decorator\Decorator
;
/**
 * Abstract class inherited by all Elements
 *
 * @author Laurent CALLAREC <lcallarec@gmail.com>
 */
abstract class Element extends \ArrayObject implements ElementInterface
{

  /**
   * Formatter
   *
   * @var Flownode\Babel\Formatter\FormatterInterface
   */
  protected $formatter = null;

  /**
   * The (root) document containing this element
   * @var Document
   */
  protected $document;

  /**
   * Decorator rules
   *
   * @var string | array
   */
  protected $rules;

  /**
   *
   * @param FormatterInterface $formatter
   * @return self
   */
  public function setFormatter(FormatterInterface $formatter)
  {
    $this->formatter = $formatter;

    return $this;
  }

  /**
   *
   * @param Document $document
   * @return self
   */
  public function setDocument(Document $document)
  {
    $this->document = $document;

    $this->setFormatter($document->getFormatter());

    return $this;
  }

  /**
   *
   * @return Document
   */
  public function getDocument()
  {
    return $this->document;
  }

  /**
   *
   * @return array
   */
  public function getRules()
  {
    return $this->rules;
  }
}