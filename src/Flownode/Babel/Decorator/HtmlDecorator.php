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
class HtmlDecorator extends Decorator
{
  public function __construct()
  {
     $this->set('default', function($value, $formatter) {

       return array('style' => 'color: red;');

     });

     $this->set('title.0', function($value, $formatter) {

       return array('style' => 'color: red;');

     });

     $this->set('title.1', function($value, $formatter) {

       return array('style' => 'font-size: 1.5em; border-bottom: 1px solid grey;');

     });

     $this->set('title.2', function($value, $formatter) {

       return array('style' => 'font-size: 1.2em; border-bottom: 1px solid grey;');

     });
  }

}