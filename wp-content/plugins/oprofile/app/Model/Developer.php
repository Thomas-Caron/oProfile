<?php

namespace oProfile\Model;

class Developer
{
    /**
     * Get post id by user id
     *
     * @param int $userId User id
     *
     * @return null|int Post id
     */
    public static function getPostId($userId)
    {
        $developerId = null;

        $posts = get_posts(
            [
                'post_type'      => 'developer',
                'author'         => $userId,
                'offset'         => 0,
                'posts_per_page' => 1
            ]
        );

        if (! empty($posts)) {
            $developerId = $posts[0]->ID;
        }

        return $developerId;
    }
}
