<?php

namespace Flownode\Node;

/**
 * Basic node to build HTML Elements
 *
 * The main difference with Flownode\Node\Node are :
 * - the id attribute is mandatory fot
 *
 * @author lcallarec
 */
class Element extends Node
{

  /**
   * Unique widget id in the DOM
   *
   * @var string
   */
  protected $id;

  /**
   * Number of parent node from root
   *
   * @var int
   */
  protected $level = 1;

  /**
   *
   * @param string $tagName
   * @param array  $attributes
   */
  public function __construct($id, $tag = 'div', $attributes = array())
  {
    if(!$id)
    {
      throw new \DOMException('Flownode\Node\Element must have an id attribute');
    }

    parent::__construct($tag, $attributes);

    $this->id = $id;

  }

  /**
   * Set the number of parents from the root
   * @return Flownode\UI\Common\Element
   */
  public  function setLevel($level)
  {
    $this->level = (int) $level;

    return $this;

  }

  /**
   *
   * @return int $this->level
   */
  public function getLevel()
  {
    return $this->level;

  }

  /**
   * Add a child to the current node
   *
   * @override
   *
   * @param Flownode\Common\DOM\Node  $$node
   * @return Flownode\Common\DOM\Node
   */
  public function addChild(Node $node)
  {
    $node->setLevel($this->level + 1);

    parent::addChild($node);

    return $this;

  }

  /**
   * ID attribute may NEVER be overriden
   *
   * @see parent::getAttributesString()
   *
   * @return string
   */
  public function getAttributesString($attributes, $pattern = ' %attribute%="%value%"', $valueSeparator = '')
  {
    $attributes['id'] = $this->id;

    return parent::getAttributesString($attributes, $pattern, $valueSeparator);

  }

}
