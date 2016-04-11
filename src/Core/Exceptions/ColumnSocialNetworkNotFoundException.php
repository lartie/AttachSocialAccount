<?php

namespace LArtie\AttachSocialAccount\Core\Exceptions;


class ColumnSocialNetworkNotFoundException extends SocialNetworkException
{
    /**
     * @param string $column
     */
    public function __construct($column)
    {
        $this->message = sprintf("Модель SocialNetworks не имеет столбца с названием [%s].", $column);
    }
}