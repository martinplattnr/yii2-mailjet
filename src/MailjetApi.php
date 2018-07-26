<?php

namespace sweelix\mailjet;


use Mailjet\Client;
use yii\base\Component;
use yii\base\InvalidConfigException;

class MailjetApi extends Component
{
    /**
     * @var string
     */
    public $apiKey;

    /**
     * @var string
     */
    public $apiSecret;

    /**
     * @var boolean
     */
    public $enable = true;

    /**
     * @var string
     */
    public $apiVersion = 'v3';

    /**
     * @var string
     */
    public $apiUrl;

    /**
     * @var bool
     */
    public $secured = true;

    /**
     * @var $Client \Mailjet\Client
     */
    private $client;

    public function init()
    {
        parent::init();

        if ($this->apiKey === null) {
            throw new InvalidConfigException('API Key is missing');
        }
        if ($this->apiSecret === null) {
            throw new InvalidConfigException('API Secret is missing');
        }

        $settings = [
            'secured' => $this->secured,
            'version' => $this->apiVersion,
        ];

        if ($this->apiUrl !== null) {
            $settings['url'] = $this->apiUrl;
        }

        $this->client = new Client(
            $this->apiKey,
            $this->apiSecret,
            $this->enable,
            $settings);
    }

    /**
     * Trigger a POST request
     * @param array $resource Mailjet Resource/Action pair
     * @param array $args     Request arguments
     * @return \Mailjet\Response
     */
    public function post($resource, array $args = [], array $options = [])
    {
        return $this->client->post($resource, $args, $options);
    }

    /**
     * Trigger a GET request
     * @param array $resource Mailjet Resource/Action pair
     * @param array $args     Request arguments
     * @return \Mailjet\Response
     */
    public function get($resource, array $args = [], array $options = [])
    {
        return $this->client->get($resource, $args, $options);
    }

    /**
     * Trigger a PUT request
     * @param array $resource Mailjet Resource/Action pair
     * @param array $args     Request arguments
     * @return \Mailjet\Response
     */
    public function put($resource, array $args = [], array $options = [])
    {
        $this->client->put($resource, $args, $options);
    }

    /**
     * Trigger a DELETE request
     * @param array $resource Mailjet Resource/Action pair
     * @param array $args     Request arguments
     * @return \Mailjet\Response
     */
    public function delete($resource, array $args = [], array $options = [])
    {
        $this->client->delete($resource, $args, $options);
    }
}
