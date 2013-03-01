<?php
/**
 * This file is part of the Flownode package
 *
 * (c) Laurent CALLAREC <lcallarec@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Flownode\Babel\Document\Grid;

use
  Flownode\Babel\Document\Element\Element,
  Flownode\Babel\Document\Grid\Cell
;
/**
 *
 * @author Laurent CALLAREC <lcallarec@gmail.com>
 */
class Grid extends Element
{
  protected $formatter = null;

  /**
   *
   * @var array
   */
  protected $headers;

  /**
   *
   * @var array
   */
  protected $body = array();

  /**
   * Laucnh format process
   * @return \Flownode\Babel\Document\Element\Paragraph
   */
  public function format()
  {
    $this->formatter->addGrid($this->headers, $this->body);

    return $this;
  }

  /**
   * Add headers, only one set of headers can be set
   * @param array $headers
   * @return \Flownode\Babel\Document\Grid\Grid
   */
  public function setHeaders(array $headers)
  {
    $this->headers = array($headers);

    return $this;
  }

  /**
   * Add body parts, sevral are possible for a grid
   *
   * @param array $body
   * @return \Flownode\Babel\Document\Grid\Grid
   */
  public function addBodyPart(array $body)
  {
    $this->body[] = $body;

    return $this;
  }
}

