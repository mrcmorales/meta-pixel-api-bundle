<?php

declare(strict_types=1);

namespace MrcMorales\MetaPixelApiBundle\MessageHandler;

use MrcMorales\MetaPixelApiBundle\Message\MetaPixelEvent;
use MrcMorales\MetaPixelApiBundle\Service\MetaPixelManager;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class MetaPixelEventHandler
{
    public function __construct(private readonly MetaPixelManager $manager) {}

    public function __invoke(MetaPixelEvent $message): void
    {
        var_dump('entra 123');
      $result =   $this->manager->execute($message->event);

      var_dump($result->getEventsReceived());
    }
}
