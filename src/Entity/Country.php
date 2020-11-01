<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CountryRepository")
 */
class Country
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $country_name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AddressBooks", mappedBy="country")
     */
    private $addressBooks;

    public function __construct()
    {
        $this->addressBooks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCountryName(): ?string
    {
        return $this->country_name;
    }

    public function setCountryName(string $country_name): self
    {
        $this->country_name = $country_name;

        return $this;
    }

    /**
     * @return Collection|AddressBooks[]
     */
    public function getAddressBooks(): Collection
    {
        return $this->addressBooks;
    }

    public function addAddressBook(AddressBooks $addressBook): self
    {
        if (!$this->addressBooks->contains($addressBook)) {
            $this->addressBooks[] = $addressBook;
            $addressBook->setCountry($this);
        }

        return $this;
    }

    public function removeAddressBook(AddressBooks $addressBook): self
    {
        if ($this->addressBooks->contains($addressBook)) {
            $this->addressBooks->removeElement($addressBook);
            // set the owning side to null (unless already changed)
            if ($addressBook->getCountry() === $this) {
                $addressBook->setCountry(null);
            }
        }

        return $this;
    }
}
