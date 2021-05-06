<?php

/**
 * Copyright © Ergonode Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Ergonode\Migration;

use Doctrine\DBAL\Schema\Schema;

final class Version20210506000001 extends AbstractErgonodeMigration
{
    public function isTransactional(): bool
    {
        return false;
    }

    public function up(Schema $schema): void
    {
//        $this->addSql('ROLLBACK');
        $this->addSql('ALTER TYPE aggregate_type ADD VALUE IF NOT EXISTS \'role\'');
//        $this->addSql('START TRANSACTION');
        $this->addSql('
            UPDATE event_store_type est
                SET type=\'role\'
                FROM (SELECT esc.aggregate_id FROM event_store_class esc WHERE class=\'Ergonode\\Account\\Domain\\Entity\\Role\') sq
                WHERE est.aggregate_id IN (sq.aggregate_id)
        ');
    }
}
