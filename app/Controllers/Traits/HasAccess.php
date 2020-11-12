<?php

namespace Stack\Controllers\Traits;

use Symfony\Component\Security\Core\Exception\AccessDeniedException;

trait HasAccess
{
    protected function executeHasAccessTrait()
    {
        if (! $this->access()) {
            throw new AccessDeniedException;
        }
    }
}
