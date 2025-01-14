<?php

namespace App\Controller;

use App\Form\IndexType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(Request $request, SessionInterface $session): Response
    {
        $form = $this->createForm(IndexType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $name = $data["name"];
            $session->set('name', $name);
            return $this->redirectToRoute("app_chat");
        }
        return $this->render('index/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
