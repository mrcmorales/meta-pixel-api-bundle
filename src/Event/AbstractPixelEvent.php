<?php
declare(strict_types=1);

namespace MrcMorales\MetaPixelApiBundle\Event;

use FacebookAds\Object\ServerSide\Event;
use MrcMorales\MetaPixelApiBundle\Enum\ActionSource;
use FacebookAds\Object\ServerSide\CustomData;
use FacebookAds\Object\ServerSide\UserData;

abstract class AbstractPixelEvent implements EventInterface
{
    public function __construct(
        private readonly UserData $userData,
        private readonly string $url,
        private readonly ?CustomData $customData = null,
        private readonly ?string $eventId = null,
        private readonly ?string $actionSource = ActionSource::WEBSITE->value,
        private readonly ?string $pixelId = null,
        private readonly array $extra = [],
    ) {}

    public function getExtra(): array
    {
        return $this->extra;
    }

    public function getPixelId(): ?string
    {
        return $this->pixelId;
    }

    public function toEvent(): Event
    {
        return (new Event())
            ->setEventName(static::EVENT_NAME)
            ->setEventTime(time())
            ->setEventId($this->eventId ?? uniqid())
            ->setUserData($this->userData)
            ->setCustomData($this->customData)
            ->setEventSourceUrl($this->url)
            ->setActionSource($this->actionSource);
    }
}