<?php

/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Kreft\BooleanAttribute\Entity;

use Ergonode\Attribute\Domain\Entity\AbstractAttribute;
use JMS\Serializer\Annotation as JMS;

class BooleanAttribute extends AbstractAttribute
{
    public const TYPE = 'BOOLEAN';

    /**
     * @JMS\VirtualProperty();
     * @JMS\SerializedName("type")
     */
    public function getType(): string
    {
        return self::TYPE;
    }
}
