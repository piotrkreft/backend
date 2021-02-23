<?php

/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Ergonode\Core\Tests\Application\Security\Authorization;

use Ergonode\Core\Application\Security\Authorization\CacheVoter;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;

class CacheVoterTest extends TestCase
{
    /**
     * @var VoterInterface|MockObject
     */
    private $mockVoter;

    private CacheVoter $voter;

    protected function setUp(): void
    {
        $this->mockVoter = $this->createMock(VoterInterface::class);

        $this->voter= new CacheVoter(
            $this->mockVoter,
        );
    }

    /**
     * @dataProvider supportedAttributesProvider
     *
     * @param object|string|null $subject
     */
    public function testShouldCache($subject, array $attributes): void
    {
        $token = $this->createMock(TokenInterface::class);
        $this->mockVoter->expects($this->once())->method('vote')->willReturn(1);

        $resultFirst = $this->voter->vote($token, $subject, $attributes);
        $resultSecond = $this->voter->vote($token, $subject, $attributes);

        $this->assertEquals(1, $resultFirst);
        $this->assertEquals(1, $resultSecond);
    }

//    /**
//     * @dataProvider supportedAttributesProvider
//     *
//     * @param object|string|null $subject
//     */
//    public function testShouldNotCacheForCallsWithDifferentParameters($subject, array $attributes): void
//    {
//        $token = $this->createMock(TokenInterface::class);
//
//        $this->mockVoter
//            ->expects($this->exactly($attributes === $subject ? 1 : 2))
//            ->method('isGranted')
//            ->willReturn(true);
//
//        $resultFirst = $this->cacheVo->isGranted($attributes, $subject);
//        // reversed order in second call
//        $resultSecond = $this->cacheChecker->isGranted($subject, $attributes);
//
//        $this->assertTrue($resultFirst);
//        $this->assertTrue($resultSecond);
//    }

    public function supportedAttributesProvider(): array
    {
        return [
            ['string', ['1', '2']],
            [null, ['1', '2']],
            [new \stdClass(), ['1', '2']],
        ];
    }

//    /**
//     * @dataProvider notSupportedAttributesProvider
//     *
//     * @param mixed $attributes
//     * @param mixed $subject
//     */
//    public function testShouldNotCacheForUnsupportedTypes($attributes, $subject): void
//    {
//        $token = $this->createMock(TokenInterface::class);
//        $this->mockTokenStorage->method('getToken')->willReturn($token);
//
//        $this->mockVoter
//            ->expects($this->exactly(2))
//            ->method('isGranted')
//            ->willReturn(true);
//
//        $resultFirst = $this->cacheChecker->isGranted($attributes, $subject);
//        $resultSecond = $this->cacheChecker->isGranted($attributes, $subject);
//
//        $this->assertTrue($resultFirst);
//        $this->assertTrue($resultSecond);
//    }
//
//    public function notSupportedAttributesProvider(): array
//    {
//        return [
//            [null, null],
//            [null, 1],
//            ['string', []],
//            [new \stdClass(), 1.25],
//            [[], null],
//            [1, null],
//            [1.25, null],
//        ];
//    }
}
