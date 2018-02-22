<?php

namespace Sunnyvale\REST\Response\OK;

use Sunnyvale\REST\Response\OK;

class JSON extends OK
{
    public function __construct($body)
    {
        $this->body = $this->isJSON($body) ? $body . "\n\r" : json_encode($body, JSON_UNESCAPED_UNICODE) . "\n\r";
        $this->headers[] = "Content-Type: application/json; charset=utf-8";
        $this->headers[] = "Content-Length: " . strlen($this->body);
    }

    private function isJSON($content)
    {
        if (is_string($content)) {
            $pos = strpos($content, "{");
            if ($pos === 0 || $pos === 1) {
                return true;
            }
        }

        return false;
    }
}