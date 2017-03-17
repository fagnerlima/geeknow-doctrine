<?php
namespace AppBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Event\PreFlushEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

class Client
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var Collection
     */
    private $accounts;

    /**
     * @var bool
     */
    private $status;

    /**
     * @var int
     */
    private $version;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return Collection
     */
    public function getAccounts(): Collection
    {
        return $this->accounts;
    }

    /**
     * @param Collection $accounts
     */
    public function setAccounts(Collection $accounts)
    {
        $this->accounts = $accounts;
    }

    /**
     * @return bool
     */
    public function isStatus(): bool
    {
        return $this->status;
    }

    /**
     * @param bool $status
     */
    public function setStatus(bool $status)
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

    public function onPostLoad()
    {
        dump('postLoad');
    }
    
    public function onPreRemove()
    {
        dump('onPreRemove');
    }
    
    public function onPostRemove()
    {
        dump('onPostRemove');
    }
    
    public function onPrePersist()
    {
        dump('onPrePersist');
        $this->status = $this->status ?? true;
        $this->version = 1;
    }

    public function onPostPersist()
    {
        dump('onPostPersist');
    }

    public function onPreUpdate(PreUpdateEventArgs $eventArgs)
    {
        dump('onPreUpdate', $eventArgs);
    }

    public function onPostUpdate()
    {
        dump('onPostUpdate');
    }

    public function onPreFlush(PreFlushEventArgs $eventArgs)
    {
        dump('onPreFlush', $eventArgs);
    }
}

