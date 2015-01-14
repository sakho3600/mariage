<?php

namespace Mariage\GuestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Mariage\GuestBundle\Entity\Message;
use Mariage\GuestBundle\Form\MessageType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class MessageController extends Controller
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

    public function addMessageAction(Request $request)
    {
        $message = new Message();
        $form = $this->get('form.factory')->create(new MessageType(), $message);

        if ($form->handleRequest($request)->isValid())
        {
            $message->setDate(new \DateTime() );
            //$em = $this->getDoctrine()->getManager();
            //$em->persist($guest);
            //$em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'Message envoyé.');

            return $this->redirect($this->generateUrl('mariage_guest_homepage'
            ));
        }

        return $this->render('MariageGuestBundle:Message:add_message.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    private function sendMyMessage($message)
    {
        
    }
}
