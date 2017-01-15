<?php

namespace Core\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTimeImmutable;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity
 * @ORM\Table(name="persons")
 * @ORM\HasLifecycleCallbacks
 */
class Person
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
    private $givenName;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $familyName;

    /**
     * @var \DateTimeImmutable
     *
     * @ORM\Column(type="date_immutable")
     */
    private $dateOfBirth;

    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Person
     */
    public function setId(int $id) : Person
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
     * @return Person
     */
    public function setUuid(Uuid $uuid) : Person
    {
        $this->uuid = $uuid;
        return $this;
    }

    /**
     * @return string
     */
    public function getGivenName() : string
    {
        return $this->givenName;
    }

    /**
     * @param string $givenName
     * @return Person
     */
    public function setGivenName(string $givenName) : Person
    {
        $this->givenName = $givenName;
        return $this;
    }

    /**
     * @return string
     */
    public function getFamilyName() : string
    {
        return $this->familyName;
    }

    /**
     * @param string $familyName
     * @return Person
     */
    public function setFamilyName(string $familyName) : Person
    {
        $this->familyName = $familyName;
        return $this;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getDateOfBirth() : DateTimeImmutable
    {
        return $this->dateOfBirth;
    }

    /**
     * @param \DateTimeImmutable $dateOfBirth
     * @return Person
     */
    public function setDateOfBirth(DateTimeImmutable $dateOfBirth) : Person
    {
        $this->dateOfBirth = $dateOfBirth;
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

