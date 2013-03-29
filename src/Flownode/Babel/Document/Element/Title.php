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
  Flownode\Babel\Document\Element\Element,
  Flownode\Babel\Document\Document
;
/**
 * Write document titles
 *
 * @author Laurent CALLAREC <lcallarec@gmail.com>
 */
class Title extends Element
{
  const TYPE = 'title';

  /**
   * Document title
   * @var string
   */
  protected $title;

  /**
   * Title level (depth)
   *
   * @var int
   */
  protected $level;

  /**
   * The title prefix
   *
   * @var string
   */
  protected $prefix;

  /**
   *
   * @param string $title
   */
  public function __construct($title = '', $level = 0, $rules = 'default')
  {
    $this->title = $title;
    $this->level = $level;
    $this->rules = $rules;
  }

  /**
   * Get title value
   * @return string
   */
  public function getTitle()
  {
    return $this->title;
  }

  /**
   * Set title value : useful when title is changed inside the formatter
   * @param  string $title
   * @return self
   */
  public function setTitle($title)
  {
    $this->title = (string) $title;

    return $this;
  }

  /**
   * Get prefix value
   * @return string
   */
  public function getPrefix()
  {
    return $this->prefix;
  }

  /**
   * Set prefix value
   * @param  string $title
   * @return self
   */
  public function setPrefix($prefix)
  {
    $this->prefix = (string) $prefix;

    return $this;
  }

  /**
   * Get level value
   *
   * @return int
   */
  public function getLevel()
  {
    return $this->level;
  }

  /**
   *
   * @inherit
   */
  public function setDocument(Document $document)
  {
    parent::setDocument($document);

    $this->prefix = $this->document->getManager('title')->getTitlePrefix($this->level);

    $this->document->getManager('title')->register($this->prefix, $this->title, $this->getId());
  }
}

