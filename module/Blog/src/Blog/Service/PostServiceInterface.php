<?php
/**
 * Created by PhpStorm.
 * User: Deys
 * Date: 12.04.2015
 * Time: 21:14
 */
namespace Blog\Service;

use Blog\Model\PostInterface;

interface PostServiceInterface
{
    /**
     * Should return a set of all blog posts that we can iterate over. Single entries of the array are supposed to be
     * implementing \Blog\Model\PostInterface
     *
     * @return array|PostInterface[]
     */
    public function findAllPosts();

    /**
     * Should return a single blog post
     *
     * @param  int $id Identifier of the Post that should be returned
     * @return PostInterface
     */
    public function findPost($id);
}