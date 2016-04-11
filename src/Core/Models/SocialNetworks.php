<?php

namespace LArtie\AttachSocialAccount\Core\Models;

use LArtie\AttachSocialAccount\Core\Exceptions\ColumnSocialNetworkNotFoundException;
use LArtie\AttachSocialAccount\Core\Exceptions\ProviderNotFoundException;
use LArtie\AttachSocialAccount\Core\Exceptions\ShortNameNotFoundException;

use Illuminate\Database\Eloquent\Model;

class SocialNetworks extends Model
{

    protected $fillable = [
       'provider', 'short_name',
    ];

    /**
     * Получить идентификатор социальной сети
     * @param $key
     * @param $value
     * @return integer
     * @throws ColumnSocialNetworkNotFoundException
     * @throws ProviderNotFoundException
     * @throws ShortNameNotFoundException
     */
    public function getSocialNetworkId($key, $value)
    {
        $socialAccount = SocialNetworks::select('id')->where($key, $value)->first();

        if (isset($socialAccount->id)) {
            return $socialAccount->id;
        }

        switch($key) {
            case 'provider':
                throw new ProviderNotFoundException($value);
                break;
            case 'short_name':
                throw new ShortNameNotFoundException($value);
                break;
            default:
                throw new ColumnSocialNetworkNotFoundException($key);
        }
    }

    /**
     * @param $provider
     * @return bool
     */
    public static function providerExists($provider)
    {
        $exists = SocialNetworks::select('id')->where('provider', $provider)->first();

        return isset($exists->id) ? true : false;
    }
}