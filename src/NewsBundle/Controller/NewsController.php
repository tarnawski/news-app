<?php

namespace NewsBundle\Controller;

use News\Command\CreatePostCommand;
use News\Query\AllPostsQuery;
use News\Query\PostQuery;
use News\ServiceBus\CommandBus;
use News\ServiceBus\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NewsController extends Controller
{
    public function indexAction()
    {
        $allPostQuery = new AllPostsQuery();

        /** @var QueryBus $queryBus */
        $queryBus = $this->get('news.query_bus');
        $posts = $queryBus->handle($allPostQuery);

        return $this->render('NewsBundle::index.html.twig', array(
            'posts' => $posts
        ));
    }

    public function showAction($id)
    {
        $postQuery = new PostQuery($id);

        /** @var QueryBus $queryBus */
        $queryBus = $this->get('news.query_bus');
        $post = $queryBus->handle($postQuery);

        return $this->render('NewsBundle::index.html.twig', array(
            'posts' => [$post]
        ));
    }

    public function createAction()
    {
        $createPostCommand = new CreatePostCommand('Example title', 'Example content');

        /** @var CommandBus $commandBus */
        $commandBus = $this->get('news.command_bus');
        $commandBus->handle($createPostCommand);

        $allPostQuery = new AllPostsQuery();

        /** @var QueryBus $queryBus */
        $queryBus = $this->get('news.query_bus');
        $posts = $queryBus->handle($allPostQuery);

        return $this->render('NewsBundle::index.html.twig', array(
            'posts' => $posts
        ));
    }
}