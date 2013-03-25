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
class Paragraph extends Element
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
  public function __construct($text = '', $rules = 'default')
  {
    $this->text = $text;

    $this->rules = $rules;
  }

  /**
   * Laucnh format process
   * @return \Flownode\Babel\Document\Element\Paragraph
   */
  public function format()
  {
    $this->formatter->addParagraph($this->text, $this->rules);

    return $this;
  }

  /**
   * Get text value
   * @return string
   */
  public function getText()
  {
    return $this->text;
  }
}

