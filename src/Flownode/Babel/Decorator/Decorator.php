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
 * Abstract class for handling styles
 *
 * @author Laurent CALLAREC <l.callarec@gmail.com>
 */
abstract class Decorator
{
  /**
   * Contain all styles definitions
   * key   : string   style name
   * value : Closure  function to apply
   * @var array
   */
  protected $closures = array();

  public function __construct()
  {

  }

  public function set($name, \Closure $decorator)
  {
    $this->closures[$name] = $decorator;
  }

  function get($name = null)
  {
    if(null !== $name)
    {
      return $this->closures[$name];
    }

    return null;
  }
}