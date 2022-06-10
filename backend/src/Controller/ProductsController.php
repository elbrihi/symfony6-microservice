<?php

namespace App\Controller;


use App\DTO\LowestPriceEnquiry;
use App\Service\Serializer\DTOSerializer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Flex\Response;

class ProductsController extends AbstractController
{

    #[Route('/products/{id}/lowest-price', name: 'lowest-price', methods: 'POST')]
    public function lowestPrice(Request $request,int $id, DTOSerializer $serializer): JsonResponse
    {

            $lowestPriceEnquiry = $serializer->deserialize(
                $request->getContent(), LowestPriceEnquiry::class, 'json'
            );



        // 1. Deserialize json data into a EnquiryDTO

            // 2. Pass The Enquiry into a promotions filter


            $lowestPriceEnquiry->setDiscountedPrice(50);
            $lowestPriceEnquiry->setPrice(100);
            $lowestPriceEnquiry->setPromotionId(4);
            $lowestPriceEnquiry->setPromotionName('Black Friday half price sale');

            $responseContent = $serializer->serialize($lowestPriceEnquiry , 'json') ;


            return new JsonResponse($responseContent,200);

            if ($request->headers->has('fail'))
            {
                return new JsonResponse(
                    ['error' => 'Promotions Egine failure message'],
                     $request->headers->get('fail')
                );
            }
            return new JsonResponse([
            "quantity" => 5,
            "request_locaton" => "UK",
            "voucher_code" => "OU812",
            "request_date" => "2022-04-04",
            "product_id" => $id,
             "price" => 100,
             "discounted_price" => 50,
             "promotion_id" => 3,
             "promotion_name" => "Black Friday half price sale"
        ], 200);
    }
    #[Route('/products/{id}/promotions', name: 'promotions', methods: 'GET')]
    public function promotions()
    {
        dd('hello');
    }

}
