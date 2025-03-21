<?php get_header();
/*
Template Name: ワークページ
*/
?>

<div id="work-wrap">
    <div id="main">
        <div id="work">
            <h2>WORK</h2>
            <?php
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

                $args = array(
                    'post_type' => 'posts',
                    'posts_per_page' => 6,
                    'paged' => $paged
                );
                $the_query = new WP_Query($args);
            ?>
            
            <?php if($the_query -> have_posts()): while ($the_query->have_posts()): $the_query->the_post(); ?>

                <article>
                    <!-- ◆投稿のサムネイルを出力◆ -->
                    <div class="thumbnail">
                        <a href="<?php esc_url( the_permalink() );?>" target="_blank" rel="noopener noreferrer">

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
                            <?php
                                $post_id = get_the_ID();
                                $categories = get_the_terms( $post_id, 'work-category' );
                                /
                            ?>
                            <?php if ($categories): echo $categories[0] -> name; ?>
                            <!-- ◆カテゴリーを設定していなければ未分類を表示◆ -->
                            <?php else: echo('未分類'); ?>
                            <?php endif; ?>
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
            <?php wp_reset_postdata(); ?>
            
            <?php else: ?>
                <!-- ◆条件式がFALSE（当てはまらない）の場合に実行する処理◆ -->
                <h3>投稿がありません。</h3>
            <?php endif; ?>

            <!-- ◆固定ページでのページネーション◆ -->
            <div id="page-navi">
                <?php 
                    global $wp_rewrite;
                    $paginate_base = get_pagenum_link(1);
                    if (strpos($paginate_base, '?') || !$wp_rewrite->using_permalinks()) {
                        $paginate_format = '';
                        $paginate_base = add_query_arg('paged', '%#%');
                    } else {
                        $paginate_format = (substr($paginate_base, -1, 1) == '/' ? '' : '/') .
                            user_trailingslashit('page/%#%/', 'paged');
                        $paginate_base .= '%_%';
                    }
                    echo paginate_links(array(
                        'base' => $paginate_base,
                        'format' => $paginate_format,
                        'total' => $the_query->max_num_pages,
                        'mid_size' => 2,
                        'current' => ($paged ? $paged : 1),
                        'prev_text' => '&lt;',
                        'next_text' => '&gt',
                    ));
                ?>
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

    <!-- ◆サーチフォーム　表示◆ -->
    <h3>search</h3>
    <form action="<?php echo esc_url(home_url('/')); ?>" method="get">
        <input name="s" type="text" placeholder="キーワード検索" required pattern="[\u3000-\u303F\u3040-\u309F\u30A0-\u30FF\uFF00-\uFF9F\u4E00-\u9FFF]*" title="日本語のみ入力してください">
        <button type="submit">検索</button>
    </form>

</div>

<?php get_footer() ;?>
