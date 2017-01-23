<?php

namespace Wedding;

class Messages
{

    const SESS_NS = 'wedding/messages';

    public static function addSuccess($msg)
    {
        self::addMessage($msg, 'success');
    }

    public static function addWarning($msg)
    {
        self::addMessage($msg, 'warning');
    }

    public static function addError($msg)
    {
        self::addMessage($msg, 'error');
    }

    public static function addMessage($msg, $type)
    {
        $_SESSION[self::SESS_NS][$type][] = $msg;
    }

    public static function outputMessages($includeContainer = true)
    {
        $html = [];
        $messages = self::getMessages();
        if(is_array($messages)) {
            if($includeContainer) {
                $html[] = '<div class="message-container">';
            }

            foreach ($messages as $type => $messageArr) {
                if($type == 'error') { $type = 'danger'; }
                foreach($messageArr as $message) {
                    $html[] = sprintf('<div class="alert alert-%s" role="alert">%s</div>', $type, $message);
                }
            }

            if($includeContainer) {
                $html[] = '</div>';
            }

            self::clear();
        }

        return implode("\n", $html);
    }

    public static function getMessages()
    {
        if(isset($_SESSION[self::SESS_NS])) {
            return $_SESSION[self::SESS_NS];
        }

        return [];
    }


    public static function clear()
    {
        unset($_SESSION[self::SESS_NS]);
    }

}
