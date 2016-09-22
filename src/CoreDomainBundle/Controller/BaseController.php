<?php

namespace CoreDomainBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use JMS\Serializer\SerializationContext;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ApiController
 * @package ApiBundle\Controller
 */
abstract class BaseController extends FOSRestController
{
    /**
     * @param array $data
     * @param int $code
     * @return mixed
     */
    protected function error($data = array(), $code = Response::HTTP_BAD_REQUEST)
    {
        $view = $this->view()
            ->setStatusCode($code)
            ->setData($data);

        return $this->handleView($view);
    }

    /**
     * @param $data
     * @param $templateVar
     * @param int $code
     * @param array $serializationGroups
     * @return Response
     */
    protected function success($data, $templateVar, $code = Response::HTTP_OK, array $serializationGroups = array('Default'))
    {
        $view = $this->view()
            ->setTemplateVar($templateVar)
            ->setStatusCode($code)
            ->setData($data)
            ->setSerializationContext(SerializationContext::create()->setGroups($serializationGroups));

        return $this->handleView($view);
    }
}
