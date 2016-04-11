<?php

namespace Artie\SocialAccounts\Core\Exceptions;


class ProviderNotFoundException extends SocialNetworkException
{
    /**
     * @param string $provider
     */
    public function __construct($provider)
    {
        $this->message = sprintf("Провайдер [%s] не найден.", $provider);
    }
}