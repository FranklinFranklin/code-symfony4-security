<?php

namespace App\DataFixtures;

use App\Entity\ApiToken;
use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends BaseFixture
{
    protected function loadData(ObjectManager $manager)
    {
//          create many users | the function will be called 10 times |
//          create/persist 5 Posts with random data from getDefaults()
            $this->createMany(10, 'main_users', function($i) {
//            create user put some data init and return
            $user = new User();
//            with all different spacer @mail accounts
            $user->setEmail(sprintf('spacebar%d@example.com', $i));

//            set fake firstnames
            $user->setFirstName($this->faker->firstName);

            return $user;
        });
        $manager->flush();
    }
}
