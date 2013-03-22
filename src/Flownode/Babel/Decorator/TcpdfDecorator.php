<?php
/**
 * This file is part of the Flownode package
 *
 * (c) Laurent CALLAREC <l.callarec@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Flownode\Babel\Decorator;
/**
 * Class for handling styles
 *
 * @author Laurent CALLAREC <l.callarec@gmail.com>
 */
class TcpdfDecorator extends Decorator
{

  public function __construct()
  {
    $this->set('default', function($value, $formatter) {
      $formatter->getContent()->SetTextColorArray(array(0, 0, 0));
      $formatter->getContent()->SetFillColorArray(array(255, 255, 255));
      $formatter->getContent()->SetFont($formatter->getFontFamily(), '', $formatter->getFontSize());
    });

    $this->set('grid.default', function($value, $formatter) {

    });

    $this->set('grid.reset', function($value, $formatter) {

    });

    $this->set('header.0', function($value, $formatter, &$borders) {

      $formatter->getContent()->SetTextColorArray(array(33, 64, 95));
      $formatter->getContent()->SetFontSize(24);

      $borders = array('B' => array('width' => 0.2, 'color' => array(33, 64, 95)));

    });

    $this->set('header.1', function($value, $formatter, &$borders) {

      $formatter->getContent()->SetTextColorArray(array(33, 64, 95));
      $formatter->getContent()->SetFontSize(18);

      $borders = array('B' => array('width' => 0.2, 'color' => array(33, 64, 95)));

    });

    $this->set('header.2', function($value, $formatter, &$borders) {

      $formatter->getContent()->SetTextColorArray(array(33, 64, 95));
      $formatter->getContent()->SetFontSize(16);

      $borders = array('B' => array('width' => 0.2, 'color' => array(33, 64, 95)));

    });

    $this->set('header.3', function($value, $formatter, &$borders) {

      $formatter->getContent()->SetTextColorArray(array(33, 64, 95));
      $formatter->getContent()->SetFontSize(16);

      $borders = array('B' => array('width' => 0.2, 'color' => array(33, 64, 95)));

    });

      $this->set('header.4', function($value, $formatter, &$borders) {

      $formatter->getContent()->SetTextColorArray(array(33, 64, 95));
      $formatter->getContent()->SetFontSize(16);

      $borders = array('B' => array('width' => 0.2, 'color' => array(33, 64, 95)));

    });
  }
}