<?php

/**
 * Copyright © Ergonode Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Ergonode\Migration;

use Doctrine\DBAL\Schema\Schema;

final class Version20210506000000 extends AbstractErgonodeMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TYPE aggregate_type AS ENUM (\'aggregate\')');

        $this->addSql('
            CREATE TABLE event_store_type (
                aggregate_id uuid NOT NULL, 
                type aggregate_type NOT NULL,                 
                CONSTRAINT event_store_type_pkey PRIMARY KEY (aggregate_id)
            )
        ');
        $this->addSql('
            INSERT INTO event_store_type (aggregate_id, type) (SELECT aggregate_id, \'aggregate\' FROM event_store_class)
        ');
    }
}
