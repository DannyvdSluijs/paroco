<?php
/**
 * PaRoCo
 *
 * PHP Version 7
 *
 * @link      https://github.com/DannyvdSluijs/paroco
 * @copyright Copyright (c) 2016 Danny van der Sluijs
 * @license   MIT License
 */

namespace Core\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTimeImmutable;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity
 * @ORM\Table(name="addresses")
 * @ORM\HasLifecycleCallbacks
 */
class Address
{
    /**
     * The ORM primary key.
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * A universal unique identifier for external referencing
     * @var \Ramsey\Uuid\Uuid
     *
     * @ORM\Column(type="uuid")
     */
    private $uuid;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $addressLine;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $postalCode;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $country;

    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Address
     */
    public function setId(int $id) : Address
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return \Ramsey\Uuid\Uuid
     */
    public function getUuid() : Uuid
    {
        return $this->uuid;
    }

    /**
     * @param \Ramsey\Uuid\Uuid $uuid
     * @return Address
     */
    public function setUuid(Uuid $uuid) : Address
    {
        $this->uuid = $uuid;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddressLine(): string
    {
        return $this->addressLine;
    }

    /**
     * @param string $addressLine
     * @return Address
     */
    public function setAddressLine(string $addressLine): Address
    {
        $this->addressLine = $addressLine;
        return $this;
    }

    /**
     * @return string
     */
    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    /**
     * @param string $postalCode
     * @return Address
     */
    public function setPostalCode(string $postalCode): Address
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return Address
     */
    public function setCity(string $city): Address
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return Address
     */
    public function setCountry(string $country): Address
    {
        $this->country = $country;
        return $this;
    }

    /**
     * The pre persist life cycle event handler
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        $this->uuid = Uuid::uuid4();
    }
}

