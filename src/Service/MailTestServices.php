<?php
namespace App\Service;

use App\Entity\Produit;
use Twig\Environment;

class MailTestServices{
    private $mailer;
    private $render;

    public function __construct( \Swift_Mailer $mailer, Environment $render){
        $this->mailer = $mailer;
        $this->render = $render;
    }

    public function sendProduit(Produit $produit){
        $message = (new \Swift_Message('Mail Automatique'))
            ->setFrom('paul.godard@viacesi.fr')
            ->setTo('paul.godard@viacesi.fr')
            ->setReplyTo('paul.godard@viacesi.fr')
            ->setBody($this->render->render('mail.html.twig',[
                'produit' => $produit
            ]));
        $this->mailer->send($message);
    }

    public function contactUs(string $content, string $produit) {
        $message = (new \Swift_Message('Mail Automatique'))
            ->setFrom('paul.godard@viacesi.fr')
            ->setTo('mollet.simon.pro@gmail.com')
            ->setReplyTo('paul.godard@viacesi.fr')
            ->setBody($this->render->render('mail.html.twig',[
                'content' => $content,
                'produit' => $produit
            ]));
        $this->mailer->send($message);
    }
}