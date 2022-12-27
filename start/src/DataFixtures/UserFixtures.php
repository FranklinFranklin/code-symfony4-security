<?php

namespace App\DataFixtures;

use App\Entity\ApiToken;
use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends BaseFixture
{


    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {

        $this->passwordEncoder = $passwordEncoder;
    }


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

//          encrypt password
//          $user is to know what encoder type to use and SET is to set it into the setPassword Entity
//          ... this is fetch from security.yaml
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                    'engage'
                ));

            return $user;
        });

            $this->createMany(3, 'admin_users', function($i) {
            $user = new User();
            $user->setEmail(sprintf('admin%d@thespacebar.com', $i));
            $user->setFirstName($this->faker->firstName);
            $user->setRoles(['ROLE_ADMIN']);
            //will setRoles will create an roll and set it on the user

            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'engage'
            ));

            return $user;
        });
        $manager->flush();
    }
}
