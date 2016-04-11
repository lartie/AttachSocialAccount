<?php

namespace LArtie\AttachSocialAccount\Core\Models;

use Illuminate\Database\Eloquent\Model;

class SocialNetworksUser extends Model
{

    protected $table = 'social_networks_user';

    protected $fillable = [
        'token', 'uid', 'nickname', 'name', 'email', 'avatar',
    ];
}