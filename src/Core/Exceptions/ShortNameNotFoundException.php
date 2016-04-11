<?php

namespace Artie\SocialAccounts\Core\Exceptions;


class ShortNameNotFoundException extends SocialNetworkException
{
    /**
     * @param $shortName
     */
    public function __construct($shortName)
    {
        $this->message = sprintf("Провайдер с псевдонимом [%s] не найден.", $shortName);
    }
}