<?php
/**
 * This file is part of the Flownode package
 *
 * (c) Laurent CALLAREC <l.callarec@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Flownode\Babel\Manager;
/**
 *
 * @author Laurent CALLAREC <l.callarec@gmail.com>
 */
class TOCManager
{
  const NAME = 'toc';

  /**
   * Hash of titles
   *
   * Values are arrays :
   * [prefix]
   * [name]
   * [page]
   *
   * @var array
   */
  protected $titles = array();

  /**
   * Register a title to the TOC
   *
   * @param type   $prefix  refix name (like 1.1.2.4)
   * @param string $name    Entry name
   * @param int    $page    Page number
   */
  public function register($prefix, $name, $page = null)
  {
    $this->titles[] = array('prefix' => $prefix, 'name' => $name, 'page' => $page);
  }

}