<?php

namespace App\Controller;


use App\Cache\PromotionCache;
use App\DTO\LowestPriceEnquiry;
use App\Entity\Promotion;
use App\Repository\ProductRepository;
use App\Service\Serializer\DTOSerializer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Filter\PromotionsFilterInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;


class ProductsController extends AbstractController
{

    public function __construct
    (
        private ProductRepository $productRepository,
        private EntityManagerInterface $entityManager,
        private PromotionCache $promotionCache
    )
    {
           // dd('hello');

    }


    #[Route('/products/{id}/lowest-price', name: 'lowest-price', methods: 'POST')]
    public function lowestPrice(
        Request $request,
        int $id,
        DTOSerializer $serializer,
        PromotionsFilterInterface $lowestPriceEnquiry,
        PromotionsFilterInterface $promotionsFilter,
        PromotionCache $cache
        ): Response
    {



          $product = $this->productRepository->find($id);

          $lowestPriceEnquiry = $serializer->deserialize(
                $request->getContent(), LowestPriceEnquiry::class, 'json');


          $lowestPriceEnquiry->setProduct($product);

        $promotions =  $this->promotionCache->findValidForProduct($product,$lowestPriceEnquiry->getRequestDate());

          /*$promotions = $cache->get("find-valid-for-product-$id", function (ItemInterface $item) use($product,$lowestPriceEnquiry){

              var_dump('hello world');
              return  $this->entityManager->getRepository(Promotion::class)->findValidForProduct(
                  $product,
                  date_create_immutable($lowestPriceEnquiry->getRequestDate())
              );
          });*/

         // dd($promotions);
          $modifiedEnquiry= $promotionsFilter->apply($lowestPriceEnquiry, ...$promotions);


          $responseContent = $serializer->serialize($modifiedEnquiry , 'json') ;


          return new Response($responseContent,200, ['Content-Type' => 'application/json']);


    }
    #[Route('/products/{id}/promotions', name: 'promotions', methods: 'GET')]
    public function promotions()
    {
        dd('hello');
    }


}
