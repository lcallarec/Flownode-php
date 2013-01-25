<?php
namespace Flownode\Common\Data\Worker;

class WorkerObject implements Flownode\Common\Data\Worker\WorkerInterface
{
   /**
   * Get the value deep inside multi-array object
   *
   * @uses With $path = MyData.MyChild, will return the content of $data->MyData()->MyChiuld();
   * @uses With $prefix = 'get', will return the content of $data->getMyData()-get>MyChiuld();
   *
   * @param string        $path
   * @param ArrayObject   $data       Data object
   * @param string        $seperator  Path separator
   * @param string        $prefix     Prefix of each parts of path
   * @return string
   */
  public function getValueFromPath($path, $data, $seperator = '.', $prefix = 'get')
  {
    $paths = explode($seperator, (string) $path);
    $value = $data;

    foreach($paths as $path)
    {
      if(is_object($value))
      {
        $getter = $prefix.$path;
        $value  = $value->$getter();
      }
    }

    return $value;
  }
}