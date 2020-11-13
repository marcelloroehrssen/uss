<?php

namespace App\Subscriber;

use App\Entity\Downtime;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Security;

class DowntimeCompleter implements EventSubscriberInterface
{
    private Security $security;

    /**
     * DowntimeCompleter constructor.
     * @param Security $security
     */
    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityUpdatedEvent::class => ['setData']
        ];
    }

    public function setData(BeforeEntityUpdatedEvent $event)
    {
        $instance = $event->getEntityInstance();
        if ($instance instanceof Downtime) {
            if (null === $instance->getResolutionTime()) {
                $instance->setStoryTeller($this->security->getUser())
                    ->setResolutionTime(new \DateTime());
            }
        }
    }
}