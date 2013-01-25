<?php
namespace Flownode\Common\Data\Worker;
/**
 *
 * @author Laurent CALLAREC <lcallarec@qualea.fr>
 */
interface WorkerInterface
{
    public function getValueFromPath($path, $data, $seperator = '.', $prefix = '');
}