<?php
    get_header() ;

    $post_id = get_the_ID();
    $categories = get_the_terms( $post_id, 'work-category' );
?>


<div id="work-wrap">
    <div id="main">
        <div id="work">
            <h2>検索結果</h2>

            <?php if(have_posts()): while (have_posts()): the_post(); ?>
                <article>
                    <!-- ◆投稿のサムネイルを出力◆ -->
                    <div class="thumbnail">
                        <a href="<?php the_permalink();?>" target="_blank" rel="noopener noreferrer">
                            <img src="<?php echo CFS()->get('post_thumbnail'); ?>" alt="サムネイル">
                        </a>
                    </div>
                    <!-- ◆投稿のタイトルを出力◆ -->
                    <h3>
                        <a href="<?php the_permalink();?>" target="_blank" rel="noopener noreferrer">
                            <?php echo CFS()->get('post_title'); ?>
                        </a>
                    </h3>
                    <div class="date_and_categoryLabel_wrap">
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

                        <!-- ◆投稿のカテゴリーを出力◆ -->
                        <p class="category_label">
                            <?php echo $categories[0] -> name;?>
                        </p>
                    </div>
                    <!-- ◆投稿の説明を出力◆ -->
                    <div class="detail">
                        <p>
                            <?php echo CFS()->get('post_detail'); ?>
                        </p>
                    </div>
                </article>

            <?php endwhile; ?>

            <?php else: ?>
                <!-- ◆検索結果が存在しない場合の文言◆-->
                <h3>検索キーワードに該当する記事がありませんでした</h3>
            <?php endif; ?>

            <!-- ◆ページネーション◆ -->
            <div id="category-page-navi">
                <?php
                    $args = array(
                        'mid_size' => 1,
                        'prev_text' => '&lt;',
                        'next_text' => '&gt;',
                        'screen_reader_text' => ' ',
                    );
                    the_posts_pagination($args);
                ?>
                <?php wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
    <?php get_sidebar(); ?>
</div>

<!-- ◆レスポンシブ時◆ -->
<div class="res">

    <h3>category</h3>
    <?php
        $args = array(
            'taxonomy'   => 'work-category',
            'hide_empty' => false,
        );
        $categories = get_terms($args);

        if (!empty($categories) && !is_wp_error($categories)) {
            foreach ($categories as $category) {
                echo '<a href="' . esc_url(get_term_link($category)) . '">' . $category->name . '</a>';
            }
        }
    ?>

    <h3>search</h3>
    <form action="<?php echo esc_url(home_url('/')); ?>" method="get">
        <input name="s" type="text" placeholder="キーワード検索" required pattern="[\u3000-\u303F\u3040-\u309F\u30A0-\u30FF\uFF00-\uFF9F\u4E00-\u9FFF]*" title="日本語のみ入力してください">
        <button type="submit">検索</button>
    </form>

</div>

<?php get_footer() ;?>