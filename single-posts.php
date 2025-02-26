<?php get_header() ; ?>

<div id="main">
    <div id="posts">
        <article>
            <!-- ◆投稿のタイトルを出力◆ -->
            <h2>
                <?php echo CFS()->get('post_title'); ?>
            </h2>

            <div class="category">
                <?php
                    $post_id = get_the_ID();
                    $categories = get_the_terms( $post_id, 'work-category' );
                ?>
                <?php if ($categories): echo $categories[0] -> name; ?>
                <!-- ◆カテゴリーを設定していなければ未分類を表示◆ -->
                <?php else: echo('未分類'); ?>
                <?php endif; ?>
            </div>
            <!-- ◆投稿の投稿日を出力◆ -->
            <time datetime="<?php
                    $date = CFS()->get('post_date');
                    $yearMonth = array('年','月');
                    $change_type = str_replace($yearMonth, '-', $date);
                    $change_type = str_replace('日', '', $change_type);
                    echo $change_type; 
            ?>">
                <?php echo CFS()->get('post_date'); ?>
            </time>
            <!-- ◆投稿のサムネイルを出力◆ -->
            <div class="post-thumbnail">
                <img src="<?php echo CFS()->get('post_thumbnail'); ?>" alt="サムネイル">
            </div>
            <!-- ◆投稿の説明を出力◆ -->
            <div class="post-detail">
                <p>
                    <?php echo CFS()->get('post_detail'); ?>
                </p>
            </div>
            <div class="post-address">
                <div>
                    <!-- ◆投稿のタイトルを出力◆ -->
                    <?php echo CFS()->get('post_title'); ?>
                    <!-- ◆投稿のカテゴリーを出力◆ -->
                    （<?php
                        $post_id = get_the_ID();
                        $categories = get_the_terms( $post_id, 'work-category' ); 
                    ?>
                    <?php if ($categories): echo $categories[0] -> name; ?>
                    <!-- ◆カテゴリーを設定していなければ未分類を表示◆ -->
                    <?php else: echo('未分類'); ?>
                    <?php endif; ?>）はこちら ↓
                </div>
                <!-- ◆投稿のリンクを出力◆ -->
                <div>
                    <?php echo CFS()->get('post_link'); ?>
                </div>
            </div>
        </article>
    </div>
</div>

<?php get_footer() ;?>