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
            ->setFrom('qendrimvllasa.homepage@gmail.com')
            ->setTo('qendrim.vllasa@gmail.com')
            ->setBody(
                $this->templating->render(
                    'emails/registration.html.twig',
                    [
                        'from' => $from,
                        'subject' => $subject,
                        'content' => $content
                    ]
                ),
                'text/html'
            );

        $this->mailer->send($email);
    }

}
