<?php

namespace Stack\Services\Mail;

use Stack\Services\View\View;

abstract class Mail implements MailInterface
{
    protected $content;
    protected $to;
    protected $from;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function create(string $template, array $data = [])
    {
        $this->view->create($template, $data);

        $this->content = $this->view->render();

        return $this;
    }

    public function to(string $to)
    {
        $this->to = $to;

        return $this;
    }

    public function from(string $from)
    {
        $this->from = $from;

        return $this;
    }
}
