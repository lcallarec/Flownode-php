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
    $this->set('default', function($formatter, &$value) {
      $formatter->getContent()->SetTextColorArray(array(0, 0, 0));
      $formatter->getContent()->SetFillColorArray(array(255, 255, 255));
      $formatter->getContent()->SetFont($formatter->getFontFamily(), '', $formatter->getFontSize());
    });

    $this->set('grid.default', function($formatter, &$value) {

    });

    $this->set('grid.reset', function($formatter, &$value) {

    });

    $this->set('header.0', function($formatter, &$value, &$borders) {

      $formatter->getContent()->SetTextColorArray(array(33, 64, 95));
      $formatter->getContent()->SetFontSize(24);

      $borders = array('B' => array('width' => 0.2, 'color' => array(33, 64, 95)));

    });

    $this->set('header.1', function($formatter, &$value, &$borders) {

      $formatter->getContent()->SetTextColorArray(array(33, 64, 95));
      $formatter->getContent()->SetFontSize(18);

      $borders = array('B' => array('width' => 0.2, 'color' => array(33, 64, 95)));

    });

    $this->set('header.2', function($formatter, &$value, &$borders) {

      $formatter->getContent()->SetTextColorArray(array(33, 64, 95));
      $formatter->getContent()->SetFontSize(16);

      $borders = array('B' => array('width' => 0.2, 'color' => array(33, 64, 95)));

    });

    $this->set('header.3', function($formatter, &$value, &$borders) {

      $formatter->getContent()->SetTextColorArray(array(33, 64, 95));
      $formatter->getContent()->SetFontSize(16);

      $borders = array('B' => array('width' => 0.2, 'color' => array(33, 64, 95)));

    });

    $this->set('header.4', function($formatter, &$value, &$borders) {

      $formatter->getContent()->SetTextColorArray(array(33, 64, 95));
      $formatter->getContent()->SetFontSize(16);

      $borders = array('B' => array('width' => 0.2, 'color' => array(33, 64, 95)));

    });

    //Styles
    $this->set('strong', function($formatter, &$value) {
      $formatter->getContent()->SetFont($formatter->getFontFamily(), $formatter->getContent()->getFontStyle().'B', $formatter->getFontSize());
    });

    $this->set('italic', function($formatter, &$value) {
      $formatter->getContent()->SetFont($formatter->getFontFamily(), $formatter->getContent()->getFontStyle().'I', $formatter->getFontSize());
    });

    $this->set('underline', function($formatter, &$value) {
      $formatter->getContent()->SetFont($formatter->getFontFamily(), $formatter->getContent()->getFontStyle().'U', $formatter->getFontSize());
    });

    $this->set('strikeout', function($formatter, &$value) {
      $formatter->getContent()->SetFont($formatter->getFontFamily(), $formatter->getContent()->getFontStyle().'D', $formatter->getFontSize());
    });
  }
}