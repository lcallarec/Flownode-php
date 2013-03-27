<?php
/**
 * This file is part of the Flownode package
 *
 * (c) Laurent CALLAREC <l.callarec@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Flownode\Babel\Formatter\Html;

use
  Flownode\Babel\Formatter\Formatter as AbstractFormatter,
  Flownode\Babel\Formatter\Html\GridFormatter
;

/**
 * HTML Formatter
 *
 * @author Laurent CALLAREC <l.callarec@gmail.com>
 */
class Formatter extends AbstractFormatter
{

  /**
   * Formatter content
   *
   * @var string
   */
  protected $content = '';

  /**
   *
   * @param \Flownode\Babel\Decorator\Decorator $decorator
   */
  public function __construct(\Flownode\Babel\Decorator\Decorator $decorator)
  {
    parent::__construct($decorator);
  }

  /**
   *
   * @param \Flownode\Babel\Document\Element\Paragraph $paragraph
   * @return void
   */
  public function addParagraph(\Flownode\Babel\Document\Element\Paragraph $paragraph)
  {
    $attributes = array();
    $content    = $paragraph->getText();
    if($rules = $paragraph->getRules())
    {
      $this->executeRules($rules, $content, $attributes);
    }

    $attributes = $this->formatStyle($attributes);

    $this->content .= '<p '.$attributes.'>'.$content.'</p>';
  }

  /**
   *
   * @param \Flownode\Babel\Document\Element\Title $title
   * @return void
   */
  public function addTitle(\Flownode\Babel\Document\Element\Title $title)
  {
    $attributes = array('id' => $title->getId());
    $titleName = $title->getTitle();
    $level     = $title->getLevel();
    if($rules = $title->getRules())
    {
      $this->executeRules($rules, $titleName, $attributes);
    }

    $attributes = $this->formatStyle($attributes);
    $title->getDocument()->getManager('toc')->register($title->getPrefix(), $titleName, $title->getId());

    $this->content .= '<h'.$level.' '.$attributes.'>'.$title->getPrefix().$titleName.'</h'.$level.'>';
  }

  /**
   *
   * @param \Flownode\Babel\Document\Element\Image $image
   * @return void
   */
  public function addImage(\Flownode\Babel\Document\Element\Image $image)
  {
    $attributes = array();
    $src = $image->getSrc();
    $alt = $image->getAlt();
    if($rules = $image->getRules())
    {
      $this->executeRules($rules, $src, $attributes);
    }

    $attributes = $this->formatStyle($attributes);

    $this->content .= '<img '.$attributes.' src="'.$src.'" alt="'.$alt.'" />';

  }

  /**
   *
   * @param \Flownode\Babel\Document\Element\Hr $hr
   * @return void
   */
  public function addHr(\Flownode\Babel\Document\Element\Hr $hr)
  {
    $attributes = array();
    if($rules = $hr->getRules())
    {
      $this->executeRules($rules, $attributes);
    }

    $attributes = $this->formatStyle($attributes);

    $this->content .= '<hr '.$attributes.' />';
  }

  /**
   *
   * @param \Flownode\Babel\Document\Element\Link $link
   * @return void
   */
  public function addLink(\Flownode\Babel\Document\Element\Link $link)
  {
    $attributes = array();
    $href   = $link->getHref();
    $name   = $link->getName();
    $target = $link->getTarget();
    $rel    = $link->getRel();
    if($target)
    {
      $attribute['target'] = $target;
    }

    if($rel)
    {
      $attribute['rel'] = $rel;
    }

    $this->executeRules($link->getRules(), $attributes);

    $attributes = $this->formatStyle($attributes);

    $this->content .= '<a href="'.$href.'" '.$attributes.'>'.$name.'</a>';
  }

  /**
   *
   * @param \Flownode\Babel\Document\Element\Paragraph $grid
   * @return void
   */
  public function addGrid(\Flownode\Babel\Document\Grid\Grid $grid)
  {

    $formatter = new GridFormatter($this, $grid->getColumns(), $grid->getArrayCopy());
    $formatter->setRowDecorator($grid->getRowDecorator());

    $this->content .= '<table>';

    $formatter->addHeaders();
    $formatter->addRows();

    $this->content .= '</table>';

  }

  /**
   *
   * @param \Flownode\Babel\Document\Element\Link $link
   * @param string $position
   * @return void
   */
  public function addTOC(\Flownode\Babel\Manager\TOCManager $toc, $position)
  {
    $formatter = new TOCFormatter($this, $toc);

    if($position === \Flownode\Babel\Manager\TOCManager::POSITION_FIRST)
    {
      $this->content = $formatter->getContent().$this->content;
    }
    else
    {
      $this->content .= $formatter->getContent();
    }
  }


  public function append($content = '')
  {
    $this->content .= $content;
  }

  /**
   *
   * @return string
   */
  public function getContent()
  {
    return $this->content;
  }

  /**
   * Transform an array of attributes into a string
   * @param array $styles
   * @return string
   */
  public function formatStyle($styles)
  {
    $sStyles = '';
    foreach($styles as $attribute => $value)
    {
      $sStyles .= $attribute.'="'.$value.'" ';
    }
    return $sStyles;
  }

}

