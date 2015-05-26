<?php
namespace Helper;

class UserHelper
{
    /**
     * 
     * @param WP_User $user
     */
    public static function fromUserToArray($user){
        return array(
            "id" => $user["data"]->ID,
            "username" => $user["data"]->user_login,
            "email" => $user["data"]->user_email,
            "url" => $user["data"]->user_url,
            "display_name" => $user["data"]->display_name,
            "first_name" => $user->first_name,
            "last_name" => $user->last_name
        );
    }
}