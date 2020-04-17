<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use App\Entity\Client;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {

        // === Clients ===
        $client = new Client();
        $client->setUserName('Orange')
        ->setEmail('Orange@Orange.or')
        ->setRoles(["ROLE_ADMIN"])
        ->setPassword('test')
        ;
        $this->addReference('Orange', $client);
        $manager->persist($client);

        // === Clients ===
        $client = new Client();
        $client->setUserName('SFR')
        ->setEmail('SFR@SFR.SFR')
        ->setRoles(["ROLE_ADMIN"])
        ->setPassword('test')
        ;
        $this->addReference('SFR', $client);
        $manager->persist($client);

        // === Users ===
        // 10 users from Orange
        for($i=1; $i<=5; $i++)
        {
          $Customer = new Customer();
          $client = $this->getReference('Orange');
          $Customer->setFirstName('nickname'.$i.$client->getUserName())
              ->setLastName('family'.$i)
              ->setEmail('mail'.$i)
              ->setCity('city'.$i)
              ->setAddress('56 street down'.$i)
              ->setPhoneNumber('1245789'.$i)
              ->setClientId($client)
          ;
          $manager->persist($Customer);
        }

        // 10 users from SFR
        for($i=1; $i<=10; $i++)
        {
            $Customer = new Customer();
            $client = $this->getReference('SFR');
            $Customer->setFirstName('nickname'.$i.$client->getUserName())
                ->setLastName('family'.$i)
                ->setEmail('mail'.$i)
                ->setCity('city'.$i)
                ->setAddress('56 street down'.$i)
                ->setPhoneNumber('1245789'.$i)
                ->setClientId($client)
            ;
            $manager->persist($Customer);
        }

        // === Products ===
        $product = new Product();
        $client = $this->getReference('SFR');
        $product->setName('Galaxy Note 9')
                ->setBrand('Samsung')
                ->setPrice(599.99)
                ->setClientId($client)
                ->setDescription('Le Samsung Galaxy Note 9 est le dernier-né de la gamme Note du géant coréen. C’est, aujourd’hui, l’une des solutions les plus complètes et les plus abouties sous Android.')
        ;
        $manager->persist($product);

        $product = new Product();
        $client = $this->getReference('SFR');
        $product->setName('Pixel 3')
                ->setBrand('Google')
                ->setPrice(699.99)
                ->setClientId($client)
                ->setDescription('Vous ne jurez que par Android Stock ? Ne cherchez pas plus loin, c’est le Google Pixel 3 qu’il vous faut. Ce smartphone associe à la perfection la partie matérielle avec la partie logicielle. Premièrement, il possède un design assez unique avec un dos en verre dépoli garantissant une meilleure tenue du smartphone. C’est sobre et ça fonctionne très bien. Il n’est pas très grand avec son écran OLED de 5,5 pouces et ravira les personnes à la recherche d’un appareil un peu passe-partout.')
        ;
        $manager->persist($product);

        $product = new Product();
        $client = $this->getReference('Orange');
        $product->setName('P20 Pro')
                ->setBrand('Huawei')
                ->setPrice(449.99)
                ->setClientId($client)
                ->setDescription('Le Huawei P20 Pro est un très beau smartphone. Lorsqu’on le retourne, on découvre un dos en verre du plus bel effet pouvant servir occasionnellement de miroir au besoin (oui, oui). L’écran OLED de 6,1 pouces est très équilibré et possède une grande luminosité ainsi que des noirs très profonds. Un vrai plaisir à regarder au quotidien.')
        ;
        $manager->persist($product);
  $manager->flush();
      }

}
