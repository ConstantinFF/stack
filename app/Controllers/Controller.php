<?php

namespace Stack\Controllers;

abstract class Controller
{
    protected $routerMatch;

    public function __construct()
    {
        $this->loadTraits();
    }

    abstract public function __invoke();

    public function withMatch($match)
    {
        $this->routerMatch = $match;

        return $this;
    }

    private function loadTraits()
    {
        $uses = array_flip(class_uses(static::class));

        foreach ($uses as $trait) {
            $traitHandler = $this->traitHandler($trait);

            if (method_exists($this, $traitHandler)) {
                call_user_func([$this, $traitHandler]);
            }
        }
    }

    private function traitHandler($trait)
    {
        $trait = explode('\\', $trait);

        $traitName = end($trait);
    
        return 'execute' . $traitName . 'Trait';
    }
}
