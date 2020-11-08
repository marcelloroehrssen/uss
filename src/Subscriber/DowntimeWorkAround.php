<?php

namespace App\Subscriber;

use App\Controller\Admin\DowntimeCrudController;
use App\Entity\Downtime;
use App\Entity\InventoryEntry;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\AfterCrudActionEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\AfterEntityUpdatedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeCrudActionEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class DowntimeWorkAround implements EventSubscriberInterface
{
    /** @var EntityManagerInterface */
    private EntityManagerInterface $entityManager;

    /**
     * DowntimeWorkAround constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeCrudActionEvent::class => ['clearList'],
            AfterEntityUpdatedEvent::class => ['fixList']
        ];
    }

    public function clearList(BeforeCrudActionEvent $event)
    {
        [$controller, $action] = $event->getAdminContext()->getRequest()->attributes->get('_controller');

        if ($event->getAdminContext()->getRequest()->isMethod('POST')
                && $controller instanceof DowntimeCrudController
                && $action === 'edit') {
            $instance = $event->getAdminContext()->getEntity()->getInstance();

            foreach ($instance->getRelatedItems() as $item) {
                $item->setDowntime(null);
            }
            $this->entityManager->flush();
        }
    }

    public function fixList(AfterEntityUpdatedEvent $event)
    {
        $instance = $event->getEntityInstance();
        if ($instance instanceof Downtime) {
            foreach ($instance->getRelatedItems() as $item) {
                $item->setDowntime($instance);
            }
            $this->entityManager->flush();
        }
    }
}