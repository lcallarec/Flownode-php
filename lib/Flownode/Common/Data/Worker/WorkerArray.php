<?php
namespace Flownode\Common\Data\Worker;

class WorkerArray implements Flownode\Common\Data\Worker\WorkerInterface
{
  /**
   * Get the value deep inside multi-array
   *
   * @uses With $path = MyData.MyChild, will return the content of $data['MyData']['MyChild']
   * @uses With $prefix = 'Your', will return the content of $data['YourMyData'][Your'MyChild']
   *
   * @param string  $path
   * @param array   $data       Data array
   * @param string  $seperator  Path separator
   * @param string  $prefix     Prefix of each parts of path
   * @return string
   */
  public function getValueFromPath($path, $data, $seperator = '.', $prefix = '')
  {
    $paths = explode($seperator, (string) $path);
    $value = $data;
    foreach($paths as $path)
    {
      $getter = $prefix.$path;
      $value  = $value[$getter];
    }

    return $value;
  }
}