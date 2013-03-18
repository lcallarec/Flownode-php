<?php
/**
 * This file is part of the Flownode package
 *
 * (c) Laurent CALLAREC <l.callarec@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Flownode\Babel\Formatter;

use
  Flownode\Babel\Formatter\FormatterInterface,
  Flownode\Babel\Document\TitleManager
;
/**
 * PDF Formatter using TCPDF
 *
 * @author Laurent CALLAREC <l.callarec@gmail.com>
 */
abstract class Formatter implements FormatterInterface
{
  /**
   *
   * @var TitleManager
   */
  protected $titleManager;
  /**
   * Formatter content
   *
   * @var mixed
   */
  protected $content;

  public function __construct()
  {
    $this->titleManager = new TitleManager();
  }

}

