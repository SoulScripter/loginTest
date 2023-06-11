<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/', 'home')]
class HomeController extends AbstractController
{
    #[Route('', '')]
    public function home(Request $request): Response
    {
        $user = $request->getSession()->get('user') ?? null;

        return $this->render('home.html.twig', ['user' => $user]);
    }
}