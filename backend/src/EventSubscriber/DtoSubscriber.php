<?php

namespace App\EventSubscriber;

use App\Event\AfterDtoCreatedEvent;
use App\Service\ServiceException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class DtoSubscriber implements  EventSubscriberInterface
{

    public function __construct(private ValidatorInterface $validator)
    {

    }
    public static function getSubscribedEvents(): array
    {
        return [
            AfterDtoCreatedEvent::NAME =>[
                ['validateDto',1],
                ['doSomeThingElse',100]
            ]
        ];
    }

    public function validateDto(AfterDtoCreatedEvent $event): void
    {
        //dd('hello !');
        $dto = $event->getDto();

        $errors = $this->validator->validate($dto);

        if(count($errors) > 0)
        {
            //throw new ValidationFailedException('Validation Error', $errors);
            throw new ServiceException(400,'validation failed');
        }

    }

    public function doSomeThingElse()
    {
        //dd('doing something else');
    }
}
