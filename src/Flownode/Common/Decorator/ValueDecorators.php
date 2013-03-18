<?php

/**
 * This file is part of the Flownode package
 *
 * (c) Laurent CALLAREC <l.callarec@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Flownode\Common\Decorators;
/**
 *
 * @author Laurent CALLAREC <l.callarec@gmail.com>
 */
class ValueDecorators
{
  /**
   * Contain all value decorator definitions
   * key   : string   style name
   * value : Closure  function to apply
   * @var array
   */
  static protected $decorators = array();

  private function __construct(){}

  static public function set($decorator, \Closure $function)
  {
    self::$decorators[$decorator] = $function;
  }

  static function get($decorator)
  {
    return self::$decorators[$decorator];
  }
}