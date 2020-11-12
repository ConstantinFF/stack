<?=$view->partial('partials/header')?>

<?=$view->partial('partials/topbar')?>

<div class="container">
    <?php foreach ($posts as $post):?>
        <?=$view->partial('partials/post', ['post' => $post, 'user' => $user])?>
    <?php endforeach;?>
</div>

<?=$view->partial('partials/footer')?>
