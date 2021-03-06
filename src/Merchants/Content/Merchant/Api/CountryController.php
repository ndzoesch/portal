<?php declare(strict_types=1);

namespace Shopware\Production\Merchants\Content\Merchant\Api;

use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\Routing\Annotation\RouteScope;
use Shopware\Core\System\SalesChannel\Entity\SalesChannelRepositoryInterface;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @RouteScope(scopes={"merchant-api"})
 */
class CountryController
{
    /**
     * @var SalesChannelRepositoryInterface
     */
    private $countryRepository;

    public function __construct(SalesChannelRepositoryInterface $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    /**
     * @Route(name="merchant-api.countries", path="/merchant-api/v{version}/country", methods={"GET"})
     */
    public function load(SalesChannelContext $context): JsonResponse
    {
        $criteria = new Criteria();

        $result = $this->countryRepository->search($criteria, $context);

        return new JsonResponse([
            'total' => $result->getTotal(),
            'data' => $result->getEntities()
        ]);
    }
}
