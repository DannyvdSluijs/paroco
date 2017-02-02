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

use DateTimeImmutable;
use \Ramsey\Uuid\Uuid;
use Doctrine\ORM\Mapping as ORM;
use Core\ValueObjects\PaperRouteComplaint\Product;
use Core\ValueObjects\PaperRouteComplaint\ComplaintType;
use Core\ValueObjects\PaperRouteComplaint\Severity;
use Core\ValueObjects\Map\Address;

/**
 * @ORM\Entity
 * @ORM\Table(name="complaints")
 */
class Complaint
{
    /**
     * The ORM primary key.
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * A universal unique identifier for external referencing
     * @var Uuid
     *
     * @ORM\Column(type="uuid")
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private $uuid;

    /**
     * @var DateTimeImmutable
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @var DateTimeImmutable
     * @ORM\Column(type="datetime")
     */
    private $registration;

    /**
     * @var Product
     * @ORM\Column(type="product")
     */
    private $product;

    /**
     * @var Severity
     * @ORM\Column(type="severity")
     */
    private $severity;

    /**
     * @var boolean
     * @ORM\Column(type="boolean")
     */
    private $processed;

    /**
     * @var boolean
     * @ORM\Column(type="boolean")
     */
    private $redelivery;

    /**
     * @var ComplaintType
     * @ORM\Column(type="complaint-type")
     */
    private $type;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $key;

    /**
     * @var Address
     * @ORM\OneToOne(targetEntity="Core\Entity\Address")
     */
    private $address;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $remark;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Complaint
     */
    public function setId(int $id): Complaint
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return \Ramsey\Uuid\Uuid
     */
    public function getUuid(): \Ramsey\Uuid\Uuid
    {
        return $this->uuid;
    }

    /**
     * @param \Ramsey\Uuid\Uuid $uuid
     * @return Complaint
     */
    public function setUuid(\Ramsey\Uuid\Uuid $uuid): Complaint
    {
        $this->uuid = $uuid;
        return $this;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getDate(): DateTimeImmutable
    {
        return $this->date;
    }

    /**
     * @param DateTimeImmutable $date
     * @return Complaint
     */
    public function setDate(DateTimeImmutable $date): Complaint
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getRegistration(): DateTimeImmutable
    {
        return $this->registration;
    }

    /**
     * @param DateTimeImmutable $registration
     * @return Complaint
     */
    public function setRegistration(DateTimeImmutable $registration): Complaint
    {
        $this->registration = $registration;
        return $this;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @param Product $product
     * @return Complaint
     */
    public function setProduct(Product $product): Complaint
    {
        $this->product = $product;
        return $this;
    }

    /**
     * @return Severity
     */
    public function getSeverity(): Severity
    {
        return $this->severity;
    }

    /**
     * @param Severity $severity
     * @return Complaint
     */
    public function setSeverity(Severity $severity): Complaint
    {
        $this->severity = $severity;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isProcessedIndicator(): bool
    {
        return $this->processedIndicator;
    }

    /**
     * @param boolean $processedIndicator
     * @return Complaint
     */
    public function setProcessedIndicator(bool $processedIndicator): Complaint
    {
        $this->processedIndicator = $processedIndicator;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isRedeliverRequiredIndicator(): bool
    {
        return $this->redeliverRequiredIndicator;
    }

    /**
     * @param boolean $redeliverRequiredIndicator
     * @return Complaint
     */
    public function setRedeliverRequiredIndicator(bool $redeliverRequiredIndicator): Complaint
    {
        $this->redeliverRequiredIndicator = $redeliverRequiredIndicator;
        return $this;
    }

    /**
     * @return ComplaintType
     */
    public function getType(): ComplaintType
    {
        return $this->type;
    }

    /**
     * @param ComplaintType $type
     * @return Complaint
     */
    public function setType(ComplaintType $type): Complaint
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @param string $key
     * @return Complaint
     */
    public function setKey(string $key): Complaint
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @return Address
     */
    public function getAddress(): Address
    {
        return $this->address;
    }

    /**
     * @param Address $address
     * @return Complaint
     */
    public function setAddress(Address $address): Complaint
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string
     */
    public function getRemark(): string
    {
        return $this->remark;
    }

    /**
     * @param string $remark
     * @return Complaint
     */
    public function setRemark(string $remark): Complaint
    {
        $this->remark = $remark;
        return $this;
    }
}