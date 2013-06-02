<?php
namespace Flownode\Node;

use Flownode\Node\Node;

/**
 * Node collection
 *
 * Used to create nodes without any node root.
 *
 * @author lcallarec
 */
class NodeCollection extends \ArrayObject
{

  public function add($tag)
  {
      $node = new Node($tag);

      $this->append($node);

      return $node;
  }

  public function addDivider()
  {
      return new \Flownode\Bootstrap\Common\Divider();
  }


}

