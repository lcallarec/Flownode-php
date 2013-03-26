<?php
/**
 * This file is part of the Flownode package
 *
 * (c) Laurent CALLAREC <lcallarec@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Flownode\Babel\Document\Element;
use
  Flownode\Babel\Document\Element\Element
;
/**
 *
 * @author Laurent CALLAREC <lcallarec@gmail.com>
 */
class Link extends Element
{
  const TYPE = 'link';

  /**
   * URL of the ressource
   * @var string
   */
  protected $href;

  /**
   * Name of the link
   *
   * @var string
   */
  protected $name;


  /**
   * Where the link is open
   * Apply only for html format
   *
   * @var string
   */
  protected $target;

  /**
   * Apply only for html format
   *
   * @var string
   */
  protected $rel;

  /**
   *
   * @param type $href
   * @param type $name
   * @param type $target
   * @param type $rel
   * @param type $rules
   */
  public function __construct($href, $name, $target = '_blank', $rel = 'nofollow', $rules = 'default')
  {
    $this->href  = $href;

    $this->name  = $name;

    $this->target= $target;

    $this->rel   = $rel;

    $this->rules = $rules;
  }

  /**
   * Get href value
   * @return string
   */
  public function getHref()
  {
    return $this->href;
  }

  /**
   * Get name value
   * @return string
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * Get target value
   * @return string
   */
  public function getTarget()
  {
    return $this->target;
  }

  /**
   * Get rel value
   * @return string
   */
  public function getRel()
  {
    return $this->rel;
  }
}

