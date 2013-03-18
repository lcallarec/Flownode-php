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

  public function __construct()
  {
    parent::__construct();

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

    $this->content->SetFont('dejavusans', '', 10);

    $this->content->AddPage();

    TcpdfStyles::set('default', function($value, $formatter) {

      $formatter->getContent()->SetTextColorArray(array(0, 0, 0));

      $formatter->getContent()->SetFontSize(11);

    });


     TcpdfStyles::set('title.1', function($value, $formatter) {

        $formatter->getContent()->SetTextColorArray(array(33, 64, 95));
        $formatter->getContent()->SetFontSize(18);

        return array('B' => array('width' => 0.2, 'color' => array(33, 64, 95)));

     });

     TcpdfStyles::set('title.2', function($value, $formatter) {

        $formatter->getContent()->SetTextColorArray(array(33, 64, 95));
        $formatter->getContent()->SetFontSize(16);

        return array('B' => array('width' => 0.2, 'color' => array(33, 64, 95)));

     });




  }

  /**
   * Add a paragraph
   * @param string $content
   */
  public function addParagraph($content = '', $style = null)
  {
    $this->content->Cell(50, 10, $content, 0, 1);
  }

  /**
   *
   * @param type $title
   * @param type $level
   * @param type $suffix
   */
  public function addTitle($title = '', $level = 0)
  {
    $style = TcpdfStyles::get('title.'.$level);

    $borders = $style($title, $this);

    $this->content->Cell(0, 10, $this->titleManager->getTitlePrefix($level).$title, $borders, 1);

    $this->content->Ln(5);

    $style = TcpdfStyles::get('default');

    $style($title, $this);
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

    $grid->addHeaders();

    $grid->addRows();

  }


}

