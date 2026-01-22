<?php

namespace App\DataFixtures;

use App\Entity\Possession;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class PossessionFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(
        private UserRepository $userRepository
    ) {}

    public function load(ObjectManager $manager): void
    {
        $prince = $this->userRepository->findOneBy([
            'email' => 'prince@example.com'
        ]);

        $michael = $this->userRepository->findOneBy([
            'email' => 'michael@example.com'
        ]);

        if (!$prince || !$michael) {
            throw new \Exception('Users requis pour les possessions non trouvés');
        }

        $manager->persist(
            (new Possession())
                ->setNom('Guitare électrique Fender')
                ->setType('Instrument')
                ->setValeur(1800)
                ->setUser($prince)
        );

        $manager->persist(
            (new Possession())
                ->setNom('Piano de studio')
                ->setType('Instrument')
                ->setValeur(12000)
                ->setUser($prince)
        );

        $manager->persist(
            (new Possession())
                ->setNom('Studio d’enregistrement privé')
                ->setType('Immobilier')
                ->setValeur(250000)
                ->setUser($prince)
        );

        $manager->persist(
            (new Possession())
                ->setNom('Gant à paillettes')
                ->setType('Objet iconique')
                ->setValeur(650000)
                ->setUser($michael)
        );

        $manager->persist(
            (new Possession())
                ->setNom('Chapeau de scène')
                ->setType('Accessoire')
                ->setValeur(120000)
                ->setUser($michael)
        );

        $manager->persist(
            (new Possession())
                ->setNom('Ranch Neverland')
                ->setType('Immobilier')
                ->setValeur(100000000)
                ->setUser($michael)
        );

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}
