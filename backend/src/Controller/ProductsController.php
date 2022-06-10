<?php

namespace App\Controller;


use App\DTO\LowestPriceEnquiry;
use App\Service\Serializer\DTOSerializer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Filter\PromotionsFilterInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Flex\Response;

class ProductsController extends AbstractController
{

    #[Route('/products/{id}/lowest-price', name: 'lowest-price', methods: 'POST')]
    public function lowestPrice(
        Request $request,
        int $id,
        DTOSerializer $serializer,
        PromotionsFilterInterface $promotionsFilter
        ): JsonResponse
    {
            $lowestPriceEnquiry = $serializer->deserialize(
                $request->getContent(), LowestPriceEnquiry::class, 'json'
            );



            // 1. Deserialize json data into a EnquiryDTO

            // 2. Pass The Enquiry into a promotions filter



            $responseContent = $serializer->serialize($promotionsFilter->apply($lowestPriceEnquiry) , 'json') ;


            return new JsonResponse($responseContent,200);


    }
    #[Route('/products/{id}/promotions', name: 'promotions', methods: 'GET')]
    public function promotions()
    {
        dd('hello');
    }


    /*if ($request->headers->has('fail'))
         {
             return new JsonResponse(
                 ['error' => 'Promotions Egine failure message'],
                  $request->headers->get('fail')
             );
         }*/

}
