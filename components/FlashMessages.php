<?php

namespace components;

class FlashMessages
{
    /**
     * add flash message to session
     * @param array $messages
     */
    public static function add($messages)
    {
        $_SESSION['flash'] = [
            'messages' => $messages
        ];
    }

    /**
     * display flash messages
     * @return mixed
     */
    public static function show()
    {
        if (isset($_SESSION['flash']) && !is_null($_SESSION['flash'])) {
            $messages = $_SESSION['flash']['messages'];
            unset($_SESSION['flash']);

            $result = '';

            foreach ($messages as $message) {
                $result .= '<div class="flash">' . $message . '</div>';
            }
            return $result;
        } else {
            return false;
        }
    }
}