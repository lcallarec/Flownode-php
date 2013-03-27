<?php
/**
 * This file is part of the Flownode package
 *
 * (c) Laurent CALLAREC <l.callarec@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Flownode\Babel\Formatter\Tcpdf;

use
  Flownode\Babel\Formatter\Formatter as AbstractFormatter,
  Flownode\Babel\Formatter\Tcpdf\GridFormatter
;

/**
 * PDF Formatter using TCPDF
 *
 * @author Laurent CALLAREC <l.callarec@gmail.com>
 */
class Formatter extends AbstractFormatter
{

  /**
   *
   * @param \Flownode\Babel\Decorator\Decorator $decorator
   */
  public function __construct(\Flownode\Babel\Decorator\Decorator $decorator)
  {
    parent::__construct($decorator);

    $this->content = new \TCPDF('P', \PDF_UNIT, 'A4');

    $this->content->SetDefaultMonospacedFont(\PDF_FONT_MONOSPACED);

    $this->content->SetMargins(PDF_MARGIN_LEFT, 15, PDF_MARGIN_RIGHT);
    $this->content->SetHeaderMargin(5);
    $this->content->SetFooterMargin(10);

    $this->content->setPrintHeader(false);
    $this->content->setPrintFooter(false);

    $this->content->setFontSubsetting(false);

    //set auto page breaks
    $this->content->SetAutoPageBreak(TRUE, 15);

    $this->content->AddPage();

  }

  /**
   *
   * @param \Flownode\Babel\Document\Element\Paragraph $paragraph
   * @return void
   */
  public function addParagraph(\Flownode\Babel\Document\Element\Paragraph $paragraph)
  {
    $text = $paragraph->getText();
    $this->executeRules($paragraph->getRules(), $text);
    $this->content->Cell(50, 10, $text, 0, 1);
    $this->executeRules('default');
  }

  /**
   *
   * @param \Flownode\Babel\Document\Element\Title $title
   * @return void
   */
  public function addTitle(\Flownode\Babel\Document\Element\Title $title)
  {
    $borders = array();

    $titleName = $title->getTitle();

    $this->executeRules('header.'.$title->getLevel(), $titleName, $borders);

    $this->content->Bookmark( $title->getPrefix().$titleName, $title->getLevel());
    $this->content->Cell(0, 10, $title->getPrefix().$titleName, $borders, 1);

    $this->content->Ln(5);

    $this->executeRules('default');
  }

  /**
   *
   * @param \Flownode\Babel\Document\Element\Image $image
   * @return void
   */
  public function addImage(\Flownode\Babel\Document\Element\Image $image)
  {
    $src = $image->getSrc();
    $this->executeRules($image->getRules(), $src);

    $this->content->Image($image->getSrc(), '', '', '', '', '', '', 'N', false, 300, '', false, false, 0, false, false, true);

    $this->executeRules('default', $src);
  }

  /**
   *
   * @param \Flownode\Babel\Document\Element\Hr $hr
   * @return void
   */
  public function addHr(\Flownode\Babel\Document\Element\Hr $hr)
  {
    $this->executeRules($hr->getRules());

    $this->content->Cell(0, 0, '', 'B', 1);
  }

  /**
   *
   * @param \Flownode\Babel\Document\Element\Link $link
   * @return void
   */
  public function addLink(\Flownode\Babel\Document\Element\Link $link)
  {
    $href   = $link->getHref();
    $name   = $link->getName();

    $this->executeRules($link->getRules(), $href, $name);

    $this->content->Write('', $name, $href, false, '', true);

    $this->executeRules('default');
  }

  /**
   *
   * @param \Flownode\Babel\Document\Element\Link $link
   * @param string  $position
   * @return void
   */
  public function addTOC(\Flownode\Babel\Manager\TOCManager $toc, $position)
  {
    $this->content->addTOCPage();
    if($position === \Flownode\Babel\Manager\TOCManager::POSITION_FIRST)
    {
      $position = 1;
    }
    else
    {
      $position = '';
    }

    $this->content->addTOC($position);
    $this->content->endTOCPage();
  }

  /**
   * Get the TCPDF writer ...
   *
   * @return string
   */
  public function getContent()
  {
    return $this->content;
  }

  /**
   *
   * @param \Flownode\Babel\Document\Grid\Grid $grid
   * @return void
   */
  public function addGrid(\Flownode\Babel\Document\Grid\Grid $grid)
  {

    $formatter = new GridFormatter($this, $grid->getColumns(), $grid->getArrayCopy());
    $formatter->setRowDecorator($grid->getRowDecorator());

    $formatter->addHeaders();

    $formatter->addRows();

  }

}

