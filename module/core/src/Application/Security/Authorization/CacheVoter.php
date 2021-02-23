<?php

/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Ergonode\Core\Application\Security\Authorization;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;

/**
 * CacheVoter meant for caching heavy load voter operations like.
 */
class CacheVoter implements VoterInterface
{
    /**
     * @var bool[][]
     */
    private array $cache;
    private VoterInterface $voter;

    public function __construct(VoterInterface $voter)
    {
        $this->cache = [];
        $this->voter = $voter;
    }

    /**
     * {@inheritdoc}
     */
    public function vote(TokenInterface $token, $subject, array $attributes): int
    {
        if (!$identifier = $this->supportsCaching($attributes, $subject)) {
            return $this->voter->vote($token, $subject, $attributes);
        }
        $tokenHash = spl_object_hash($token);

        if (($this->cache[$tokenHash][$identifier]['token'] ?? null) !== $token) {
            $this->cache[$tokenHash][$identifier] = [
                'token' => $token,
                'isGranted' => $this->voter->vote($token, $subject, $attributes),
            ];
        }

        return $this->cache[$tokenHash][$identifier]['isGranted'];
    }

    /**
     * @param mixed $attributes
     * @param mixed $subject
     */
    private function supportsCaching($attributes, $subject): ?string
    {
        if (empty($attributes)) {
            return null;
        }
        foreach ($attributes as $attribute) {
            if (!is_string($attribute)) {
                return null;
            }
        }
        $id = implode($attributes);

        if (is_string($subject)) {
            $id .= "_str_$subject";
        } elseif (is_object($subject)) {
            $id .= '_obj'.spl_object_hash($subject);
        } elseif (null === $subject) {
            // nothing
        } else {
            return null;
        }

        return $id;
    }
}
