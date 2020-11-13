<?php

namespace App\Controller;

use App\Entity\Item;
use App\Normalizer\AbstractMinimalNormalizer;
use App\Repository;
use App\Repository\DowntimeDefinitionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/lookup", name="lookup")
 */
class LookupController extends AbstractController
{
    /**
     * @Route("/attributes", name="lookup_attributes")
     *
     * @param Repository\AttributeRepository $attributeRepository
     * @return JsonResponse
     */
    public function attributes(Repository\AttributeRepository $attributeRepository)
    {
        $data = $attributeRepository->findAll();
        return $this->json($data, 200, [], [
            'groups' => 'exposed',
            'dots' => AbstractMinimalNormalizer::TYPE_MINIMAL
        ]);
    }

    /**
     * @Route("/faiths", name="lookup_faiths")
     * @param Repository\FaithRepository $faithRepository
     * @return JsonResponse
     */
    public function faith(Repository\FaithRepository $faithRepository)
    {
        $data = $faithRepository->findAll();
        return $this->json($data, 200, [], [
            'groups' => 'exposed'
        ]);
    }

    /**
     * @Route("/factions", name="lookup_factions")
     * @param Repository\FactionRepository $factionRepository
     * @return JsonResponse
     */
    public function factions(Repository\FactionRepository $factionRepository)
    {
        $data = $factionRepository->findAll();
        return $this->json($data, 200, [], [
            'groups' => 'exposed',
            'skill' => AbstractMinimalNormalizer::TYPE_MINIMAL
        ]);
    }

    /**
     * @Route("/defects", name="lookup_defects")
     * @param Repository\DefectRepository $defectRepository
     * @return JsonResponse
     */
    public function defects(Repository\DefectRepository $defectRepository)
    {
        $data = $defectRepository->findAll();
        return $this->json($data, 200, [], [
            'groups' => 'exposed'
        ]);
    }

    /**
     * @Route("/jobs_types", name="lookup_jobs_types")
     * @param Repository\JobTypeRepository $jobTypeRepository
     * @return JsonResponse
     */
    public function jobType(Repository\JobTypeRepository $jobTypeRepository)
    {
        $data = $jobTypeRepository->findAll();
        return $this->json($data, 200, [], [
            'groups' => 'exposed'
        ]);
    }

    /**
     * @Route("/jobs", name="lookup_jobs")
     * @param Repository\JobRepository $jobRepository
     * @return JsonResponse
     */
    public function job(Repository\JobRepository $jobRepository)
    {
        $data = $jobRepository->findAll();
        return $this->json($data, 200, [], [
            'groups' => 'exposed',
            'skill' => AbstractMinimalNormalizer::TYPE_MINIMAL,
            'jobType' => AbstractMinimalNormalizer::TYPE_MINIMAL
        ]);
    }

    /**
     * @Route("/skills", name="lookup_skills")
     * @param Repository\SkillRepository $skillRepository
     * @return JsonResponse
     */
    public function skills(Repository\SkillRepository $skillRepository)
    {
        $data = $skillRepository->findAll();
        return $this->json($data, 200, [], [
            'groups' => 'exposed',
            'dots' => AbstractMinimalNormalizer::TYPE_MINIMAL
        ]);
    }

    /**
     * @Route("/background", name="lookup_bakcground")
     * @param Repository\BackgroundRepository $backgroundRepository
     * @return JsonResponse
     */
    public function background(Repository\BackgroundRepository $backgroundRepository)
    {
        $data = $backgroundRepository->findAll();
        return $this->json($data, 200, [], [
            'groups' => 'exposed',
            'dots' => AbstractMinimalNormalizer::TYPE_MINIMAL
        ]);
    }

    /**
     * @Route("/introduction_text", name="lookup_introduction_text")
     * @param Repository\IntroductionTextRepository $introductionTextRepository
     * @return JsonResponse
     */
    public function introductionText(Repository\IntroductionTextRepository $introductionTextRepository)
    {
        $data = $introductionTextRepository->findAll();
        return $this->json($data, 200, [], [
            'groups' => 'exposed',
        ]);
    }

    /**
     * @Route("/items", name="lookup_items")
     * @param Repository\ItemRepository $itemRepository
     * @return JsonResponse
     */
    public function items(Repository\ItemRepository $itemRepository)
    {
        $data = $itemRepository->findBy([
            'enabled' => true
        ]);
        return $this->json($data, 200, [], [
            'groups' => 'exposed',
        ]);
    }

    /**
     * @Route("/items_types", name="lookup_items_type")
     * @return JsonResponse
     */
    public function itemsTypes()
    {
        return $this->json(array_values(Item::TYPES));
    }

    /**
     * @Route("/downtime_definition", name="lookup_downtime_definition")
     * @param Repository\DowntimeDefinitionRepository $downtimeDefinitionRepository
     * @return JsonResponse
     */
    public function downtimeDefinition(Repository\DowntimeDefinitionRepository $downtimeDefinitionRepository)
    {
        $data = $downtimeDefinitionRepository->findAll();
        return $this->json($data, 200, [], [
            'groups' => 'exposed',
        ]);
    }
}
