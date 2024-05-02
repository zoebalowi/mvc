<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class LuckyControllerJson extends AbstractController
{
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    #[Route("/api", name: 'api_index')]
    public function index(): Response
    {
        $routes = [
            'lucky-number' => '/api/lucky/number',
            'quote' => '/api/quote',
        ];

        $html = $this->twig->render('api.html.twig', ['routes' => $routes]);

        return new Response($html);

    }

    #[Route("/api/lucky/number", name: 'jsonNumber')]
    public function jsonNumber(): Response
    {
        $number = random_int(0, 100);

        $data = [
            'lucky-number' => $number,
            'lucky-message' => 'Hi there!',
        ];

        // return new JsonResponse($data);

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route("/api/quote", name: 'quote')]
    public function quote(): Response
    {
        $quotes = [
            "tjofljöt vilket väder!",
            "Rid på vågen.",
            "äpplet faller inte långt från trädet.."
        ];

        $randomQuote = $quotes[array_rand($quotes)];

        $data = [
            'quote' => $randomQuote,
            'date' => date('Y-m-d'),
            'timestamp' => time()
        ];

        return new JsonResponse($data);
    }
}
