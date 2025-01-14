<?php

namespace App\Controller;

use Symfony\Component\Mercure\Update;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;

class ChatController extends AbstractController
{
    #[Route('/chat', name: 'app_chat')]
    public function index(SessionInterface $session): Response
    {
        if (!$session->get("name")) {
            return $this->redirectToRoute("app_index");
        }
        $name = $session->get("name");
        return $this->render('chat/index.html.twig', [
            'name' => $name,
        ]);
    }

    #[Route('/chat/send', name: 'app_chat_send', methods: ['POST'])]
    public function sendMessage(Request $request, HubInterface $hub, SessionInterface $session): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $message = $data['message'];

        $topic = 'https://example.com/my-private-topic';

        $update = new Update($topic, json_encode([
            'message' => $message,
            'from' => $session->get("name"),
            'time' => date('Y-m-d H:i:s'),
        ]));

        $hub->publish($update);

        return new JsonResponse(['success' => true]);
    }
}
