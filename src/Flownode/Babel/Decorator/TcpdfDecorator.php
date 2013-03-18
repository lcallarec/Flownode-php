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

      $formatter->getContent()->SetFontSize(11);
      $formatter->getContent()->SetFillColorArray(array(255, 255, 255));

    });


    $this->set('title.1', function($value, $formatter) {

      $formatter->getContent()->SetTextColorArray(array(33, 64, 95));
      $formatter->getContent()->SetFontSize(18);

      return array('B' => array('width' => 0.2, 'color' => array(33, 64, 95)));

    });

    $this->set('title.2', function($value, $formatter) {

      $formatter->getContent()->SetTextColorArray(array(33, 64, 95));
      $formatter->getContent()->SetFontSize(16);

      return array('B' => array('width' => 0.2, 'color' => array(33, 64, 95)));

    });
  }
}