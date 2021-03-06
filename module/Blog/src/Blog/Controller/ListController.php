<?php
/**
 * Created by PhpStorm.
 * User: Deys
 * Date: 12.04.2015
 * Time: 21:10
 */
namespace Blog\Controller;

use Blog\Service\PostServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ListController extends AbstractActionController
{
    /**
     * @var \Blog\Service\PostServiceInterface
     */
    protected $postService;

    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;
    }

    public function indexAction()
    {
        return new ViewModel(array(
            'posts' => $this->postService->findAllPosts()
        ));
    }
}