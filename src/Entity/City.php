<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CityRepository")
 */
class City
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
    private $city_name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AddressBooks", mappedBy="city")
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

    public function getCityName(): ?string
    {
        return $this->city_name;
    }

    public function setCityName(string $city_name): self
    {
        $this->city_name = $city_name;

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
            $addressBook->setCity($this);
        }

        return $this;
    }

    public function removeAddressBook(AddressBooks $addressBook): self
    {
        if ($this->addressBooks->contains($addressBook)) {
            $this->addressBooks->removeElement($addressBook);
            // set the owning side to null (unless already changed)
            if ($addressBook->getCity() === $this) {
                $addressBook->setCity(null);
            }
        }

        return $this;
    }
}
