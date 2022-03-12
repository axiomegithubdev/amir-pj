<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;



/**
 * Ici nous allons créer un script permettant d'inscrire des utilisateurs en BDD depuis la console
 * Grâce à cette commande, un administrateur pourra enregistrer des utilisateurs qui auron accès au backoffice
 * En effet, s'il n'y a aucun utilisateur enregistré, le backoffice ne sera jamais accessible
 */
class UserCreateCommand extends Command
{
    protected static $defaultName = 'user:create';
    protected static $defaultDescription = 'Permet de créer un nouvel utilisateur';

    private EntityManagerInterface $manager;

    private UserPasswordHasherInterface $hasher;


    /**
     * Dans le constructeur
     */
    public function __construct( EntityManagerInterface $manager, UserPasswordHasherInterface $hasher )
    {
        $this->manager = $manager;
        $this->hasher = $hasher;
        parent::__construct();
    }

    // Obligatoire! => cette classe étend de Command qui implémente une interface 
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
    

        // On crée 10 utilisateurs
        for( $i = 0; $i<10 ; $i++){
            $user = new User();
            $user->setEmail("admin_{$i}@admin.fr");

            // On hash son mot de passe
            $password = $this->hasher->hashPassword( $user, "admin_{$i}" );
            $user->setPassword($password);

            $this->manager->persist($user);
        }
    
    
        // On demande à doctrine de stocker l'entité en base
        $this->manager->flush();

        $io->success("Utilisateurs créés!");
        return Command::SUCCESS;
    }
}
