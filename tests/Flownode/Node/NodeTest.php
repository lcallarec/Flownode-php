<?php
namespace Flownode\Node;

/**
 * Test class for Node.
 * Generated by PHPUnit on 2012-11-25 at 23:18:38.
 */
class NodeTest extends \PHPUnit_Framework_TestCase
{

  /**
   * @var Node
   */
  protected $root;

  /**
   * This method is called before a test is executed.
   */
  protected function setUp($tag = 'div', $attributes = array())
  {
    $this->root = new Node($tag, $attributes);

  }

  /**
   * This method is called after a test is executed.
   */
  protected function tearDown()
  {
    unset($this->root);
  }

  /**
   * @covers Flownode\Node\Node::_constructor
   */
  public function testRootAsNoParent()
  {
    //Root has no parent !
    $this->assertNull($this->root->getParent());
  }

  /**
   * @covers Flownode\Node\Node::setAttributes
   * @covers Flownode\Node\Node::setAttribute
   */
  public function testAttributeSetters()
  {
    $this->setUp('span', array('class' => 'class1', 'style' => 'width: 20px;'));

    $tag = $this->root->close()->render();

    $assert = '<span class="class1" style="width: 20px;"></span>';

    $this->assertEquals($tag, $assert);
  }

  /**
   * @covers Flownode\Node\Node::setAttributes
   * @covers Flownode\Node\Node::setAttribute
   */
  public function testAttributeSettersWithArrayValues()
  {
    $this->setUp('span', array('class' => 'class1', 'style' => array('width: 20px', 'height: 50px')));

    $tag = $this->root->close()->render();

    $assert = '<span class="class1" style="width: 20px;height: 50px;"></span>';

    $this->assertEquals($tag, $assert);
  }

  /**
   * @covers Flownode\Node\Node::setText
   * @covers Flownode\Node\Node::getText
   */
  public function testSetGetText()
  {
    $this->setUp('span');

    $this->root->setText('my text');

    $text = $this->root->getText();

    $expected = 'my text';

    $this->assertEquals($text, $expected);

  }

  /**
   * @covers Flownode\UI\Common\DOM\Node::open
   */
  public function testOpen()
  {
    $this->setUp('a');

    $tag = $this->root->open('b')->open('d')->close()->close()->render();

    $expected = '<a><b><d></d></b></a>';

    $this->assertEquals($tag, $expected);
  }

 /**
   * Test if open method is returning the newly created node
   * @covers Flownode\UI\Common\DOM\Node::open
   */
  public function testOpenReturnObject()
  {
    $this->setUp('i');

    $node = $this->root->open('u');

    $this->assertNotSame($node, $this->root);

    $newNode = new Node('u');

    $this->assertEquals($node->render(), $newNode->render());

  }

  /**
   * Test if the close method return the calling object
   *
   * @covers Flownode\UI\Common\DOM\Node::close
   */
  public function testCloseReturnObject()
  {
    $this->setUp('i');

    $node = $this->root->open('u')->close();

    $this->assertSame($node, $this->root);

    $node = $this->root->open('g');

    $this->assertNotSame($node, $this->root);
  }

  /**
   *
   * @covers Flownode\UI\Common\DOM\Node::setAttributes
   */
  public function testSetAttributes()
  {
     $this->setUp('i');

     $tag = $this->root->setAttributes(array('test' => 'abc'))->render();

     $expected = '<i test="abc"></i>';

     $this->assertEquals($tag, $expected);

  }

  /**
   * @covers Flownode\UI\Common\DOM\Node::setAttribute
   */
  public function testSetAttributeReturnValue()
  {
     $this->setUp('i');

     $node = $this->root->setAttribute('attr', '1000');

     $this->assertSame($node, $this->root);

  }

  /**
   * @covers Flownode\UI\Common\DOM\Node::setAttribute
   */
  public function testSetAttribute()
  {
     $this->setUp('i');

     $tag = $this->root->setAttribute('attr', '1000')->render();

     $expected = '<i attr="1000"></i>';

     $this->assertEquals($tag, $expected);

  }

 /**
  * Check if the method return the calling node
  * @covers Flownode\UI\Common\DOM\Node::set
  */
  public function testSetReturnValue()
  {
     $this->setUp('i');

     $node = $this->root->set('attr2', '10002');

     $this->assertSame($node, $this->root);
  }

  /**
   * Check if parent is null when called on a root node
   * @covers Flownode\UI\Common\DOM\Node::getParent
   */
  public function testGetParentIsNullForRoot()
  {
    $this->setUp('a');

    $parent = $this->root->getParent();

    $this->assertNull($parent);
  }

  /**
   * Check if parent is null when called on a root node
   * @covers Flownode\UI\Common\DOM\Node::getParent
   */
  public function testGetParentReturnTheTrueParent()
  {
    $this->setUp('a');

    $root = $this->root;

    $child = $this->root->open('a');

    $secondChild = $child->open('b');

    $this->assertSame($root, $child->getParent());
    $this->assertSame($child, $secondChild->getParent());
  }

  /**
   * @covers Flownode\UI\Common\DOM\Node::setParent
   */
  public function testSetParent()
  {
    $this->setUp('a');

    $root = $this->root;

    $child = $this->root->open('a');

    $secondChild = $child->open('b')->setParent($root);

    $this->assertSame($root, $child->getParent());
    $this->assertNotSame($child, $secondChild->getParent());
    $this->assertSame($root, $secondChild->getParent());

  }

  /**
   * Test addChild return value
   *
   * @covers Flownode\UI\Common\DOM\Node::addChild
   */
  public function testAddChildReturnValue()
  {
    $this->setUp('a');

    $child = new Node('c');

    $node = $this->root->addChild($child);

    $this->assertSame($node, $this->root);
  }

 /**
   * Test if addChild is really adding a child
   *
   * @covers Flownode\UI\Common\DOM\Node::addChild
   */
  public function testAddChild()
  {
    $this->setUp('a');

    $child = new Node('c');

    $node = $this->root->addChild($child);

    $tag = $this->root->render();

    $expected = '<a><c></c></a>';

    $this->assertEquals($tag, $expected);
  }

  /**
   * @covers Flownode\UI\Common\DOM\Node::setTemplate
   * @todo Implement testSetTemplate().
   */
  public function testSetTemplate()
  {
    // Remove the following lines when you implement this test.
    $this->markTestIncomplete(
        'This test has not been implemented yet.'
    );

  }

  /**
   * @covers Flownode\UI\Common\DOM\Node::__call
   * @todo Implement test__call().
   */
  public function test__call()
  {
    // Remove the following lines when you implement this test.
    $this->markTestIncomplete(
        'This test has not been implemented yet.'
    );

  }

  /**
   * Check if the method return the calling node
   * @covers Flownode\UI\Common\DOM\Node::setTagName
   */
  public function testSetTagNameReturnValue()
  {
    $this->setUp('a');

    $node = $this->root->setTagName('t');

    $this->assertSame($this->root, $node);

  }

  /**
   * @covers Flownode\Node\Node::setAttributes
   * @covers Flownode\Node\Node::setAttribute
   */
  public function testLastOpendedNode()
  {
    $this->setUp('span');

    $this->root->open('i');

    $tag = $this->root->setAttribute('class', 'class1')->render();

    $assert = '<span><i class="class1"></i></span>';

    $this->assertEquals($assert, $tag);
  }

}