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

/**
 * Table of content formatter
 *
 * @author Laurent CALLAREC <l.callarec@gmail.com>
 */
class TOCFormatter
{
  /**
   *
   * @var Flownode\Babel\Formatter\Html\Formatter;
   */
  protected $formatter;

  public function __construct(Formatter $formatter, $toc)
  {
    $this->formatter = $formatter;

    $this->content = '';
    foreach($toc->getTitles() as $title)
    {
      $this->content .= '<a href="#'.$title['id'].'">'.$title['name'].'</a><br />';
    }
  }

  /**
   * Get HTML TOC content
   * @return string
   */
  public function getContent()
  {
    return $this->content;
  }
}