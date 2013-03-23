<?php
/**
 * This file is part of the Flownode package
 *
 * (c) Laurent CALLAREC <lcallarec@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Flownode\Babel\Formatter\Tcpdf;

use
  Flownode\Babel\Formatter\Formatter as AbstractFormatter,
  Flownode\Babel\Formatter\Tcpdf\GridFormatter,
  Flownode\Babel\Styles\TcpdfStyles;
;

/**
 * PDF Formatter using TCPDF
 *
 * @author Laurent CALLAREC <lcallarec@gmail.com>
 */
class Formatter extends AbstractFormatter
{

  public function __construct($decorator)
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
   * Add a paragraph
   * @param string $content
   */
  public function addParagraph($content = '', $rules = null)
  {
    $this->executeRules($rules, $content);
    $this->content->Cell(50, 10, $content, 0, 1);
    $this->executeRules('default');
  }

  /**
   *
   * @param type $title
   * @param type $level
   * @param type $suffix
   */
  public function addTitle($title = '', $level = 0, $rules = null)
  {
    $borders = array();
    $this->executeRules('header.'.$level, $title, $borders);

    $this->content->Cell(0, 10, $this->titleManager->getTitlePrefix($level).$title, $borders, 1);

    $this->content->Ln(5);

    $this->executeRules('default', $title);
  }

  /**
   *
   * @param string        $src
   * @param string        $alt
   * @param string |array $rules
   */
  public function addImage($src, $alt, $rules = null)
  {
    $this->executeRules($rules, $src);

    $this->content->Image($src, '', '', '', '', '', '', 'N', false, 300, '', false, false, 0, false, false, true);

    $this->executeRules('default', $title);
  }

  /**
   * Add horizontal rule
   * @param string |array $rules
   */
  public function addHr($rules = null)
  {
    
    $this->executeRules($rules);

    $this->content->Cell(0, 0, '', 'B', 1);

    $this->executeRules('default');
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
   *
   * @param array $headers
   * @param array $body
   */
  public function addGrid($columns, $datas, $rowDecorator = null)
  {

    $grid = new GridFormatter($this, $columns, $datas);
    $grid->setRowDecorator($rowDecorator);
    $grid->addHeaders();

    $grid->addRows();

  }

}

