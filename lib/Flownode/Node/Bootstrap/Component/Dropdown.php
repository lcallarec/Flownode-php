<?php

namespace Flownode\Bootstrap\Component;

use Flownode\Bootstrap\Common\Element;

/**
 * Bootstrap Dropdown builder
 *
 * @author lcallarec
 */
class Dropdown extends Element
{
    /**
     *
     * @param string $tagName
     * @param array  $attributes
     */
    public function __construct($id, \Flownode\Common\DOM\NodeCollection $elements)
    {
        parent::__construct($id, 'ul', array('class' => 'dr'));

        $this->attributes['class'] = 'dropdown-menu';

        foreach ($elements as $element) {

            if ($element instanceof Flownode\Bootstrap\Common\Divider) {
                $this->addChild($element->class('divider'))->closeNode();
            } else {
                $this->openNode('li')->addChild($element)->closeNode();
            }

        }

        $this->closeNode();

    }


}

