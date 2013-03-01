<?php

namespace Flownode\Bootstrap\Common;

use Flownode\Bootstrap\Common\Element;

/**
 * Bootstrap link element
 *
 * @author lcallarec
 */
class Link extends Element
{

/**
     *
     * @param string $tagName
     * @param array  $attributes
     */
    public function __construct($elements)
    {
        parent::construct($id);

        $this->tagName = 'a';

        $this->attributes['class'] = 'dropdown-menu';

        foreach ($elements as $element) {

            $this->openNode('li')->addNode($element)->closeNode();
        }

        $this->closeNode();

    }



}

