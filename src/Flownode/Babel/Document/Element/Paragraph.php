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
  Flownode\Babel\Document\Element\ElementInterface
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
  public function __construct($text = '')
  {
    $this->text = $text;
  }

  /**
   * Laucnh format process
   * @return \Flownode\Babel\Document\Element\Paragraph
   */
  public function format()
  {
    parent::format();
    $this->formatter->addParagraph($this->text);

    return $this;
  }

  /**
   * For adding Element
   * @param \Flownode\Babel\Document\Element\ElementInterface $part
   */
  public function add(ElementInterface $part)
  {
    $this->append($part);
  }
}

