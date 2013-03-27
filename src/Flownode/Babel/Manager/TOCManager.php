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
use
  Flownode\Babel\Formatter\FormatterInterface
;
/**
 *
 * @author Laurent CALLAREC <l.callarec@gmail.com>
 */
class TOCManager extends Manager
{
  const NAME = 'toc';

  /**
   * Position of the TOC inside the document
   */
  const POSITION_LAST  = 'LAST';
  const POSITION_FIRST = 'FIRST';


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
   * Position of TOC inside the document
   * May be : self::POSITION_LAST or self::POSITION_FIRST
   * @var string
   */
  protected $position;

  /**
   *
   * @param string $page
   */
  public function __construct($position)
  {
    $this->position = $position;
  }

  /**
   * Register a title to the TOC
   *
   * @param type   $prefix  refix name (like 1.1.2.4)
   * @param string $name    Entry name
   * @param string $id      "Anchor" id
   */
  public function register($prefix, $name, $id)
  {
    $this->titles[] = array('prefix' => $prefix, 'name' => $name, 'id' => $id);
  }


  /**
   * Get the hash of titles
   * @return array
   */
  public function getTitles()
  {
    return $this->titles;
  }

  /**
   * Launch the format process
   *
   * @return \Flownode\Babel\Manager\TOCManager
   */
  public function format()
  {
    $this->formatter->addTOC($this, $this->position);

    return $this;
  }

}