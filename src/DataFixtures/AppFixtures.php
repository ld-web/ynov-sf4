<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
  private $passwordEncoder;

  public function __construct(UserPasswordEncoderInterface $userPasswordEncoderInterface)
  {
    $this->passwordEncoder = $userPasswordEncoderInterface;
  }

  public function load(ObjectManager $manager)
  {
    $faker = Factory::create();

    for ($i = 0; $i < 100; $i++) {
      $product = new Product();

      $product->setName($faker->sentence(3, true))
        ->setDescription($faker->paragraph(5))
        ->setPriceHT($faker->randomFloat(2, 5, 300))
        ->setStock($faker->numberBetween(0, 250))
        ->setPromo($faker->boolean(20))
        ->setPicture('https://source.unsplash.com/random/200x200');

      $manager->persist($product);
    }

    $user = new User();
    $user->setEmail('bob@bob.com')
      ->setRoles(['ROLE_ADMIN'])
      ->setPassword($this->passwordEncoder->encodePassword(
        $user,
        'bobby12345'
      ));

    $manager->persist($user);

    $manager->flush();
  }
}
