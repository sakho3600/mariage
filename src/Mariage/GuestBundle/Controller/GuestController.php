<?php

namespace Mariage\GuestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Mariage\GuestBundle\Entity\Guest;
use Mariage\GuestBundle\Form\GuestType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class GuestController extends Controller
{
    public function indexAction()
    {
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('MariageGuestBundle:Guest')
        ;
        $listGuests = $repository->findBy(array(), array('family'=>'asc', 'firstname'=>'asc'));

        return $this->render('MariageGuestBundle:Guest:guest.html.twig', array(
            'listGuests' => $listGuests,
            'nbGuests' => count($listGuests)
        ));
    }


    /**
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function addGuestAction(Request $request)
    {
        $guest = new Guest();
        $form = $this->get('form.factory')->create(new GuestType(), $guest);

        if ($form->handleRequest($request)->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($guest);
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'Invité bien enregistrée.');

            return $this->redirect($this->generateUrl('mariage_guest_homepage'
            ));
        }

        return $this->render('MariageGuestBundle:Guest:add_guest.html.twig', array(
            'form' => $form->createView(),
        ));
    }


    /**
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function removeGuestAction(Guest $guest)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($guest);
        $em->flush();

        return $this->redirect($this->generateUrl('mariage_guest_homepage', array(
                'id' => $guest->getId())
        ));
    }


    /**
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editGuestAction(Guest $guest)
    {
        $form = $this->get('form.factory')->create(new GuestType(), $guest);
        $request = $this->get('request');

        if ($form->handleRequest($request)->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($guest);
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'Invité bien modifié.');

            return $this->redirect($this->generateUrl('mariage_guest_homepage'
            ));
        }

        return $this->render('MariageGuestBundle:Guest:add_guest.html.twig', array(
            'form' => $form->createView(),
        ));
    }


    public function historyAction()
    {
        return $this->render('MariageGuestBundle:Guest:history.html.twig'
        );
    }

    public function organizationAction()
    {
        return $this->render('MariageGuestBundle:Guest:organization.html.twig'
        );
    }

}
