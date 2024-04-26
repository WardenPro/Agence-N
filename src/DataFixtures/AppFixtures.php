<?php
namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    // ...
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('admin@admin.com');
        $user->setRoles(['ROLE_ADMIN']); // Assurez-vous d'utiliser le bon rôle
        $user->setNom('admin');
        $user->setPrenom('Administrateur');
        $encodedPassword = $this->hasher->hashPassword($user, 'admin123');
        $user->setPassword($encodedPassword);
 
        $manager->persist($user);
        $manager->flush();
    }
}