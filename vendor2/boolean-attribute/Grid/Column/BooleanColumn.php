<?php

/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Kreft\BooleanAttribute\Grid\Column;

use Ergonode\Grid\Column\AbstractColumn;

class BooleanColumn extends AbstractColumn
{
    public const TYPE = 'BOOLEAN_ATTRIBUTE';

    public function getType(): string
    {
        return self::TYPE;
    }
}
