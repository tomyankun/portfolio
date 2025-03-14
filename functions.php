<?php

// 
//  ***   記事の自動整形を無効化 ***   
// 
remove_filter('the_content', 'wpautop');

// 
//  ***   抜粋の自動整形を無効化 ***   
// 
remove_filter('the_excerpt', 'wpautop');


// 
// ***   cssの読み込み   ***
// 
function add_files(){

    wp_enqueue_style( 'normalize', get_template_directory_uri() . '/css/normalize.css', array());
    wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css', array());
    wp_enqueue_style( 'base', get_template_directory_uri() . '/css/base-style.css', array());
    wp_enqueue_style( 'header', get_template_directory_uri() . '/css/header-style.css', array());
    wp_enqueue_style( 'front', get_template_directory_uri() . '/css/front-style.css', array());
    wp_enqueue_style( 'archive', get_template_directory_uri() . '/css/archive-style.css', array());
    wp_enqueue_style( 'profile', get_template_directory_uri() . '/css/profile-style.css', array());
    wp_enqueue_style( 'work', get_template_directory_uri() . '/css/work-style.css', array());
    wp_enqueue_style( 'sidebar', get_template_directory_uri() . '/css/sidebar-style.css', array());
    wp_enqueue_style( 'search', get_template_directory_uri() . '/css/search-form-style.css', array());
    wp_enqueue_style( 'taxonomy', get_template_directory_uri() . '/css/taxonomy-style.css', array());
    wp_enqueue_style( 'single', get_template_directory_uri() . '/css/single-posts-style.css', array());
    wp_enqueue_style( 'contact', get_template_directory_uri() . '/css/contact-style.css', array());
    wp_enqueue_style( 'footer', get_template_directory_uri() . '/css/footer-style.css', array());
    wp_enqueue_style( '404', get_template_directory_uri() . '/css/404-style.css', array());

}
add_action('wp_enqueue_scripts','add_files');


// 
// ***   news一覧のurlを設定。   ***
// 
function post_has_archive($args,$post_type){
    if('post' == $post_type){
        $args['rewrite'] = true;
        $args['has_archive'] = 'news';
        $args['label'] = 'NEWS';
    }
    return $args;
}
add_filter('register_post_type_args','post_has_archive',10,2);


// 
// ***   ページによって「1ページに表示する最大投稿」を変える。   ***
// 
function change_posts_per_page($query) {
    // ◆管理画面以外 かつ メインクエリーの時◆
    if ( is_admin() || ! $query->is_main_query() )
    
        return;
 
    // ◆アーカイブページの時◆
    if ( $query->is_archive() ) {
    
        $query->set( 'posts_per_page', '6' );
    }
}
add_action( 'pre_get_posts', 'change_posts_per_page' );


// 
// ***  検索時に固定ページを検索されないようにする。 ***
// 
function search_pre_get_posts( $query ) {
    // ◆管理画面、メインクエリー以外では何もしない◆
    if ( is_admin() || ! $query->is_main_query() ) {
        return;
    }
    // ◆サイト内検索でのみ動作◆
    else if ( $query->is_search() ){
        // ◆特定IDの記事をサイト内検索から除外◆
        $post_id = array('96','191','193','205'); 
        // ID 96 → 固定ページのCONTACT 
        // ID 191 → NEWSの投稿　→「ポートフォリオ掲載サイトを開設しました。」
        // ID 193 → NEWSの投稿　→「「英会話教室の新学期キャンペーン」を作成しました。」
        // ID 205 → NEWSの投稿　→「「Cafe moment of silence」を作成しました。」

        $query->set( 'post__not_in', $post_id );
    }
    return $query;
}
add_action( 'pre_get_posts', 'search_pre_get_posts' );


// 
// ***   headタグ内に自動でtitleタグが挿入されるように設定します。 ***   
// 
add_action('init', function() {
    add_theme_support('title-tag');
});


//
//  ***   カスタム投稿タイプ ***   
//
function register_works(){
    $labels = [
         "singular_name" => "posts",
         "edit_item" => "投稿を編集",
    ];

    $args = [
        "label" => "posts",
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "has_archive" => true,
        "delete_with_user" => false,
        "exclude_from_search" => false,
        "map_meta_cap" => true,
        "hierarchical" => true,
        "rewrite" => ["slug" => "posts", "with_front" => true ],
        "query_var" => true,
        "menu_position" => 5,
        "supports" => [ "title" , "editor" , "thumbnail" ],
    ];

    register_post_type( "posts", $args);
};

add_action( 'init', 'register_works' );


//
//   ***   カスタム投稿タイプのカテゴリー作成  ***   
//
function cpt_register_work_category(){
    $labels = [
         "singular_name" => "work-category",
    ];

    $args = [
        "label" => "制作物カテゴリー",
        "labels" => $labels,
        "publicly_queryable" => true,
        "hierarchical" => true,
        "show_in_menu" => true,
        "query_var" => true,
        "rewrite" => [
                "slug" => "work-category",
                "with_front" => false, 
        ],
        "show_admin_columu" => false,
        "show_in_rest" => true,
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "show_in_quick_edit" => false,
    ];
    register_taxonomy( "work-category",["posts"], $args);
};

add_action( 'init', 'cpt_register_work_category' );
