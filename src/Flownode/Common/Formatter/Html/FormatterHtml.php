<?php
namespace Flownode\Common\Formatter\Html;

class FormatterHtml extends Flownode\Common\Formatter\Formatter
{
  const SECTION_TAG = 'div';

  /**
   * Standard document font
   * @var string
   */
  protected $fontFamily = 'arial';

  /**
   * Standard document fontsize
   * @var int
   */
  protected $fontSize   = 7;

  public function __construct()
  {
    $this->content = '';
  }

  /**
   * Format a simple paragraph
   * Support HTML tags
   *
   * @param string $text
   */
  public function addText($text, $margin = 30, $options = array())
  {
    $this->addContent($text, $margin);
  }

  /**
   * Embed image to HTML document
   *
   * @param string $src imageg path
   * @param string $legend
   */
  public function addImage($src, $legend = '', $attributes = array())
  {
    $this->addContent(sprintf('<img src="%s"/>', $src));
  }

  public function addHeader($title, $titlePrefix = null)
  {
    $this->addContent(vsprintf('<h%s>%s%s</h%s>', array($this->level, $titlePrefix, $title, $this->level)));
  }

  public function addGrid($title, $headers, $rows)
  {
    $this->content .= 'table';
  }

  public function openSection()
  {
    $this->addContent('<'.self::SECTION_TAG.' style="margin: '.$this->computeMargins().';">');
  }

  public function closeSection()
  {
    $this->addContent('</'.self::SECTION_TAG.'>');
  }

  public function addContent($text = '', $margin = 0, $options = array())  {

    $this->content .= $text;
  }

  protected function computeMargins()
  {
    return  $this->margins['top'].'px '
           .$this->margins['right'].'px '
           .$this->margins['bottom'].'px '
           .$this->margins['left'].'px';
  }

  public function registerIndexImage(){}

  public function registerIndexTable(){}

  public function addVerticalGrid($label, $columns, $rows){}

  public function addBlock($type, $message, $margin){}

}

