<?php

declare(strict_types=1);

namespace Codans\Domain\Values;

use Codans\Domain\Interfaces\Values\ITag;

class Tag implements ITag
{
    /**
     * Tag value object.
     *
     * @param string $name
     * @param int $tag
     */
    public function __construct(
        private readonly string $name,
        private readonly int $tag,
    ) {
    }
}
