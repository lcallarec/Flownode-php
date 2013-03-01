<?php
namespace Flownode\Babel\Formatter;

/**
 * Description of Grid
 *
 * @author lcallarec
 */
interface FormatterInterface
{

  public function getContent();
  public function addParagraph($text = '');
  public function addTitle($title = '', $level = 1, $suffix = '. ');
}

