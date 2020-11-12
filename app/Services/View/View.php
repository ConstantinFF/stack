<?php

namespace Stack\Services\View;

class View
{
    private $template;

    private $data = [];

    private $response = [];

    private $templatesPath = '/templates';

    public function create($template, $data = [], $response = [])
    {
        $this->template = $template;

        $this->data = $data;

        $this->response = $response;
    }

    public function render(): string
    {
        $result = function ($file, array $data, $view) {
            ob_start();
            extract($data, EXTR_SKIP);

            try {
                include $file;
            } catch (\Exception $e) {
                ob_end_clean();

                throw $e;
            }

            return ob_get_clean();
        };

        $template = $this->findTemplate($this->template);
        
        return $result($template, $this->data, new ViewHelpers($this));
    }

    public function getStatusCode(): int
    {
        return $this->response['statusCode'] ?? 200;
    }

    public function getHeaders(): array
    {
        return $this->response['headers'] ?? [];
    }

    public function findTemplate(string $path): string
    {
        return BASE_PATH . $this->templatesPath . '/' . $path . '.php';
    }
    
    public function setTemplatePath($path): void
    {
        $this->templatesPath = $path;
    }
}
