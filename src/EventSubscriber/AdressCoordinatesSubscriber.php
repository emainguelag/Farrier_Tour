<?php

namespace App\EventSubscriber;

use App\Entity\Adress;
use App\Service\Coordinates;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs as EventLifecycleEventArgs;

class AdressCoordinatesSubscriber implements EventSubscriber
{
  private $coordinatesService;

  public function __construct(Coordinates $coordinatesService)
  {
    $this->$coordinatesService = $coordinatesService;
  }

  public function getSubscribedEvents()
  {
    return [
      Events::prePersist,
      Events::preUpdate
    ];
  }

  public function preUpdate(EventLifecycleEventArgs $args)
  {
    $entity = $args->getObject();

    if ($entity instanceof Adress) {
      $this->processCoordinates($entity);
    }
  }

  public function prePersist(EventLifecycleEventArgs $args)
  {
    $entity = $args->getObject();

    if ($entity instanceof Adress) {
      $this->processCoordinates($entity);
    }
  }

  public function processCoordinates(Adress $adress)
  {
    $location = $adress->getCity() . ', ' . $adress->getCountry();

    $coordinates = $coordinatesService->geocode($location);

    if ($coordinates !== null) {
        $adress->setLatitude($coordinates['lat']);
        $adress->setLongitude($coordinates['lon']);
    }
  }
}