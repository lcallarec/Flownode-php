<?php
namespace Flownode\Common\Formatter;

interface FormatterInterface
{
  public function getContent();

  public function addText($content, $attributes = array());

  //Added
  public function addParagraph($content, $attributes = array());

  public function addPanel($context, $attributes = array());
  //public function addBlock($type, $message, $margin);

  //Don't remember the use case
  //PErhaps useful to merge 2 formatters, but with PDF or XLS it's difficult
  //And with HTML, we can use addText
  //public function addContent($text = '', $margin = 0, $options = array());

  public function addImage($src, $attributes = array());


  //public function addTitle($title, $titlePrefix = null);
  public function addHeader($header, $level = null);

  //Not now
  //public function addGrid($title, $headers, $rows);

  //Not now
  //public function addVerticalGrid($label, $columns, $rows);

  public function setLevel($level);

  public function setMargins($margins);

  //Hmm ?
  //public function openSection();

  //hmm ?
  //public function closeSection();



}