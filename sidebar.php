<div id="side">
    <div id="category_list">
        <h3>CATEGORIES</h3>
        <ul>
            <?php
                $args = array(
                    'taxonomy'   => 'work-category',
                    'hide_empty' => false,
                );
                $categories = get_terms($args);

                if (!empty($categories) && !is_wp_error($categories)) {
                    foreach ($categories as $category) {
                        echo '<li>'.'<a href="' . esc_url(get_term_link($category)) . '">' . $category->name . '</a>'.'<li>';
                    }
                }
            ?>
        </ul>
    </div>
    
    <div id="form">
        <?php get_search_form(); ?>
    </div>
</div>