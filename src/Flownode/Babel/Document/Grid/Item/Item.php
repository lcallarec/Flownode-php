<?php
/**
 * This file is part of the Flownode package
 *
 * (c) Laurent CALLAREC <l.callarec@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Flownode\Babel\Document\Grid\Item;
use
  Flownode\Babel\Document\Element\Element
;
/**
 *
 * @author Laurent CALLAREC <l.callarec@gmail.com>
 */
class Item extends Element
{
 /**
   * Paragraph text
   *
   * @var string
   */
  protected $text;

  /**
   *
   * @param string $text
   */
  public function __construct($text = '')
  {
    $this->text = $text;
  }

  public function render()
  {
    return $this->text;
  }
}