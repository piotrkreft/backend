<?php

/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Kreft\BooleanAttribute\Provider\Strategy;

use Ergonode\Attribute\Domain\Entity\AbstractAttribute;
use Ergonode\Attribute\Infrastructure\Provider\AttributeValueConstraintStrategyInterface;
use Kreft\BooleanAttribute\Entity\BooleanAttribute;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\Collection;

class BooleanAttributeValueConstraintStrategy implements AttributeValueConstraintStrategyInterface
{
    public function get(AbstractAttribute $attribute): Constraint
    {
        return new Collection([
            'value' => [
                new Choice(['choices' => ['0', '1']]),
            ],
        ]);
    }

    public function supports(AbstractAttribute $attribute): bool
    {
        return $attribute instanceof BooleanAttribute;
    }
}
