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
  Flownode\Babel\Document\TitleManager,
  Flownode\Babel\Decorator\Decorator
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
   * @var Flownode\Babel\Decorator\Decorator
   */
  protected $decorator = null;

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

  protected $fontFamily = 'dejavusans';
  protected $fontSize   = '6';

  /**
   *
   * @param Decorator $decorator
   */
  public function __construct(Decorator $decorator)
  {
    $this->titleManager = new TitleManager();

    $this->decorator    = $decorator;
  }

  /**
   *
   * @return Decorator
   */
  public function getDecorator()
  {
    return $this->decorator;
  }

  public function setFontSize($fontSize)
  {
    $this->fontSize = $fontSize;

    return $this;
  }

  public function setFontFamily($fontFamily)
  {
    $this->fontFamily = $fontFamily;

    return $this;
  }

  public function getFontSize()
  {
    return $this->fontSize;
  }

  public function getFontFamily()
  {
    return $this->fontFamily;
  }

}

