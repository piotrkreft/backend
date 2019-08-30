<?php

/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types = 1);

namespace Ergonode\Workflow\Persistence\Dbal\Projector;

use Doctrine\DBAL\Connection;
use Ergonode\Core\Domain\Entity\AbstractId;
use Ergonode\EventSourcing\Infrastructure\DomainEventInterface;
use Ergonode\EventSourcing\Infrastructure\Exception\ProjectorException;
use Ergonode\EventSourcing\Infrastructure\Exception\UnsupportedEventException;
use Ergonode\EventSourcing\Infrastructure\Projector\DomainEventProjectorInterface;
use Ergonode\Workflow\Domain\Event\Status\StatusRemovedEvent;

/**
 */
class StatusRemovedEventProjector implements DomainEventProjectorInterface
{
    private const TABLE = 'status';

    /**
     * @var Connection
     */
    private $connection;

    /**
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param DomainEventInterface $event
     *
     * @return bool
     */
    public function support(DomainEventInterface $event): bool
    {
        return $event instanceof StatusRemovedEvent;
    }

    /**
     * @param AbstractId           $aggregateId
     * @param DomainEventInterface $event
     *
     * @throws ProjectorException
     * @throws UnsupportedEventException
     */
    public function projection(AbstractId $aggregateId, DomainEventInterface $event): void
    {
        if (!$event instanceof StatusRemovedEvent) {
            throw new UnsupportedEventException($event, StatusRemovedEvent::class);
        }

        $this->connection->beginTransaction();
        try {
            $this->connection->delete(
                self::TABLE,
                [
                    'id' => $aggregateId->getValue(),
                ]
            );

            $this->connection->commit();
        } catch (\Throwable $exception) {
            throw new ProjectorException($event, $exception);
        }
    }
}
