<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/test")
 */
class TestController extends AbstractController
{
    /**
     * @Route(
     *     "/authorize",
     *     name="test_authorize",
     *     methods={"GET", "POST"}
     * )
     */
    public function authorize()
    {
        return $this->json([
            'message' => 'Route authorisé !',
            'path' => 'src/Controller/TestController.php',
        ]);
    }

    /**
     * @Route(
     *     "/unauthorize",
     *     name="test_unauthorize",
     *     methods={"GET", "POST"}
     * )
     */
    public function unauthorize()
    {
        return $this->json([
            'message' => 'Route non authorisé !',
            'path' => 'src/Controller/TestController.php',
        ]);
    }
}
