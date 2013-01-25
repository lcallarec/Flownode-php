<?php
namespace Flownode\Common\Data\DataSource;

/**
 *
 * @author
 */
class Source extends Flownode\Common\Data\Collection\Collection
{
  /**
   * @var Flownode\Common\Data\WorkerInterface
   */
  private $worker;

  public function __construct($data)
  {
    parent::__construct($data);

    $this->worker = WorkerFactory::create($data);
  }

  /**
   * Get the worker object
   *
   * @return Flownode\Common\Data\WorkerInterface
   */
  public function getWorker()
  {
    return $this->worker;
  }
}