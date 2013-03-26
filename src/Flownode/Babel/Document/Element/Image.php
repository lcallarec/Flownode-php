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
class Image extends Element
{
  const TYPE = 'image';

  /**
   * Path of image file
   *
   * @var string
   */
  protected $src;

  /**
   * Alternative text
   *
   * @var string
   */
  protected $alt;

  /**
   *
   * @param string $text
   */
  public function __construct($src, $alt ='', $rules = 'default')
  {
    $this->src   = $src;
    $this->alt   = $alt;
    $this->rules = $rules;
  }

  /**
   * Get src value
   *
   * @return string
   */
  public function getSrc()
  {
    return $this->src;
  }

  /**
   * Get alt value
   *
   * @return string
   */
  public function getAlt()
  {
    return $this->alt;
  }
}