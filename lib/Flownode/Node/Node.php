<?php
namespace Flownode\Node;

/**
 * Base fluid DOM node builder
 *
 * @author lcallarec <l.callarec@gmail.com>
 */
class Node
{

  /**
   * Array of DOM attributes for this node
   *
   * <b>Exemple</b>
   * <code>
   *  $attributes = array('class' => 'top', 'style' => array('float' => 'left'));
   * </code>
   *
   * @var array
   */
  protected $attributes;

  /**
   * Node tag name
   *
   * @var string
   */
  protected $tagName;

  /**
   * Parent node. Null for root node
   *
   * @var Flownode\Writer\Html\Node
   */
  protected $parent = null;

  /**
   * Array of child nodes
   *
   * @var array<i, Flownode\Node>
   */
  protected $childs = array();

  /**
   * Node string represntation
   *
   * @var string
   */
  protected $text = '';

  /**
   *
   * @var string
   */
  protected $template = '%content%';

  /**
   * The last node opened
   *
   * @var Node
   */
  protected $lastOpenedNode;

  /**
   *
   * @param string $tagName
   * @param array  $attributes
   */
  public function __construct($tag = null, array $attributes = array())
  {
    $this->tagName = $tag;

    $this->lastOpenedNode = $this;

    $this->setAttributes($attributes);

    //In this case, it's plain text
    if(null !== $tag)
    {
      $this->template = '<'.$tag.'%attributes%>%content%</'.$tag.'>';
    }

  }

  /**
   * Open a new node inside the current node.
   * The created node is added to child node stack.
   *
   * @param string $tag           The tag name
   * @param bool   $flow          Is false, the lastOpended node will always be self
   * @return Flownode\Node\Node The newly added node
   */
  public function open($tag, $flow = true)
  {
    $node = new self($tag);

    $this->lastOpenedNode->addChild($node);

    if(true === $flow)
    {
      $this->lastOpenedNode = $node;
    }

    return $this->lastOpenedNode;

  }

  /**
   * Close the current node.
   *
   * @return Flownode\Node\Node
   */
  public function close($autoClose = false)
  {
    if(true === $autoClose)
    {
      $this->lastOpenedNode->setTemplate = '<'.$this->tagName.'%attributes% />';
    }

    if(null !== $this->parent)
    {
      return $this->parent;
    }

    return $this;

  }

  /**
   * Set one or sevral node attributes
   *
   * @param array $attributes ['attribute' => 'value' [, 'other_attribute' => 'other_value']]
   *
   * @return Flownode\Node\Node
   */
  public function setAttributes($attributes)
  {
    if($this->lastOpenedNode === $this)
    {
      $this->attributes = $attributes;
    }
    else
    {
      $this->lastOpenedNode->setAttributes($attributes);
    }

    return $this;

  }

  /**
   * Set a single node attribute
   *
   * @param string  $attribute
   * @param string  $value
   * @return Flownode\Node\Node
   */
  public function setAttribute($attribute, $value)
  {
    if($this->lastOpenedNode === $this)
    {
      $this->attributes[$attribute] = $value;
    }
    else
    {
      $this->lastOpenedNode->setAttribute($attribute, $value);
    }

    return $this;

  }

  /**
   * get the parent node of the current node
   *
   * @return Flownode\Node\Node
   */
  public function getParent()
  {
    return $this->parent;

  }

  /**
   * Set the parent node of the current node
   *
   * @param Flownode\Node\Node  $node
   *
   * @return Flownode\Node\Node
   */
  public function setParent(Node $node)
  {
    if($this->lastOpenedNode === $this)
    {
      $this->parent = $node;
    }
    else
    {
      $this->lastOpenedNode->setParent($node);
    }

    return $this;

  }

  /**
   * Add a child to the current node
   *
   * @param Flownode\Node\Node  $node
   * @return Flownode\Node\Node
   */
  public function addChild(Node $node)
  {
    $node->setParent($this);

    $this->childs[] = $node;

    return $this;

  }

  /**
   * Get the node content
   * (the text of child nodes are not concerned)
   *
   * @return string
   */
  public function getText()
  {
    return $this->text;
  }

  /**
   * Render the node and return its string representation
   *
   * @return string
   */
  public function render()
  {
    foreach($this->childs as $child)
    {
      $this->text .= $child->render();
    }

    $sAttributes = $this->getAttributesString($this->attributes);

    return strtr($this->template, array('%attributes%' => $sAttributes, '%content%' => $this->text));

  }

  /**
   * Set the node content
   *
   * @return Flownode\Node\Node
   */
  public function setText($text = '')
  {
    if($this->lastOpenedNode === $this)
    {
      $this->text .= $text;
    }
    else
    {
      $this->lastOpenedNode->setText($text);
    }

    return $this;

  }

  /**
   * Modify the rendering template after initialization and before rendering
   *
   * @param type $template
   * @return \Flownode\Node\Node
   */
  public function setTemplate($template = '%attributes% : %content%')
  {
    if($this->lastOpenedNode === $this)
    {
      $this->template = $template;
    }
    else
    {
      $this->setTemplate($template);
    }

    return $this;

  }

  /**
   * The lazy way to set an element attributes
   *
   * <code>
   * $node = new Element('a');
   * $node->href('www.google.com')->class('button')->close();
   * </code>
   *
   * @param type $name
   * @param type $arguments
   * @return Flownode\Node\Node
   */
  public function __call($name, $arguments)
  {
    if(empty($arguments))
    {
      $arguments[0] = '';
    }

    return $this->setAttribute($name, $arguments[0]);

  }

   /**
   * Get formatted string from array of attributes
   *
   * @param array   $attributes     Attributes values can be scalar or arrays
   * @param string  $pattern
   * @param string  $valueSeparator Separator between array attribute values
   * @return string
   */
  protected function getAttributesString($attributes, $pattern = ' %attribute%="%value%"', $valueSeparator = ';')
  {
    $string = '';
    foreach($attributes as $attribute => $value)
    {
      if(true === is_array($value))
      {
        $value = implode($valueSeparator, $value) . $valueSeparator;
      }

      $string .= strtr($pattern, array('%attribute%' => $attribute, '%value%' => $value));

    }

    return $string;

  }


}
