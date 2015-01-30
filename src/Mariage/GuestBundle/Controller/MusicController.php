<?php

namespace Mariage\GuestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Mariage\GuestBundle\Entity\Music;
use Mariage\GuestBundle\Form\MusicType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class MusicController extends Controller
{
    public function musicAction()
    {
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('MariageGuestBundle:Music')
        ;
        $listMusics = $repository->findBy(array(), array('artist'=>'asc', 'title'=>'asc'));

        return $this->render('MariageGuestBundle:Music:music.html.twig', array(
            'listMusics' => $listMusics,
            'nbMusics' => count($listMusics)
        ));
    }

    public function addMusicAction(Request $request)
    {
        $music = new Music();
        $form = $this->get('form.factory')->create(new MusicType(), $music);

        if ($form->handleRequest($request)->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($music);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Musique enregistrée.');

            return $this->redirect($this->generateUrl('mariage_guest_music'));
        }

        return $this->render('MariageGuestBundle:Music:add_music.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function removeMusicAction(Music $music)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($music);
        $em->flush();

        return $this->redirect($this->generateUrl('mariage_guest_music'));
    }


    /**
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editGuestAction(Music $music)
    {
        $form = $this->get('form.factory')->create(new MusicType(), $music);
        $request = $this->get('request');

        if ($form->handleRequest($request)->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($music);
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'Musique bien modifiée.');

            return $this->redirect($this->generateUrl('mariage_guest_music'
            ));
        }

        return $this->render('MariageGuestBundle:Music:add_music.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
