<?php

declare(strict_types=1);

namespace MrcMorales\MetaPixelApiBundle\Service;

use Exception;
use FacebookAds\Api;
use FacebookAds\Object\ServerSide\EventRequest;
use FacebookAds\Object\ServerSide\EventResponse;
use MrcMorales\MetaPixelApiBundle\Event\EventInterface;
use MrcMorales\MetaPixelApiBundle\Message\MetaPixelEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final class MetaPixelManager implements MetaPixelInterface
{
    public function __construct(string $accessToken, private readonly string $pixelId, private readonly ?MessageBusInterface $bus = null, private readonly ?LoggerInterface $logger = null,
    )
    {
        Api::init(null, null, $accessToken);
    }

    public function setAccessToken(string $accessToken): self
    {
        Api::init(null, null, $accessToken);

        return $this;
    }

    public function track(EventInterface $event): void
    {

        if ($this->bus) {
            $this->bus->dispatch(new MetaPixelEvent($event));

            return;
        }

        $this->execute($event);
    }
    
    public function execute(EventInterface $event): EventResponse
    {
        $facebookEvent = $event->toEvent();

        $pixelId = $event->getPixelId() ?: $this->pixelId;

        $this->logger?->info('Sending', [
            'meta_pixel_id' => $pixelId,
            'event_id' => $facebookEvent->getEventId(),
            'event_name' => $facebookEvent->getEventName(),
            'action_source' => $facebookEvent->getActionSource(),
            'event_source_url' => $facebookEvent->getEventSourceUrl(),
            'custom_data'=>$facebookEvent->getCustomData()?->normalize(),
        ]);



        $request = new EventRequest($pixelId)
            ->setEvents([$facebookEvent]);

        try {
            $result = $request->execute();

            $this->logger?->info('Sent', [
                'fb_Trace_id' => $result->getFbTraceId(),
                'events_received' => $result->getEventsReceived(),
                'messages' => $result->getMessages(),
            ]);

            return $result;
        } catch (Exception $e) {

            $this->logger?->error('Error', [
                'meta_pixel_id' => $pixelId,
                'event_id' => $facebookEvent->getEventId(),
                'event_name' => $facebookEvent->getEventName(),
                'action_source' => $facebookEvent->getActionSource(),
                'event_source_url' => $facebookEvent->getEventSourceUrl(),
                'custom_data'=> $facebookEvent->getCustomData()?->normalize(),
                'error_message' => $e->getMessage(),
            ]);

            throw new \RuntimeException('Error sending Meta Pixel API Event: ' . $e->getMessage(), 0, $e);
        }
    }
}
