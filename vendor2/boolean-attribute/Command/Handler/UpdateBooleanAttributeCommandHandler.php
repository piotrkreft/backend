<?php

/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Kreft\BooleanAttribute\Command\Handler;

use Ergonode\Attribute\Domain\Repository\AttributeRepositoryInterface;
use Ergonode\Attribute\Infrastructure\Handler\Attribute\AbstractUpdateAttributeCommandHandler;
use Kreft\BooleanAttribute\Command\UpdateBooleanAttributeCommand;
use Kreft\BooleanAttribute\Entity\BooleanAttribute;
use Webmozart\Assert\Assert;

class UpdateBooleanAttributeCommandHandler extends AbstractUpdateAttributeCommandHandler
{
    private AttributeRepositoryInterface $attributeRepository;

    public function __construct(AttributeRepositoryInterface $attributeRepository)
    {
        $this->attributeRepository = $attributeRepository;
    }

    public function __invoke(UpdateBooleanAttributeCommand $command): void
    {
        $attribute = $this->attributeRepository->load($command->getId());

        Assert::isInstanceOf($attribute, BooleanAttribute::class);

        $this->attributeRepository->save(
            $this->update($command, $attribute),
        );
    }
}
