<?php
/**
 * This file is part of the Flownode package
 *
 * (c) Laurent CALLAREC <lcallarec@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Flownode\Babel\Document;

use
  Flownode\Babel\Document\Element\ElementInterface,
  Flownode\Babel\Formatter\FormatterInterface
;

/**
 * Main Document wrapper
 *
 * Be careful : the format is only done when Document::format() is called
 * So all your components can be modified during runtime before Document::format() call
 *
 * @author Laurent CALLAREC <l.callarec@gmail.com>
 */
class Document extends \ArrayObject implements ElementInterface
{
  /**
   * \Flownode\Babel\Formatter\FormatterInterface
   * @var FormatterInterface
   */
  protected $formatter;

  /**
   *
   * @param \Flownode\Babel\Formatter\FormatterInterface $formatter
   */
  public function __construct(FormatterInterface $formatter = null)
  {
    $this->formatter = $formatter;
  }

  /**
   * Add a component to the document
   *
   * @param \Flownode\Babel\Document\Element\ElementInterface $component
   * @return \Flownode\Babel\Document\Element\ElementInterface
   */
  public function add(ElementInterface $component)
  {
    $component->setDocument($this);

    $this->append($component);

    return $component;
  }

  /**
   * Launch format process
   *
   * @return \Flownode\Babel\Document\Document
   */
  public function format()
  {
    foreach($this as $component)
    {
      $component->format();
    }

    return $this;
  }

  /**
   * Return the formatted content, which could not be human readable
   *
   * @return mixed
   */
  public function getContent()
  {
    return $this->formatter->getContent();
  }

  /**
   *
   * @param \Flownode\Babel\Formatter\FormatterInterface $formatter
   * @return self
   */
  public function setFormatter(FormatterInterface $formatter)
  {
    $this->formatter = $formatter;

    return $this;
  }

  /**
   *
   * @return FormatterInterface $formatter
   */
  public function getFormatter()
  {
    return $this->formatter;
  }

}