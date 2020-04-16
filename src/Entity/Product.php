<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Symfony\Component\Serializer\Annotation\Groups;
/**
* When users are get by using api/clients/id/users don't show the client
* @ApiResource(
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
*      "api_clients_products_get_subresource"={
*          "normalization_context"={
*               "groups"={"clients_products_get_subresource"}
*          }
*      }
*  },
*  normalizationContext={
*      "groups"={"read"}
*  }
* )
* @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
* @ORM\EntityListeners({"App\Doctrine\ProductListener"})
*/
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"read", "clients_products_get_subresource"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read", "clients_products_get_subresource"})
     */
    private $brand;

    /**
     * @Groups({"read"})
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @Groups({"read"})
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @Groups({"read"})
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\client", inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"read"})
     */
    private $client_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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
}
