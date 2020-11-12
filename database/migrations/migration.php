<?php

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->dropAllTables();

Capsule::schema()->create('users', function ($table) {
    $table->increments('id');
    $table->string('email')->unique();
    $table->string('password');
    $table->timestamp('email_verified_at')->nullable();
    $table->timestamps();
});

Capsule::schema()->create('password_resets', function ($table) {
    $table->string('email')->index();
    $table->string('token');
    $table->timestamp('created_at')->nullable();
});

Capsule::schema()->create('posts', function ($table) {
    $table->increments('id');
    $table->integer('user_id');
    $table->integer('parent_id')->nullable();
    $table->string('title')->nullable();
    $table->text('description');
    $table->timestamps();
});

Capsule::schema()->create('likes', function ($table) {
    $table->integer('user_id');
    $table->integer('post_id');
    $table->boolean('is_positive');

    $table->unique(['user_id', 'post_id']);
});
