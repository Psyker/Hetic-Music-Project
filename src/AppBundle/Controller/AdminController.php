<?php

namespace AppBundle\Controller;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\User;
use AppBundle\Form\VideoType;
use AppBundle\Entity\Video;
use AppBundle\Entity\Sound;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Tests\Extension\Core\Type\CheckboxTypeTest;
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

    /**
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="homeAdmin")
     */
    public function indexAction()
    {
        return $this->render('admin/default/index.html.twig');
    }

    /**
     * @Route("/videos", name="videosList")
     */
    public function showListVideoAction()
    {
        $videos = $this->getDoctrine()->getRepository('AppBundle:Video')->findAll();
        return $this->render('admin/videos/video.html.twig', ['videos' => $videos]);
    }

    /**
     * @Route("/video/edit/{id}", name="editVideo")
     * @Method({"GET"})
     */
    public function editProjectAction(Request $request, Video $video, Sound $sound)
    {

        if (!$video) throw $this->createNotFoundException('Le projet n\'a pas été trouvé');
        return $this->render('admin/videos/edit.html.twig', [
            'video' => $video,
            'sounds' => $sound
        ]);
    }

    /**
     * @Route("/video/delete/{id}", name="deletePostVideo")
     * @Method({"POST"})
     */
    public function deletePostProject(Request $request, Video $video)
    {
        if (!$video) throw $this->createNotFoundException('La video n\'a pas été trouvé');
        $em = $this->getDoctrine()->getManager();
        $em->remove($video);
        $em->flush();
        $this->addFlash("success", "La video a bien été supprimée !");
        return $this->redirectToRoute("videosList");
    }

    /**
     * @Route("/video/edit/{id}", name="editPostVideo")
     * @Method({"POST"})
     */
    public function editPostVideoAction(Request $request, Video $video, Sound $sound)
    {
        if (!$video) throw $this->createNotFoundException('La video n\'a pas été trouvé');
        $video->setName($request->get('name'));
        $video->setDescription($request->get('description'));
        $video->setRealisateur($request->get('realisateur'));
        $video->setUrlVideo($request->get('url'));

        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('videosList', ['video' => $video]);
    }

    /**
     * @Route("/video/add", name="addVideo")
     */
    public function addVideo(Request $request)
    {
        $video = new Video();
        $form = $this->createForm(VideoType::class, $video);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($video);
            $em->flush();
            $this->addFlash('success', "<strong>Congratulations !</strong><br>Your video has been successfully added.");
            return $this->redirectToRoute('videosList');
        }
        return $this->render('admin/addvideo.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/sounds", name="soundsList")
     */
    public function showListSoundAction()
    {
        $sounds = $this->getDoctrine()->getRepository('AppBundle:Sound')->findAll();
        return $this->render('admin/sounds/sound.html.twig', ['sounds' => $sounds]);
    }

    /**
     * @Route("/sound/edit/{id}", name="editSound")
     * @Method({"GET"})
     */
    public function editSoundAction(Request $request, Sound $sound)
    {
        if (!$sound) throw $this->createNotFoundException('Le projet n\'a pas été trouvé');
        return $this->render('admin/sounds/edit.html.twig', ['sound' => $sound]);
    }

    /**
     * @Route("/sound/delete/{id}", name="deletePostSound")
     * @Method({"POST"})
     */
    public function deletePostSound(Request $request, Sound $sound)
    {
        if (!$sound) throw $this->createNotFoundException('Le son n\'a pas été trouvé');
        $em = $this->getDoctrine()->getManager();
        $em->remove($sound);
        $em->flush();
        $this->addFlash("success", "Le son a bien été supprimée !");
        return $this->redirectToRoute("soundsList");
    }




}
