<?php

namespace LArtie\AttachSocialAccount\Core\Contracts;

interface HasSocialAccount
{
    /**
     * Получить все пивоты (социальные аккаунты для) для текущего пользователя
     * @return mixed
     */
    public function socialAccounts();

    /**
     *  Получить пивот (социальный аккаунт) по провайдеру
     * @param $provider
     * @param array $fields
     * @return array
     */
    public function getSocialAccountByProvider($provider, $fields = ['avatar', 'uid', 'token', 'nickname', 'name', 'email',]);

    /**
     * Получить все аккаунты социальных сетей в контейнере
     * @return mixed
     */
    public function getAllSocialAccounts();

    /**
     * Проверить имеет ли пользователь аккаунт социальной сети по короткому имени
     * @param $shortName
     * @return mixed
     */
    public function hasSocialAccountByShortName($shortName);

    /**
     * Проверить имеет ли пользователь аккаунт социальной сети по провайдеру
     * @param $provider
     * @return mixed
     */
    public function hasSocialAccountByProvider($provider);

    /**
     * Проверить имеет ли пользователь аккаунт социальной сети по id
     * @param $id
     * @return mixed
     */
    public function hasSocialAccountById($id);

    /**
     * Закрепить аккаунт социальной сети для пользователя по id
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function attachSocialAccountById($id, array $attributes);

    /**
     * Закрепить аккаунт социальной сети для пользователя по короткому имени
     * @param $shortName
     * @param array $attributes
     * @return mixed
     */
    public function attachSocialAccountByShortName($shortName, array $attributes);

    /**
     * Закрепить аккаунт социальной сети для пользователя по провайдеру
     * @param $provider
     * @param array $attributes
     * @return mixed
     */
    public function attachSocialAccountByProvider($provider, array $attributes);

    /**
     * Открепить аккаунт социальной сети пользователя по id
     * @param $id
     * @return mixed
     */
    public function detachSocialAccountById($id);

    /**
     * Открепить аккаунт социальной сети пользователя по провайдеру
     * @param $provider
     * @return mixed
     */
    public function detachSocialAccountByProvider($provider);

    /**
     * Открепить аккаунт социальной сети пользователя по короткому имени
     * @param $shortName
     * @return mixed
     */
    public function detachSocialAccountByShortName($shortName);

    /**
     * Открепить все аккаунты социальных сетей пользователя
     * @return mixed
     */
    public function detachAllSocialAccounts();
}