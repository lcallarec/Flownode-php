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
 *
 * @author Laurent CALLAREC <lcallarec@gmail.com>
 */
class Hr extends Element
{
  const TYPE = 'hr';
  /**
   *
   * @param mixed $text (string or array of strings)
   */
  public function __construct($rules = 'default')
  {
    $this->rules = $rules;
  }

}