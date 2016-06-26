<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\User;
use AppBundle\Entity\Video;
use AppBundle\Entity\Sound;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class AdminController
 * @package AppBundle\Controller
 * @Route("/admin", name="administration")
 * @Security("has_role('ROLE_ADMIN')")
 */
class AdminController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('admin/default/index.html.twig', array('name' => $name));
    }

    /**
     * @Route("/videos", name="videosList")
     */
    public function showListProjectAction(){
        $videos = $this->getDoctrine()->getRepository('AppBundle:Video')->findAll();
        return $this->render('admin/videos/video.html.twig', ['videos' => $videos]);
    }
}
