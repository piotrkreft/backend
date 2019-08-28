<?php

/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See license.txt for license details.
 */

declare(strict_types = 1);

namespace Ergonode\Workflow\Infrastructure\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class WorkflowExists extends Constraint
{
    /**
     * @var string
     */
    public $message = 'Workflow {{ value }} already exists.';
}
