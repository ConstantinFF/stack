<?php

namespace Stack\Services\Providers;

use Stack\Services\Mail\MailInterface;
use Stack\Services\Mail\Logger as MailLogger;

class MailProvider implements ProviderInterface
{
    public function register(): void
    {
        app()->bind(MailInterface::class, MailLogger::class);
    }
}
