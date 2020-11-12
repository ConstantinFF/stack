<?php

namespace Stack\Services\View;

class ViewHelpers
{
    private $view;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function partial($path, $data = []): void
    {
        extract($data);

        $view = app()->make(ViewHelpers::class);

        include $this->view->findTemplate($path);
    }
}
