<?php

/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Kreft\BooleanAttribute\Grid\Column\Provider\Strategy;

use Ergonode\Attribute\Domain\Entity\AbstractAttribute;
use Ergonode\Core\Domain\ValueObject\Language;
use Ergonode\Grid\ColumnInterface;
use Ergonode\Product\Infrastructure\Grid\Column\Provider\Strategy\AttributeColumnStrategyInterface;
use Kreft\BooleanAttribute\Entity\BooleanAttribute;
use Kreft\BooleanAttribute\Grid\Column\BooleanColumn;

class BooleanAttributeColumnStrategy implements AttributeColumnStrategyInterface
{
    public function supports(AbstractAttribute $attribute): bool
    {
        return $attribute instanceof BooleanAttribute;
    }

    public function create(AbstractAttribute $attribute, Language $language): ColumnInterface
    {
        return new BooleanColumn(
            $attribute->getCode()->getValue(),
            $attribute->getLabel()->get($language),
        );
    }
}
