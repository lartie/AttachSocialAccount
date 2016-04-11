<?php

namespace Artie\SocialAccounts\Core\Traits;

use Illuminate\Support\Str;
use Artie\SocialAccounts\Core\Models\SocialNetworks;

/**
 * Class HasSocialAccount
 * @package Artie\SocialAuth\Core\Traits
 */
trait HasSocialAccount
{
    /**
     * Коллекция для кэшированная ролей
     * @var \Illuminate\Database\Eloquent\Collection|null
     */
    protected $socialAccounts;

    /**
     * Получить все пивоты (социальные аккаунты для) для текущего пользователя
     * @return mixed
     */
    public function socialAccounts()
    {
        return $this->belongsToMany(SocialNetworks::class)->withPivot([
            'avatar',
            'uid',
            'token',
            'nickname',
            'name',
            'email',
        ]);
    }

    /**
     *  Получить пивот (социальный аккаунт) по провайдеру
     * @param $provider
     * @param array $fields
     * @return array
     */
    public function getSocialAccountByProvider($provider, $fields = ['avatar', 'uid', 'token', 'nickname', 'name', 'email',])
    {
        $socialAccount = $this->belongsToMany(SocialNetworks::class)->where('provider', $provider)->withPivot($fields)->first();

        if (isset($socialAccount)) {
            $socialAccount = $socialAccount->toArray();
            return $socialAccount['pivot'];
        }

        return [];
    }

    /**
     * Получить все аккаунты социальных сетей в контейнере
     * @return mixed
     */
    public function getAllSocialAccounts()
    {
        return (!$this->socialAccounts) ? $this->socialAccounts = $this->socialAccounts()->get() : $this->socialAccounts;
    }

    /**
     * Проверить имеет ли пользователь аккаунт социальной сети по короткому имени
     * @param $shortName
     * @return mixed
     */
    public function hasSocialAccountByShortName($shortName)
    {
        return $this->getAllSocialAccounts()->contains(function ($key, $value) use ($shortName) {
            return Str::is($shortName, $value->short_name);
        });
    }

    /**
     * Проверить имеет ли пользователь аккаунт социальной сети по провайдеру
     * @param $provider
     * @return mixed
     */
    public function hasSocialAccountByProvider($provider)
    {
        return $this->getAllSocialAccounts()->contains(function ($key, $value) use ($provider) {
            return Str::is($provider, $value->provider);
        });
    }

    /**
     * Проверить имеет ли пользователь аккаунт социальной сети по id
     * @param $id
     * @return mixed
     */
    public function hasSocialAccountById($id)
    {
        return $this->getAllSocialAccounts()->contains(function ($key, $value) use ($id) {
            return $id == $value->id;
        });
    }

    /**
     * Закрепить аккаунт социальной сети для пользователя по id
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function attachSocialAccountById($id, array $attributes)
    {
        return (!$this->getAllSocialAccounts()->contains($id)) ? $this->socialAccounts()->attach($id, $attributes) : true;
    }

    /**
     * Закрепить аккаунт социальной сети для пользователя по короткому имени
     * @param $shortName
     * @param array $attributes
     * @return mixed
     */
    public function attachSocialAccountByShortName($shortName, array $attributes)
    {
        $social = new SocialNetworks();
        $id = $social->getSocialNetworkId('short_name', $shortName);

        $this->attachSocialAccountById($id, $attributes);
    }

    /**
     * Закрепить аккаунт социальной сети для пользователя по провайдеру
     * @param $provider
     * @param array $attributes
     * @return mixed
     */
    public function attachSocialAccountByProvider($provider, array $attributes)
    {
        $social = new SocialNetworks();
        $id = $social->getSocialNetworkId('provider', $provider);

        $this->attachSocialAccountById($id, $attributes);
    }

    /**
     * Открепить аккаунт социальной сети пользователя по id
     * @param $id
     * @return mixed
     */
    public function detachSocialAccountById($id)
    {
        $this->socialAccounts = null;

        return $this->socialAccounts()->detach($id);
    }

    /**
     * Открепить аккаунт социальной сети пользователя по провайдеру
     * @param $provider
     * @return mixed
     */
    public function detachSocialAccountByProvider($provider)
    {
        $social = new SocialNetworks();
        $id = $social->getSocialNetworkId('provider', $provider);

        return $this->detachSocialAccountById($id);
    }

    /**
     * Открепить аккаунт социальной сети пользователя по короткому имени
     * @param $shortName
     * @return mixed
     */
    public function detachSocialAccountByShortName($shortName)
    {
        $social = new SocialNetworks();
        $id = $social->getSocialNetworkId('short_name', $shortName);

        return $this->detachSocialAccountById($id);
    }

    /**
     * Открепить все аккаунты социальных сетей пользователя
     * @return mixed
     */
    public function detachAllSocialAccounts()
    {
        $this->socialAccounts = null;

        return $this->socialAccounts()->detach();
    }
}