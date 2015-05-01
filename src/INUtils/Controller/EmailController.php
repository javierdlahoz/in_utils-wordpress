<?php
namespace INUtils\Controller;

use INUtils\Helper\EmailHelper;
class EmailController extends AbstractController
{
    /**
     *
     * @return multitype:string
     */
    public function sendAction()
    {
        $content = "This is the message of a user trying to contact you: ";

        $to = $this->getPost("to");
        $from = $this->getPost("from");
        $content .= $this->getPost("content");
        $name = $this->getPost("name");

        EmailHelper::sendContactEmail($to, $from, $content, $name);
        return array("message" => "email sent");
    }

    /**
     *
     * @return multitype:string
     */
    public function shareAction(){

        $to = $this->getPost("to");
        $from = get_option("admin_email");
        $url = $this->getPost("url");

        $subject = "Check this URL out";
        $message = "Check this url ".$url." this is from Insites";

        EmailHelper::sendEmail($to, $subject, $url, $message, $from);
        return array("message" => "email sent");
    }
}