<?php
namespace AppBundle\Entity;

class Account
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Client
     */
    private $client;

    /**
     * @var float
     */
    private $balance;

    /**
     * @var bool
     */
    private $status;

    /**
     * @var int
     */
    private $version;

    /**
     * Account constructor.
     */
    public function __construct()
    {
        $this->balance = 0;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * @param Client $client
     */
    public function setClient(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return float
     */
    public function getBalance(): float
    {
        return $this->balance;
    }

    /**
     * @param float $value
     */
    public function addBalance(float $value)
    {
        $this->balance += $value;
    }

    /**
     * @return bool
     */
    public function getStatus(): bool
    {
        return $this->status;
    }

    /**
     * @param bool $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getVersion(): int
    {
        return $this->version;
    }
}

