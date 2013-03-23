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
   * Laucnh format process
   * @return \Flownode\Babel\Document\Element\Paragraph
   */
  public function format()
  {
    $this->formatter->addImage($this->src, $this->alt, $this->rules);

    return $this;
  }
}