<?php
namespace App\EventSubscriber;
use App\Entity\Product;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;

class AdminSubscriber implements  EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return[
            BeforeEntityPersistedEvent::class => ['setCreatedAt'],
            BeforeEntityUpdatedEvent::class => ['setUpdatedAt']
        ];
    }
    public  function setCreatedAt(BeforeEntityPersistedEvent $event)
    {
        $entityInstance = $event ->getEntityInstance();
        if(!$entityInstance instanceof Product) return;
        $entityInstance->setCreatedAt(new \DateTimeImmutable);
    }
    public  function setUpdatedAt(BeforeEntityUpdatedEvent $event)
    {
        $entityInstance = $event ->getEntityInstance();
        if(!$entityInstance instanceof Product) return;
        $entityInstance->setUpdateAt(new \DateTimeImmutable);
    }
}


?>