<section class="comments">
    <div class="comments-header"><?= count($comments) ?> Коментариев</div>
    <div class="comments-container">
        <? if(count($comments)): ?>
            <?php foreach ($comments as $key => $comment): ?>
                <div class="comment-item <? if($comment['answer_flag']): ?>answer<? endif ?>">
                    <div class="comment-head">
                        <div class="user-name"><?= $comment['name'] ?></div>
                        <div class="comment-timestamp"><?= $comment['timestamp'] ?></div>
                        <? if(!$comment['answer_flag']): ?>
                            <div class="answer-btn-container">
                                <a href="<?= $comment['id'] ?>" class="answer">ответить <i class="mdi mdi-reply"></i></a>
                            </div>
                        <? endif ?>
                    </div>
                    <div class="comment-body">
                        <?= $comment['message'] ?>
                        <? if(is_admin()): ?>
                            <br>
                            <a class="danger-link" href="<?= linkTo('CommentController@remove', ['id' => $comment['id']]) ?>">Удалить</a>
                        <? endif; ?>
                    </div>
                </div>  
            <? endforeach ?>
        <? endif; ?>
    </div>
</section>