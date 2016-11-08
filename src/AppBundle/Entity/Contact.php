<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Mero\Bundle\BaseBundle\Entity\Field\IdTrait;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ContactRepository")
 * @ORM\Table(name="contact")
 */
class Contact
{

    use IdTrait;

    /**
     * @var string Contact first name
     *
     * @ORM\Column(type="string", length=20)
     * @Assert\Length(max="20")
     * @Assert\NotNull()
     */
    private $firstName;

    /**
     * @var string Contact last name
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $lastName;

    /**
     * @var int Contact age
     *
     * @ORM\Column(type="integer")
     * @Assert\Range(min="18", max="99")
     */
    private $age;

    /**
     * @var Collection List of contact address
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Address", mappedBy="contact")
     */
    private $adresses;

    public function __construct()
    {
        $this->adresses = new ArrayCollection();
    }

    /**
     * Return contact first name.
     *
     * @return string Contact first name
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * Define contact first name.
     *
     * @param string $firstName Contact first name
     *
     * @return Contact
     */
    public function setFirstName(string $firstName): Contact
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * Return contact last name.
     *
     * @return string Contact last name
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * Define contact last name.
     *
     * @param string $lastName Contact last name
     *
     * @return Contact
     */
    public function setLastName(string $lastName = null): Contact
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * Return contact age.
     *
     * @return int Contact age
     */
    public function getAge(): int
    {
        return $this->age;
    }

    /**
     * Define contact age.
     *
     * @param int $age Contact age
     *
     * @return Contact
     */
    public function setAge(int $age): Contact
    {
        $this->age = $age;
        return $this;
    }

    /**
     * Return a list of contact address.
     *
     * @return Collection List of contact address
     */
    public function getAdresses(): Collection
    {
        return $this->adresses;
    }

    /**
     * Define a list of contact address.
     *
     * @param Collection $adresses List of contact address
     *
     * @return Contact
     */
    public function setAdresses(Collection $adresses): Contact
    {
        $this->adresses = $adresses;
        return $this;
    }

}
