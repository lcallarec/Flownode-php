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
  protected $rules = array();

  /**
   *
   * @param string $rule
   * @param \Closure $decorator
   */
  public function set($name, \Closure $rule)
  {
    $this->rules[$name] = $rule;
  }

  /**
   * Get the rule
   *
   * @param string $rule
   * @return \Closure
   */
  function get($rule)
  {
    if(null !== $rule)
    {
      return $this->rules[$rule];
    }

    return $this->rules['default'];
  }
}