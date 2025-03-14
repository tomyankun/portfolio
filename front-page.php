<?php get_header() ;?>

    <div id="main">
        <div id="FirstView">
            <h2>
                <img src="<?php echo get_template_directory_uri(); ?>/images/FirstView.svg" alt="タイトル">
            </h2>
        </div>

        <div id="outline">
            <h2>当ポートフォリオサイトをご覧いただき有難うございます。</h2>
            <p>このサイトは制作したWebサイトやバナーを掲載しています。<br>
                よろしければ<a href="<?php esc_url( home_url() ) ;?>/work">WORKページ</a>で作品をご覧になってください。<br>
                また、このサイトはWordpressで制作しました。<br>
                下記がそのソースコードです。
            </p>
            <a href="" target="_blank" rel="noopener noreferrer">
                https://github.co.jp/ここにGithubのURL
            </a>
        </div>

        <div id="news">
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
            <div id="news_list_button">
                <a href="<?php esc_url( home_url() ) ;?>/news">一覧を見る</a>
            </div>
        </div>
    </div>

<?php get_footer() ;?>
