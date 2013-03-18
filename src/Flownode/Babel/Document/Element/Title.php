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
  Flownode\Babel\Document\Element\Element
;
/**
 * Write document titles
 *
 * @author Laurent CALLAREC <lcallarec@gmail.com>
 */
class Title extends Element
{
  /**
   * Document title
   * @var string
   */
  protected $title;

  /**
   *
   * @param string $title
   */
  public function __construct($title = '', $level = 0)
  {
    $this->title = $title;

    $this->level = $level;
  }

  /**
   * Laucnh format process
   * @return \Flownode\Babel\Document\Element\Title
   */
  public function format()
  {
    $this->formatter->addTitle($this->title, $this->level);

    return $this;
  }

}

