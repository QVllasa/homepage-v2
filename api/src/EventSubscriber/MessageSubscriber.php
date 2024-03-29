<?php


namespace App\EventSubscriber;


use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Message;
use Swift_Mailer;
use Swift_Message;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Twig\Environment;
use function Symfony\Component\String\s;



class MessageSubscriber implements EventSubscriberInterface
{
    private Swift_Mailer $mailer;
    private Environment $templating;

    public function __construct(Swift_Mailer $mailer, Environment $templating)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['sendMail', EventPriorities::POST_WRITE],
        ];
    }

    public function sendMail(ViewEvent $event): void
    {
        $message = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (!$message instanceof Message || Request::METHOD_POST !== $method) {
            return;
        }

        $subject = $message->getSubject();
        $content = $message->getContent();
        $from = $message->getSendFrom();

        $email = (new Swift_Message($subject))
            ->setFrom('example@example.com')
            ->setTo('example@example.com')
            ->setBody(
                $from.' <br> '.$subject.'<br>'.$content, 'text/html');

        $this->mailer->send($email);
    }



}
