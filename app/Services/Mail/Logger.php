<?php

namespace Stack\Services\Mail;

class Logger extends Mail
{
    public function send()
    {
        $content = $this->toString();

        return (bool) file_put_contents($this->getFilePath(), $content . PHP_EOL, FILE_APPEND | LOCK_EX);
    }

    private function getFilePath()
    {
        return BASE_PATH . '/storage/mail.log';
    }

    private function toString()
    {
        return <<<EOT
=============================================
From: {$this->from}
To: {$this->to}
---------------------------------------------
{$this->content}
=============================================
EOT;
    }
}
