<?php
namespace Flownode\Common\Formatter;

abstract class Formatter implements Flownode\Common\Formatter\FormatterInterface
{

  /**
   * Contains formatter content (i.e. html document, pdf document...)
   * @var mixed
   */
  protected $content = null;

  /**
   * Level of the current node inside the document
   * @var int
   */
  protected $level   = null;

  /**
   * Current document margins
   *
   * @var array
   */
  protected $margins  = array('top' => 0, 'right' => 0, 'bottom' => 0, 'left' => 0);

 /**
  * Return formatted content (can be a ressource, i.e. PDF)
  * @return mixed
  */
  public function getContent()
  {
    return $this->content;
  }

  /**
   * Define depth of a chapter
   *
   * @param int $level
   */
  public function setLevel($level)
  {
    $this->level = $level;
  }

  /**
   * Define document margins (top, right, bottom, left)
   *
   * @param array $margins
   */
  public function setMargins($margins)
  {
    $this->margins = $margins;
  }

}

