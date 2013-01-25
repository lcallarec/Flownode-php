<?php
/**
 * This factory return a worker object according to collection type
 *
 * @author Laurent CALLAREC <lcallarec@qualea.fr>
 */
class qDataWorkerFactory
{
  /**
   *
   * @param array $data
   *
   * @return qDataWorkerArray|qDataWorkerObject|null
   * @throws InvalidArgumentException
   */
  static public function create($data)
  {
    if(count($data))
    {
      //Get the real type of first entry
      switch(gettype($data[0]))
      {
        case 'array':
          return new qDataWorkerArray();
          break;

        case 'object':
          return new qDataWorkerObject();
          break;

        default:
          throw new InvalidArgumentException('Invalid data type');
      }
    }
    else
    {
      return null;
    }
  }
}