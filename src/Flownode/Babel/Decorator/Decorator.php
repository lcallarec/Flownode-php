<?php
/**
 * This file is part of the Flownode package
 *
 * (c) Laurent CALLAREC <lcallarec@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Flownode\Babel\Styles;
/**
 * Abstract class for handling styles
 *
 * @author Laurent CALLAREC <lcallarec@gmail.com>
 */
abstract class Styles
{
  /**
   * Contain all styles definitions
   * key   : string   style name
   * value : Closure  function to apply
   * @var array
   */
  static protected $styles = array();

  private function __construct(){}

  static public function set($style, \Closure $function)
  {
    self::$styles[$style] = $function;
  }

  static function get($style)
  {
    return self::$styles[$style];
  }
}