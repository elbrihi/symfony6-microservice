<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        ///dd($exception->getStatusCode());

        $response = new JsonResponse([
            "@context" => "/contexts/ConstraintViolationList",
             "@type" => "ConstraintViolationList",
            "hydra:title"=> "An error occurred",

             "hydra:description"=> "properties: The product must have the minimal properties required (\"description\", \"price\")",

            "violations"=> [
                [
                    "propertyPath"=> "properties",
                   "message"=> "The product must have the minimal properties required (\"description\", \"price\")"
                ]
              ]

        ]);

        if ($exception instanceof HttpExceptionInterface)
        {
            $response->setStatusCode($exception->getStatusCode());
        }
        else
        {
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $event->setResponse($response);
    }
}
