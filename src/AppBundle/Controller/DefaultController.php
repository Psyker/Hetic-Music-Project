<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Sound;
use AppBundle\Entity\Video;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..'),
        ]);
    }

    /**
     * @Route("/start", name="start")
     */
    public function listAction(Request $request)
    {
        $videoRepository = $this->getDoctrine()->getRepository('AppBundle:Video');
        $video = $videoRepository->findAll();
        $soundRepository = $this->getDoctrine()->getRepository('AppBundle:Sound');
        $sound = $soundRepository->findAll();
        return $this->render('default/start.html.twig', array(
            'videos' => $video,
            'sounds' => $sound
        ));
    }
}
