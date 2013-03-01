<?php
namespace Flownode\Switchboard;

use Flownode\Switchboard\Channels;
use Flownode\Switchboard\Channel;

/**
 * Response sent (back) to the client
 *
 */
class Response
{
    /**
     * Collection of channels to sendback to the client
     *
     * @var Flownode\SwitchBoard\Channels
     */
	protected $channels;

    /**
     * Main channels namespace
     *
     * @var string
     */
    protected $namespace;

    /**
     *
     * @param string $namepsace
     */
    public function __construct($namespace = 'switchboard')
	{
        $this->namespace  = $namespace;
        $this->channels   = new Channels();

        $this->channels->setNamespace($namespace);
	}

    /**
     * Add a channel to the response
     *
     * @param $name
     * @param $data
     * @return Flownode\SwitchBoard\Response
     */
    public function add($name, array $data = array())
    {
        $channel = new Channel($name, $data);
        $this->channels->set($name, $channel);

        return $this;
    }

    /**
     * Get the JSON representation of this response
     *
     * @param array    $response
     * @return string
     */
    public function flush($jsonOption = 0)
    {
        $this->sendHttpHeaders();

        return $this->channels->toJSON($jsonOption);
    }

    /**
     * Set HTTP header content-type
     *
     * @return void
     */
    public function sendHttpHeaders()
    {
        header('Content-type: application/json');
    }

}
