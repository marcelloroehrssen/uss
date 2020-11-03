<?php

namespace App\Controller;

use App\Repository\CharacterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Character;

/**
 * @return JsonResponse
 */
class CharacterController extends AbstractController
{
    private CharacterRepository $characterRepository;

    /**
     * CharacterController constructor.
     * @param CharacterRepository $characterRepository
     */
    public function __construct(CharacterRepository $characterRepository)
    {
        $this->characterRepository = $characterRepository;
    }

    /**
     * @Route("/character", name="character_read", methods={"GET"})
     * @IsGranted("ROLE_USER", statusCode=401)
     *
     * @return JsonResponse
     */
    public function read()
    {
        $data = $this->characterRepository->findOneBy([
            'user' => $this->getUser(),
        ]);
        return $this->json($data);
    }

    /**
     * @Route("/characters", name="character_list", methods={"GET"})
     * @IsGranted("ROLE_USER", statusCode=401)
     *
     * @return JsonResponse
     */
    public function list()
    {
        $data = $this->characterRepository->findBy([
            'user' => $this->getUser(),
        ]);
        return $this->json($data);
    }

    /**
     * @Route("/character", name="character_create", methods={"POST"})
     * @IsGranted("ROLE_USER", statusCode=401)
     *
     * @ParamConverter("character", class="App\Entity\Character", options={"from_json":true})
     * @return JsonResponse
     */
    public function create(EntityManagerInterface $em, Character $character)
    {
        $character->setUser($this->getUser());

        $em->persist($character);
        $em->flush();

        return $this->json($character);
    }
}