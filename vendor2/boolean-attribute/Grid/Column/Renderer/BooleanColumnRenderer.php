<?php

/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Kreft\BooleanAttribute\Grid\Column\Renderer;

use Ergonode\Grid\Column\Exception\UnsupportedColumnException;
use Ergonode\Grid\Column\Renderer\ColumnRendererInterface;
use Ergonode\Grid\ColumnInterface;
use Kreft\BooleanAttribute\Grid\Column\BooleanColumn;

class BooleanColumnRenderer implements ColumnRendererInterface
{
    /**
     * {@inheritDoc}
     */
    public function supports(ColumnInterface $column): bool
    {
        return $column instanceof BooleanColumn;
    }

    /**
     * {@inheritDoc}
     */
    public function render(ColumnInterface $column, string $id, array $row): bool
    {
        if (!$this->supports($column)) {
            throw new UnsupportedColumnException($column);
        }

        return (bool) ($row[$id] ?? false);
    }
}
