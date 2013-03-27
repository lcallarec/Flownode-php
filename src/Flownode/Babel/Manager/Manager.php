<?php
/**
 * This file is part of the Flownode package
 *
 * (c) Laurent CALLAREC <l.callarec@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Flownode\Babel\Manager;

use
  Flownode\Babel\Formatter\FormatterInterface
;
/**
 *
 * @author Laurent CALLAREC <l.callarec@gmail.com>
 */
abstract class Manager
{
  const NAME = null;

  /**
   * \Flownode\Babel\Formatter\FormatterInterface
   * @var FormatterInterface
   */
  protected $formatter;

  /**
   *
   * @param \Flownode\Babel\Formatter\FormatterInterface $formatter
   * @return self
   */
  public function setFormatter(FormatterInterface $formatter)
  {
    $this->formatter = $formatter;

    return $this;
  }

  public function format()
  {

  }
}