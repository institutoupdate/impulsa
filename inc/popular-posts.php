<?php

/**
 * Stores views of different time periods as meta keys.
 *
 * @author  @migueleste / @radgh
 * @link    https://wordpress.org/support/topic/how-to-sort-a-custom-query-by-views-all-time-monthly-weekly-or-daily/
 * @param   int     $postid     The ID of the current post/page/custom post type.
 */
function custom_wpp_update_postviews($postid) {
    // Accuracy:
    //   10  = 1 in 10 visits will update view count. (Recommended for high traffic sites.)
    //   30  = 30% of visits. (Medium traffic websites.)
    //   100 = Every visit. Creates many db write operations every request.

    $accuracy = 50;

    if ( function_exists('wpp_get_views') && (mt_rand(0,100) < $accuracy) ) {
        // Remove or comment out lines that you won't be using!!
        update_post_meta(
            $postid,
            'views_total',
            wpp_get_views($postid, 'all', false)
        );
        update_post_meta(
            $postid,
            'views_daily',
            wpp_get_views($postid, 'daily', false)
        );
        update_post_meta(
            $postid,
            'views_weekly',
            wpp_get_views($postid, 'weekly', false)
        );
        update_post_meta(
            $postid,
            'views_monthly',
            wpp_get_views($postid, 'monthly', false)
        );
    }
}
add_action('wpp_post_update_views', 'custom_wpp_update_postviews');
