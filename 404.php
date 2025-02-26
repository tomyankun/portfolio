<?php get_header() ;?>

<div id="page-404">
  <h1>404 NOT FOUND</h1>
  <p>あなたがアクセスしようとしたページは削除されたかURLが変更されています。</p>
  <a href="<?php echo esc_url( home_url( '/' ) ); ?>">トップに戻る</a>
</div>

<?php get_footer() ;?>