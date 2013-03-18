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
  Flownode\Babel\Document\Document
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
   * Parent document
   *
   * @var  Document
   */
  protected $document = null;

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
  * Laucnh format process
  * @return \Flownode\Babel\Document\Element\Element
  */
  public function format()
  {
    foreach($this as $part)
    {
      $part->format();
    }

    return $this;
  }

}