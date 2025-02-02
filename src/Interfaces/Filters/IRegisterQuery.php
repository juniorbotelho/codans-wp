<?php

declare(strict_types=1);

namespace Codans\Interfaces\Filters;

interface IRegisterQuery
{
    public function run(array $queries): array;
}
