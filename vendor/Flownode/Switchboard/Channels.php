<?php
namespace Flownode\Switchboard;

use Flownode\Common\Data\Collection;

/**
 *  Channel collection
 */
class Channels extends Collection
{
    /**
     * Channel namespace
     *
     * @var string
     */
    protected $namespace = 'switchboad';


    /**
     * JSON representation of all channels
     *
     * @param int json_encode option
     * @return string
     */
    public function toJSON($jsonOption = 0)
    {
        $array = array();
        foreach($this->getData() as $channel => $data)
        {
            $array[$this->namespace] = $data->toArray();
        }

        return json_encode($array, $jsonOption);

    }

    /**
     * Define channels main namepsace
     *
     * @param string $namespace
     * @return Flownode\SwitchBoard\Channels
     */
    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;

        return $this;
    }
}
