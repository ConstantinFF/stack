<div id="post-<?=$post->id?>" class="modal" tabindex="-1" style="display: block; position: relative; z-index: 1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=$post->user->email?></h5>
            </div>
            <div class="modal-body">
                <strong><?=$post->title?></strong>
                <p><?=$post->description?></p>
                <hr>
                <strong>Answers:</strong>
                <?php foreach ($post->comments as $comment):?>
                    <?=$view->partial('partials/comment', ['comment' => $comment])?>
                <?php endforeach;?>
                <form method="post" action="/answer/<?=$post->id?>">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-10">
                                <textarea class="form-control" name="description" id="exampleFormControlTextarea1"
                                    rows="1" required></textarea>
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-success float-right">Answer</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-start">
                <form method="post" action="/like/<?=$post->id?>">
                    <button type="submit" name="like" value="1"
                        class="btn <?=optional($post->likes->first())->is_positive === true? 'btn-primary' : 'btn-outline-primary'?>"
                    ><?=$post->positive_likes_count?> 🖒</button>
                    <button type="submit" name="like" value="0"
                        class="btn <?=optional($post->likes->first())->is_positive === false ? 'btn-primary' : 'btn-outline-primary'?>"
                    ><?=$post->negative_likes_count?> 🖓</button>
                </form>
            </div>
        </div>
    </div>
</div>