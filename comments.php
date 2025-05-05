<?php if (have_comments()): ?>
    <h3 class="comments-title">نظرات کاربران</h3>
    <div class="comment-list">
        <?php
        wp_list_comments([
            'avatar_size' => 48,
            'short_ping' => true,
            'callback' => 'custom_comment_callback',
            'end-callback' => 'end_custom_comment_callback'

        ]);
        ?>
    </div>
<?php else: ?>
    <p class="no-comments">هنوز نظری ثبت نشده است.</p>
<?php endif; ?>

<?php if (comments_open()): ?>
    <div class="comment-form-wrapper">
        <h3 class="form-title">ارسال نظر شما</h3>
        <?php
        comment_form([
            'title_reply' => '',
            'label_submit' => 'ارسال نظر',
            'class_submit' => 'submit-btn',
            'comment_notes_before' => '',
            'comment_field' => '
                <div class="form-group">
                    <label for="comment">متن نظر</label>
                    <textarea id="comment" name="comment" required></textarea>
                </div>',
            'fields' => [
                'author' => '
                    <div class="form-group">
                        <label for="author">نام</label>
                        <input id="author" name="author" type="text" required>
                    </div>',
                'email' => '
                    <div class="form-group">
                        <label for="email">ایمیل</label>
                        <input id="email" name="email" type="email" required>
                    </div>',
            ],
        ]);
        ?>
    </div>
<?php endif; ?>