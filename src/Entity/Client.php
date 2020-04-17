<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Annotation\ApiSubresource;

/**
*  @ApiResource(
*  itemOperations={
*      "get"={
*      "access_control"="is_granted('ROLE_ADMIN')"
*     },
*      "put"={
*          "access_control"="is_granted('ROLE_ADMIN')"
*      },
*      "delete"={
*          "access_control"="is_granted('ROLE_ADMIN')"
*      }
*  },
*  collectionOperations={
*      "get"={
*      "access_control"="is_granted('ROLE_ADMIN')"
*       },
*      "post"={
*          "access_control"="is_granted('ROLE_ADMIN')"
*      },
*  },
*  normalizationContext={
*      "groups"={"read"}
*  }
* )
* @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
* @ORM\EntityListeners({"App\Doctrine\ClientListener"})
*/
class Client implements UserInterface
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, unique=true)
     * @Groups({"read"})
     * @Assert\NotBlank
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\NotBlank
     * @Groups({"read"})
     * @Assert\Email
     */
    private $email;

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     */
    private $password;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Customer", mappedBy="client_id", orphanRemoval=true, cascade={"persist", "remove", "merge"})
     * @ORM\JoinColumn(referencedColumnName="id", unique=true)
     * @ApiSubresource()
     */
    private $customers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Product", mappedBy="client_id", orphanRemoval=true, cascade={"persist", "remove", "merge"} )
     * @ORM\JoinColumn(referencedColumnName="id", unique=true )
     * @ApiSubresource()
     */
    private $products;

    public function __construct()
    {
        $this->customers = new ArrayCollection();
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles(): ?array
    {
      $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
      $roles[] = 'ROLE_USER';
       return array_unique($roles);
    }

    public function setRoles(array $Roles): self
    {
        $this->roles = $Roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection|Customer[]
     */
     public function getCustomers()
     {
       return $this->customers;
     }

    public function addCustomer(Customer $customer): self
    {
        if (!$this->customers->contains($customer)) {
            $this->customers[] = $customer;
            $customer->setClientId($this);
        }
        return $this;
    }

    public function removeCustomer(Customer $customer): self
    {
        if ($this->customers->contains($customer)) {
            $this->customers->removeElement($customer);
            // set the owning side to null (unless already changed)
            if ($customer->getClientId() === $this) {
                $customer->setClientId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
     public function getProducts()
     {
          return $this->products;
     }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setClientId($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);
            // set the owning side to null (unless already changed)
            if ($product->getClientId() === $this) {
                $product->setClientId(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
      return $this->username;
    }
}
