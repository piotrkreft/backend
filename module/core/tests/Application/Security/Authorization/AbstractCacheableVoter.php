<?php

/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Ergonode\Core\Tests\Application\Security\Authorization;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

abstract class AbstractCacheableVoter extends Voter
{
    abstract public function supports($attribute, $subject);
    abstract public function voteOnAttribute($attribute, $subject, TokenInterface $token);

    final public function vote(TokenInterface $token, $subject, array $attributes)
    {
        return parent::vote($token, $subject, $attributes);
    }
}
