<?php get_header() ;?>

<div id="main">
    <div id="news_list">
        <h2>NEWS</h2>
        <ul>
            <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
            <li>
                <div class="news_item">
                    <div class="news_date_and_categorylabel_wrap">
                        <!-- ◆投稿の日付を取得◆ -->
                        <time datetime="<?php 
                            $date = get_the_date("Y.m.d") ;
                            $yearMonth = '.';
                            $change_type = str_replace($yearMonth, '-', $date);
                            $change_type = str_replace('日', '', $change_type);
                            echo $change_type;
                        ?>">
                            <?php echo get_the_date("Y.m.d") ;?>
                        </time>

                        <!-- ◆投稿のカテゴリーを取得◆ -->
                        <p class="news_categorylabel">
                            <?php
                                $cat = get_the_category();
                                $cat = $cat[0];
                                echo $cat->name;
                            ?>
                        </p>
                    </div>
                    <!-- ◆投稿のタイトルを取得◆ -->
                    <p class="news_text">
                        <span><?php the_title() ;?></span>
                    </p>

                </div>
            </li>
            <?php endwhile; ?>
            <?php else: ?>
                <!-- ◆投稿がない場合の処理◆ -->
                <h3>投稿がありません。</h3>
            <?php endif; ?>
        </ul>

        <!-- ◆ページネーション◆ -->
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

<?php get_footer() ;?>