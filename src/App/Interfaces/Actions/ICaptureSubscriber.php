<?php

declare(strict_types=1);

namespace Codans\App\Interfaces\Actions;

interface ICaptureSubscriberAction
{
    public function run(): void;
}
