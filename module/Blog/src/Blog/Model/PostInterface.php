<?php
/**
 * Created by PhpStorm.
 * User: Deys
 * Date: 12.04.2015
 * Time: 21:15
 */
namespace Blog\Model;

interface PostInterface
{
    /**
     * Will return the ID of the blog post
     *
     * @return int
     */
    public function getId();

    /**
     * Will return the TITLE of the blog post
     *
     * @return string
     */
    public function getTitle();

    /**
     * Will return the TEXT of the blog post
     *
     * @return string
     */
    public function getText();
}