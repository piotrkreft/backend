<?php

/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See license.txt for license details.
 */

declare(strict_types = 1);

namespace Ergonode\Designer\Domain\Entity;

use Ergonode\Designer\Domain\ValueObject\Position;
use Ergonode\Designer\Domain\ValueObject\Size;
use Ergonode\Designer\Domain\ValueObject\TemplateElement\AbstractTemplateElementProperty;
use JMS\Serializer\Annotation as JMS;

/**
 */
class TemplateElement
{
    /**
     * @var Position
     *
     * @JMS\Type("Ergonode\Designer\Domain\ValueObject\Position")
     */
    protected $position;

    /**
     * @var Size
     *
     * @JMS\Type("Ergonode\Designer\Domain\ValueObject\Size")
     */
    protected $size;

    /**
     * @var AbstractTemplateElementProperty
     *
     * @JMS\Type("Ergonode\Designer\Domain\ValueObject\TemplateElement\AbstractTemplateElementProperty")
     */
    protected $properties;

    /**
     * @var string
     *
     * @JMS\Type("string")
     */
    protected $type;

    /**
     * @param Position                        $position
     * @param Size                            $size
     * @param string                          $type
     * @param AbstractTemplateElementProperty $properties
     */
    public function __construct(Position $position, Size $size, string $type, AbstractTemplateElementProperty $properties)
    {
        $this->position = $position;
        $this->size = $size;
        $this->properties = $properties;
        $this->type = $type;
    }

    /**
     * @return Position
     */
    public function getPosition(): Position
    {
        return $this->position;
    }

    /**
     * @return Size
     */
    public function getSize(): Size
    {
        return $this->size;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return AbstractTemplateElementProperty
     */
    public function getProperties(): AbstractTemplateElementProperty
    {
        return $this->properties;
    }
}