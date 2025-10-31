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
    private string $pixelId;
    private string $accessToken;

    public function __construct(string $pixelId, string $accessToken, private readonly ?MessageBusInterface $bus = null, private readonly ?LoggerInterface $logger = null,
    )
    {
        $this->pixelId = $pixelId;
        $this->accessToken = $accessToken;

        Api::init(null, null, $this->accessToken);
    }

    public function getPixelId(): string
    {
        return $this->pixelId;
    }

    public function setCredentials(string $pixelId, ?string $accessToken = null): self
    {
        $this->pixelId = $pixelId;
        $this->accessToken = $accessToken ?: $this->accessToken;
        Api::init(null, null, $this->accessToken);

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

        $this->logger?->info('Sending', [
            'event_id' => $facebookEvent->getEventId(),
            'event_name' => $facebookEvent->getEventName(),
            'action_source' => $facebookEvent->getActionSource(),
            'event_source_url' => $facebookEvent->getEventSourceUrl(),
            'custom_data'=>$facebookEvent->getCustomData()?->normalize(),
        ]);


        $request = (new EventRequest($this->pixelId))
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
                'event_id' => $facebookEvent->getEventId(),
                'event_name' => $facebookEvent->getEventName(),
                'action_source' => $facebookEvent->getActionSource(),
                'event_source_url' => $facebookEvent->getEventSourceUrl(),
                'custom_data'=>$facebookEvent->getCustomData()->normalize(),
                'error_message' => $e->getMessage(),
            ]);

            throw new \RuntimeException('Error sending Meta Pixel API Event: ' . $e->getMessage(), 0, $e);
        }
    }
}
