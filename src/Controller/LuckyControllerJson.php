<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LuckyControllerJson
{
    
    #[Route("/api", name: 'api_index')]
    public function index(): Response
    {
        $routes = [
            'lucky-number' => '/api/lucky/number',
            'quote' => '/api/quote',
            // Lägg till fler JSON rutter här
        ];
        $html = '<!DOCTYPE html>';
        $html .= '<html lang="en">';
        $html .= '<head>';
        $html .= '<meta charset="UTF-8">';
        $html .= '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
        $html .= '<title>API Endpoints</title>';
        $html .= '</head>';
        $html .= '<body>';
        $html .= '<h1>API Endpoints</h1>';
        $html .= '<ul>';
        foreach ($routes as $name => $route) {
            $html .= '<li><a href="' . $route . '">' . $name . '</a></li>';
        }
        $html .= '</ul>';
        $html .= '</body>';
        $html .= '</html>';

        return new Response($html);
    }

    #[Route("/api/lucky/number")]
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

    #[Route("/api/quote")]
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

