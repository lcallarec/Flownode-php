<?php
namespace Flownode\Babel\Component\Base;
use
  Flownode\Babel\Component\Component
;
/**
 * Description of Grid
 *
 * @author lcallarec
 */
class Title extends Component
{
  protected $title;

  public function __construct($title = '')
  {
    $this->title = $title;
  }

  public function format()
  {
    $this->formatter->addTitle($this->title);
  }

}

