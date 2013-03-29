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
class TOC extends Element
{
  const TYPE = 'toc';

  /**
   *
   * @var array
   */
  protected $toc;

  /**
   *
   * @param string $title
   */
  public function __construct($rules = 'default')
  {
    $this->rules = $rules;
  }

  public function getTitles()
  {
    return $this->document->getManager('title')->toc;
  }

}

