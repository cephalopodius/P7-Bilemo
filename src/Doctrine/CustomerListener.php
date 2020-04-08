<?php
namespace App\Doctrine;
use App\Entity\Customer;
use Symfony\Component\Security\Core\Security;

class CustomerListener
{
  private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function prePersist(Customer $customer)
    {
      if ($customer->getClientId()) {
           return;
       }
       if ($this->security->getUser()) {
          $customer->setClientId($this->security->getUser());
      }

     }
}
