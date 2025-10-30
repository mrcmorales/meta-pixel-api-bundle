<?php

declare(strict_types=1);

namespace MrcMorales\MetaPixelApiBundle\Event;

use FacebookAds\Object\ServerSide\CustomData;
use FacebookAds\Object\ServerSide\Event;
use FacebookAds\Object\ServerSide\UserData;
use MrcMorales\MetaPixelApiBundle\Enum\ActionSource;

final class ViewContent extends AbstractPixelEvent
{
    public function __construct(
        private readonly UserData $userData,
        private readonly string $url,
        private readonly ?CustomData $customData = null,
        private readonly ?string $eventId = null,
        private readonly ?string $actionSource = null,
        array $extra = [],
    ) {
        parent::__construct($extra);
    }

    public function toEvent(): Event
    {
        return (new Event())
            ->setEventName('ViewContent')
            ->setEventTime(time())
            ->setEventId($this->eventId ?? uniqid())
            ->setUserData($this->userData)
            ->setCustomData($this->customData)
            ->setEventSourceUrl($this->url)
            ->setActionSource($this->actionSource ?? ActionSource::WEBSITE->value);
    }
}