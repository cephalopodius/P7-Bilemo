<?php
namespace App\Doctrine;

use App\Entity\Client;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Persistence\Event\LifecycleEventArgs;


class ClientListener
{
  private $passwordEncoder;

  public function __construct(UserPasswordEncoderInterface $passwordEncoder)
  {
      $this->passwordEncoder = $passwordEncoder;
  }
  #can make probleme after fixture. maybe delete just for the fixture loading
    public function prePersist(Client $client)
    {
      $clearPassword = $client->getPassword();
      $encodedPassword = $this->passwordEncoder->encodePassword($client, $clearPassword);

      $client->setPassword($encodedPassword);

     }



}
