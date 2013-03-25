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
class TitleManager
{
  const NAME = 'title';
 /**
   * Current title level, before calling to addTitle() method
   *
   * @var integer
   */
  protected $level = 0;

  protected $levelRail = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

  /**
   * Each value must be a static variable inside the getTitlerefix method
   * (ugly)
   *
   * @var array
   */
  protected $titleMask = array('num', 'num', 'num', 'num', 'num', 'num', 'num', 'num');

  protected $title = array();

  public function getLevel()
  {
    return $this->level;
  }

  /**
   *
   * @staticvar array   $num
   * @param     int     $level
   * @return    string  The prefix, like 1.2.3.3
   */
  public function getTitlePrefix($level = 0)
  {

    static $num = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15);

    if($level != 0)
    {
      if($this->level > $level)
      {
        $this->levelRail[$this->level] = 0;
        array_splice($this->title, $level - $this->level - 1);
      }

      $tmp = $this->levelRail[$level]++;

      $this->title[$level] = ${$this->titleMask[$level]}[$tmp];

      $this->level = $level;

      return implode(".", $this->title) . '. ';
    }

    return '';
  }
}