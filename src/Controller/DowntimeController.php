<?php

namespace App\Controller;

use App\Entity\Downtime;
use App\Repository\DowntimeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/downtime", name="downtime")
 */
class DowntimeController extends AbstractController
{
    use CharacterAware;

    /**
     * @Route(methods={"GET"}, name="downtime_get")
     * @param DowntimeRepository $downtimeRepository
     * @return JsonResponse
     */
    public function read(DowntimeRepository $downtimeRepository)
    {
        $data = null;
        if (null !== $this->getCharacter()) {
            $data = $downtimeRepository->findBy([
                'characterSheet' => $this->getCharacter()
            ], [
                'createdAt' => 'desc'
            ]);
        }
        return $this->json($data, 200, [], [
            'groups' => 'exposed',
        ]);
    }

    /**
     * @Route(name="downtime_create", methods={"POST"})
     *
     * @IsGranted("ROLE_USER", statusCode=401)
     * @ParamConverter("downtime", class="App\Entity\Downtime", options={"from_json":true})
     *
     * @return JsonResponse
     */
    public function create(EntityManagerInterface $em, Downtime $downtime)
    {
        $em->persist($downtime);
        $em->flush();

        return $this->json($downtime, 200, [], [
            'groups' => 'exposed',
        ]);
    }
}
