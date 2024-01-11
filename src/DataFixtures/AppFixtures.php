<?php
declare(strict_types=1);
namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Article;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $encoder;
    public function __construct(UserPasswordHasherInterface $encoder){
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $fake = Factory::create();

        for ($i=0; $i < 10; $i++) { 
            $user = new User();

            $passHash = $this->encoder->hashPassword($user, 'password');

            $user->setEmail($fake->email)
                ->setPassword($passHash);
            
            $manager->persist($user);
            for($a = 0;$a < random_int(5,15); $a++){
                $article = (new Article())->setAuthor($user)
                    ->setContent($fake->text(300))
                    ->setName($fake->text(50));

                $manager->persist($article);
            }
            
        }
        $manager->flush();
    }
}
