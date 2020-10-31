<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user_user")
     */
    public function user()
    {
        return $this->json($this->getUser(), 200, [], [
            'groups' => 'exposed'
        ]);
    }

    /**
     * @Route("/user/email", name="user_user_email")
     */
    public function email(Request $request, UserRepository $userRepository)
    {
        $user = $userRepository->findOneBy([
            'email' => json_decode($request->getContent())->email ?? ''
        ]);
        return $this->json(['exists' => $user !== null], 200, []);
    }
}