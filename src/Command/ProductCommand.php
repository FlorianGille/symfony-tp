<?php
namespace App\Command;

use App\Controller\ProduitController;
use App\Service\MailTestServices;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProductCommand extends Command
{
    private $mailService;
    private $prodCtrl;

    public function __construct(MailTestServices $mailService, ProduitController $produitController)
    {
        $this->mailService = $mailService;
        $this->prodCtrl = $produitController;

        parent::__construct();
    }

    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:low-stock';

    protected function configure()
    {
        $this
            // the short description shown while running "php bin/console list"
            ->setDescription('Send mail')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('Envoi un mail lorsque le stock du produit est inférieur à 10')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("Calcul des stocks en cours..");
        $this->prodCtrl->lowStock($this->mailService);

        return 0;
    }
}