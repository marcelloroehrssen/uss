<?php

namespace App\Controller;

use App\Normalizer\AbstractMinimalNormalizer;
use App\Repository;
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
}
