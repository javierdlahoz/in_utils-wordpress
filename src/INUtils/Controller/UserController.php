<?php
namespace INUtils\Controller;

use INUtils\Helper\UserHelper;

class UserController extends AbstractController
{
    public function infoAction(){
        $username = $this->getPost("username");
        $user = get_user_by("login", $username);
        return array("user" => UserHelper::fromUserToArray($user));
    }
}