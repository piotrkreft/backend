<?php

/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types = 1);

namespace Ergonode\AttributeDate\Application\Controller\Api;

use Ergonode\Api\Application\Response\SuccessResponse;
use Ergonode\AttributeDate\Infrastructure\Provider\DateFormatProvider;
use Swagger\Annotations as SWG;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 */
class DictionaryController extends AbstractController
{
    /**
     * @var DateFormatProvider
     */
    private $dateFormatProvider;

    /**
     * @param DateFormatProvider $dateFormatProvider
     */
    public function __construct(DateFormatProvider $dateFormatProvider)
    {
        $this->dateFormatProvider = $dateFormatProvider;
    }

    /**
     * @Route("/date_format", methods={"GET"})
     *
     * @SWG\Tag(name="Dictionary")
     * @SWG\Parameter(
     *     name="language",
     *     in="path",
     *     type="string",
     *     required=true,
     *     default="EN",
     *     description="Language Code",
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Returns collection of available date formats",
     * )
     *
     * @return Response
     */
    public function getDateFormat(): Response
    {
        return new SuccessResponse($this->dateFormatProvider->dictionary());
    }
}
