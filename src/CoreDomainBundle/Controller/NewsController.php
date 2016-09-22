<?php

namespace CoreDomainBundle\Controller;

use CoreDomain\Command\CreatePostCommand;
use CoreDomain\Command\DeletePostCommand;
use CoreDomain\Query\AllPostsQuery;
use CoreDomain\Query\PostQuery;
use CoreDomain\ServiceBus\CommandBus;
use CoreDomain\ServiceBus\QueryBus;
use CoreDomainBundle\Model\Post;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use CoreDomainBundle\Form\Type\PostType;

class NewsController extends BaseController
{
    public function listAction()
    {
        $allPostQuery = new AllPostsQuery();
        /** @var QueryBus $queryBus */
        $queryBus = $this->get('core.query_bus');
        $posts = $queryBus->handle($allPostQuery);

        return $this->success($posts, 'Post', Response::HTTP_OK, array('DETAILS'));
    }

    public function showAction($uuid)
    {
        $postQuery = new PostQuery($uuid);

        /** @var QueryBus $queryBus */
        $queryBus = $this->get('core.query_bus');
        $post = $queryBus->handle($postQuery);

        return $this->success($post, 'Post', Response::HTTP_OK, array('DETAILS'));
    }

    public function createAction(Request $request)
    {
        $form = $this->createForm(PostType::class);
        $submittedData = json_decode($request->getContent(), true);
        $form->submit($submittedData);

        /** @var Post $post */
        $post = $form->getData();

        $createPostCommand = new CreatePostCommand($post->title, $post->content);

        /** @var CommandBus $commandBus */
        $commandBus = $this->get('core.command_bus');
        $commandBus->handle($createPostCommand);

        return JsonResponse::create(['STATUS' => 'ADDED']);
    }

    public function deleteAction($uuid)
    {
        $deletePostCommand = new DeletePostCommand($uuid);

        /** @var CommandBus $commandBus */
        $commandBus = $this->get('core.command_bus');
        $commandBus->handle($deletePostCommand);

        return JsonResponse::create(['STATUS' => 'REMOVED']);
    }
}
