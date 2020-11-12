<?php

    $router->get('\/', \Stack\Controllers\Home::class);

    $router->get('\/login', \Stack\Controllers\Login::class);

    $router->post('\/login', \Stack\Controllers\Authenticate::class);

    $router->get('\/register', \Stack\Controllers\Register::class);
    
    $router->post('\/register', \Stack\Controllers\CreateAccount::class);

    $router->post('\/ask', \Stack\Controllers\Ask::class);

    $router->post('\/answer\/(?P<post_id>\d+)', \Stack\Controllers\Answer::class);

    $router->post('\/like\/(?P<post_id>\d+)', \Stack\Controllers\Like::class);
