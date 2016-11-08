<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AddressRepository")
 * @ORM\Table(name="address")
 */
class Address
{

    /**
     * @var Contact Address contact
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Contact", inversedBy="adresses")
     */
    private $contact;

    /**
     * @var string Address street
     *
     * @ORM\Column(type="string", length=20)
     * @Assert\Length(max="20")
     * @Assert\NotNull()
     */
    private $street;

    /**
     * @var int Address number
     *
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Length(min="1")
     */
    private $number;

    /**
     * @var string Address line two
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $line2;

    /**
     * @var string Address postal code
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Assert\NotNull()
     */
    private $postalCode;

    /**
     * @var string Address country
     *
     * @ORM\Column(type="string", length=2)
     * @Assert\Country()
     * @Assert\NotBlank()
     * @Assert\NotNull()
     */
    private $country;

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Return address contact.
     *
     * @return Contact Address contact
     */
    public function getContact(): Contact
    {
        return $this->contact;
    }

    /**
     * Return address street.
     *
     * @return string Address street
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * Define address street.
     *
     * @param string $street Address street
     *
     * @return Address
     */
    public function setStreet(string $street): Address
    {
        $this->street = $street;
        return $this;
    }

    /**
     * Return address number.
     *
     * @return int Address number
     */
    public function getNumber(): int
    {
        return $this->number;
    }

    /**
     * Define address number.
     *
     * @param int $number Address number
     *
     * @return Address
     */
    public function setNumber(int $number): Address
    {
        $this->number = $number;
        return $this;
    }

    /**
     * Return address line two.
     *
     * @return string Address line two
     */
    public function getLine2(): string
    {
        return $this->line2;
    }

    /**
     * Define address line two.
     *
     * @param string $line2 Address line two
     *
     * @return Address
     */
    public function setLine2(string $line2): Address
    {
        $this->line2 = $line2;
        return $this;
    }

    /**
     * Return address postal code.
     *
     * @return string Address postal code
     */
    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    /**
     * Define address postal code.
     *
     * @param string $postalCode Address postal code
     *
     * @return Address
     */
    public function setPostalCode(string $postalCode): Address
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    /**
     * Return address country.
     *
     * @return string Address country
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * Define address country.
     *
     * @param string $country Address country
     *
     * @return Address
     */
    public function setCountry(string $country): Address
    {
        $this->country = $country;
        return $this;
    }

}
