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
  Flownode\Babel\Manager\TitleManager,
  Flownode\Babel\Decorator\Decorator,
  Flownode\Babel\Document\Element\ElementInterface
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
   * Formatter content
   *
   * @var mixed
   */
  protected $content;

  /**
   * Font family
   * @var string
   */
  protected $fontFamily = 'dejavusans';

  /**
   * Font size
   * @var int
   */
  protected $fontSize   = '10';


  /**
   * Hash of manager
   * @var array
   */
  protected $managers;

  /**
   *
   * @param Decorator $decorator
   */
  public function __construct(Decorator $decorator)
  {
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

  /**
   *
   * @param int $fontSize
   * @return \Flownode\Babel\Formatter\Formatter
   */
  public function setFontSize($fontSize)
  {
    $this->fontSize = $fontSize;

    return $this;
  }

  /**
   *
   * @param string $fontFamily
   * @return \Flownode\Babel\Formatter\Formatter
   */
  public function setFontFamily($fontFamily)
  {
    $this->fontFamily = $fontFamily;

    return $this;
  }

  /**
   *
   * @return int
   */
  public function getFontSize()
  {
    return $this->fontSize;
  }

  /**
   *
   * @return string
   */
  public function getFontFamily()
  {
    return $this->fontFamily;
  }

  /**
   *
   * @param mixed $rules
   * @param mixed $arg1
   * @param mixed $arg2
   * @param mixed $arg3
   * @param mixed $arg4
   */
  public function executeRules($rules, &$arg1 = null, &$arg2 = null, &$arg3 = null, &$arg4 = null)
  {
    $closures = $this->decorator->get($rules);

    foreach($closures as $name => $closure)
    {
      $closure($this, $arg1, $arg2, $arg3, $arg4);
    }
  }

  /**
   *
   * @param $manager
   * @return self
   */
  public function setManager($manager)
  {
    $this->managers[$manager::NAME] = $manager;

    return $this;
  }

  /**
   * @return $manager
   */
  public function getManager($type)
  {
    return $this->managers[$type];
  }


  /**
   * Call the formatter according to Element type
   * @param \Flownode\Babel\Document\Element\ElementInterface $element
   */
  public function format(ElementInterface $element)
  {
    $method = ucfirst($element::TYPE);

    $this->{'add'.$method}($element);
  }

}

