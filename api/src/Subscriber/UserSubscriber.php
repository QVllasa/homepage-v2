<?php


namespace App\Subscriber;


use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserSubscriber implements EventSubscriberInterface
{
    private UserPasswordEncoderInterface $encoder;

    public static function getSubscribedEvents()
    {
       return [
           BeforeEntityPersistedEvent::class => ['setPassword']
       ];
    }

    public function setPassword(BeforeEntityPersistedEvent $event){
        $entity  = $event->getEntityInstance();
        if ($entity instanceof User){
            $entity->setPassword($this->encoder->encodePassword($entity, $entity->getPassword()));
        }
    }

    /**
     * @required
     */
    public function setEncoder(UserPasswordEncoderInterface $encoder): void
    {
        $this->encoder = $encoder;
    }
}
