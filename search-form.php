<form action="<?php echo esc_url(home_url('/')); ?>" method="get">
    <input name="s" type="text" placeholder="キーワード検索" required pattern="[\u3000-\u303F\u3040-\u309F\u30A0-\u30FF\uFF00-\uFF9F\u4E00-\u9FFF]*" title="日本語のみ入力してください">
    <button type="submit">検索</button>
</form>