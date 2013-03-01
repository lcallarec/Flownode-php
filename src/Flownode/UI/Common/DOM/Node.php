<?php
namespace Flownode\UI\Common\DOM;

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
     * String representation of $attributes var
     * @see self::setAttributesString()
     *
     * @var string
     */
    protected $sAttributes;

    /**
     * Node tag name
     *
     * @var string
     */
    protected $tag;

    /**
     * Parent node. Null for root node
     *
     * @var Flownode\Common\DOM\Node
     */
    protected $parent = null;

    /**
     * Array of child nodes
     *
     * @var array<i, Flownode\Common\DOM\Node>
     */
    protected $child = array();

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
     *
     * @param string $tagName
     * @param array  $attributes
     */
    public function __construct($tag = null, $attributes = array())
    {
        $this->tagName = $tag;

        $this->setAttributes($attributes);

        //In this case, it's plain text
        if (null !== $tag) {
          $this->template = '<' . $tag . '%attributes%>%content%</' . $tag . '>';
        }
    }

    /**
     * Open a new node inside the current node.
     * The created node is added to child node stack.
     *
     * @return Flownode\Common\DOM\Node
     */
    public function open($tag, $attributes = array())
    {
        $node = new self($tag, $attributes);

        $this->addChild($node);

        return $node;
    }

    /**
     * Close the current node.
     *
     * @return Flownode\Common\DOM\Node
     */
    public function close()
    {
        if (null !== $this->parent) {
            return $this->parent;
        }

        return $this;
    }

    /**
     * Set one or sevral node attributes
     *
     * @param array $attributes ['attribute' => 'value' [, 'other_attribute' => 'other_value']]
     *
     * @return Flownode\Common\DOM\Node
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     *
     * @see Node::setAttribute
     *
     * @return Flownode\Common\DOM\Node
     */
    public function set($attribute, $value)
    {
        return $this->setAttribute($attribute, $value);
    }

    /**
     * Set a single node attribute
     *
     * @param string  $attribute
     * @param string  $value
     * @return Flownode\Common\DOM\Node
     */
    public function setAttribute($attribute, $value)
    {
        $this->attributes[$attribute] = $value;

        return $this;
    }

    /**
     * get the parent node of the current node
     *
     * @return Flownode\Commin\DOM\Node
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set the parent node of the current node
     *
     * @param Flownode\Commin\DOM\Node  $node
     *
     * @return Flownode\Commin\DOM\Node
     */
    public function setParent(Node $node)
    {
        $this->parent = $node;

        return $this;
    }

    /**
     * Add a child to the current node
     *
     * @param Flownode\Common\DOM\Node  $$node
     * @return Flownode\Common\DOM\Node
     */
    public function addChild(Node $node)
    {
        $node->setParent($this);

        $this->child[] = $node;

        return $this;
    }

    /**
     *
     * @return string
     */
    public function getText()
    {
        foreach ($this->child as $child) {
            $this->text .= $child->getText();
        }

        $this->sAttributes = $this->getAttributesString($this->attributes);

        return strtr($this->template, array('%attributes%' => $this->sAttributes, '%content%' => $this->text));
    }

    /**
     *
     * @return type
     */
    public function setText($text = '')
    {
        $this->text .= $text;

        return $this;
    }

    /**
     * Get formatted string from array of attributes
     *
     * @param array   $attributes
     * @param string  $pattern
     * @param string  $valueSeparator
     * @return string
     */
    public function getAttributesString($attributes, $pattern = ' %attribute%="%value%"', $valueSeparator = '')
    {
        $string = '';
        foreach ($attributes as $attribute => $value) {
            if (true === is_array($value)) {
                $string .= strtr($pattern, array('%attribute%' => $attribute, '%value%' => $this->getAttributesString($value, '%attribute%: %value%;')));
            } else {
                $string .= strtr($pattern, array('%attribute%' => $attribute, '%value%' => $value));
            }
        }

        return $string;
    }

    public function setTemplate($template = '%attributes% : %content%')
    {
        $this->template = $template;

        return $this;
    }



    /**
     * The lazy way to set an element attributes
     *
     * <code>
     * $node = new Element('a');
     * $node->href('www.google.com')->class('button')->close();
     *
     * @param type $name
     * @param type $arguments
     * @return Element
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
     * Used to set a new tag name after object initialization
     *
     * @param string $tag
     * @return \Flownode\UI\Common\DOM\Node
     */
    public function setTagName($tag)
    {
        $this->tag = $tag;

        return $this;
    }

}

