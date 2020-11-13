<?php


namespace App\Controller;

use App\Repository\CharacterRepository;

trait CharacterAware
{
    private CharacterRepository $characterRepository;

    /**
     * @Required
     * @param CharacterRepository $characterRepository
     */
    public function setCharacterRepository(CharacterRepository $characterRepository): void
    {
        $this->characterRepository = $characterRepository;
    }

    public function getCharacter()
    {
        return $this->characterRepository->findOneBy([
            'user' => $this->getUser(),
            'enabled' => true
        ]);
    }
}