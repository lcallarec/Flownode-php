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
  Flownode\Babel\Formatter\FormatterInterface
;
/**
 *
 * Common interface for all Elements
 *
 * @author Laurent CALLAREC <lcallarec@gmail.com>
 */
interface ElementInterface
{
  /**
   * Launch format process
   *
   * @return self
   */
  public function format();

  /**
   * Set the element formatter
   *
   * @param \Flownode\Babel\Formatter\FormatterInterface $formatter
   * @return self
   */
  public function setFormatter(FormatterInterface $formatter);

}

