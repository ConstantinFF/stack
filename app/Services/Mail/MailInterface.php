<?php

namespace Stack\Services\Mail;

interface MailInterface
{
    public function create(string $template, array $data = []);

    public function to(string $to);

    public function from(string $from);

    public function send();
}
