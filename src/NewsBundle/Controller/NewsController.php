<?php

namespace NewsBundle\Controller;

use News\Command\CreatePostCommand;
use News\Query\PostQuery;
use News\ServiceBus\CommandBus;
use News\ServiceBus\QueryBus;
use NewsBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class NewsController extends Controller
{
    public function showAction($id)
    {
        $postQuery = new PostQuery($id);

        /** @var QueryBus $queryBus */
        $queryBus = $this->get('news.query_bus');
        /** @var Post $post */
        $post = $queryBus->handle($postQuery);

        return JsonResponse::create([
            'id' => $post->getId(),
            'title' => $post->getTitle(),
            'content' => $post->getContent()
        ]);
    }

    public function createAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $createPostCommand = new CreatePostCommand($data['title'], $data['content']);

        /** @var CommandBus $commandBus */
        $commandBus = $this->get('news.command_bus');
        $commandBus->handle($createPostCommand);

        return JsonResponse::create([
            'title' => $data['title'],
            'content' => $data['content']
        ]);
    }
}