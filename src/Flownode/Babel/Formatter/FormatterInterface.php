<?php
/**
 * This file is part of the Flownode package
 *
 * (c) Laurent CALLAREC <lcallarec@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Flownode\Babel\Formatter;

/**
 * Common interface for all formatters
 *
 * @author Laurent CALLAREC <lcallarec@gmail.com>
 */
interface FormatterInterface
{

  public function getContent();
  public function addParagraph($text = '', $style);
  public function addTitle($title = '', $level = '');
}

