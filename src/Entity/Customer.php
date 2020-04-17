<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;


/**
*  @ApiResource(
*  itemOperations={
*      "get"={
*          "access_control"="is_granted('ROLE_ADMIN')"
*      },
*      "put"={
*          "access_control"="is_granted('ROLE_ADMIN')"
*      },
*      "delete"={
*          "access_control"="is_granted('ROLE_ADMIN')"
*      }
*  },
*  collectionOperations={
*      "get"={
*          "access_control"="is_granted('ROLE_ADMIN')"
*      },
*      "post"={
*          "access_control"="is_granted('ROLE_ADMIN')"
*      },
*  },
*  normalizationContext={
*      "groups"={"read"}
*  }
* )
 * @ORM\Entity(repositoryClass="App\Repository\CustomerRepository")
 * @ORM\EntityListeners({"App\Doctrine\CustomerListener"})
 */
class Customer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"read", "clients_customers_get_subresource"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $first_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $last_name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read"})
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read"})
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read"})
     */
    private $email;

    /**
     * @ORM\Column(type="integer")
     */
    private $phone_number;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\client", inversedBy="customers")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"read"})
     */
    private $client_id;

    public function getId(): ?int
    {
        return $this->id;
    }
    /**
    * @Groups({"read"})
    */
    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }
    /**
    * @Groups({"read"})
    */
    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
    /**
    * @Groups({"read"})
    */
    public function getPhoneNumber(): ?int
    {
        return $this->phone_number;
    }

    public function setPhoneNumber(int $phone_number): self
    {
        $this->phone_number = $phone_number;

        return $this;
    }

    public function getClientId(): ?client
    {
        return $this->client_id;
    }

    public function setClientId(?client $client_id): self
    {
        $this->client_id = $client_id;

        return $this;
    }
    public function __toString()
    {
      return $this->first_name;
    }
}
