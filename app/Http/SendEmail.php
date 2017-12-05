<?php
/**
 * Created by PhpStorm.
 * User: yaseer
 * Date: 12/5/2017
 * Time: 9:53 AM
 */

namespace App\Http;


class SendEmail
{

    public function sendEmail($msg,$subject,$sender)
    {
        $msg = $msg;

// use wordwrap() if lines are longer than 70 characters
        $msg = wordwrap($msg,100);

// send email
        if(mail($sender,$subject,$msg))
        {
            echo 'Successfully Sent Email';
        }else{
            echo 'Failed to Send Email';
        }
    }
}