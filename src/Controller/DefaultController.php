<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @Route("/{pages}", name="pages")
     */
    public function index() : Response {
        return $this->render('views/index.html.twig');
    }

    /**
     * @Route("/api/video", name="video")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function video() {
        $videos = [
            [
                "name" => "Кабинет директора",
                "id" => 1,
                "link" => "https://multiplatform-f.akamaihd.net/i/multi/april11/sintel/sintel-hd_,512x288_450_b,640x360_700_b,768x432_1000_b,1024x576_1400_m,.mp4.csmil/master.m3u8"
            ],
            [
                "name" => "Хол",
                "id" => 2,
                "link" => "https://multiplatform-f.akamaihd.net/i/multi/will/bunny/big_buck_bunny_,640x360_400,640x360_700,640x360_1000,950x540_1500,.f4v.csmil/master.m3u8"
            ],
            [
                "name" => "Столовая",
                "id" => 3,
                "link" => "https://cph-p2p-msl.akamaized.net/hls/live/2000341/test/master.m3u8"
            ]
        ];
        return $this->json($videos);
    }
}