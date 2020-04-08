<?php
namespace App\Doctrine;
use App\Entity\Product;
use Symfony\Component\Security\Core\Security;

class ProductListener
{
  private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function prePersist(Product $product)
    {
      if ($product->getClientId()) {
           return;
       }
       if ($this->security->getUser()) {
          $product->setClientId($this->security->getUser());
      }

     }
}
