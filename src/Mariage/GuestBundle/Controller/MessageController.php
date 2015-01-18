<?php

namespace Mariage\GuestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Mariage\GuestBundle\Entity\Message;
use Mariage\GuestBundle\Form\MessageType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class MessageController extends Controller
{
    public function addMessageAction(Request $request)
    {
        $message = new Message();
        $form = $this->get('form.factory')->create(new MessageType(), $message);

        if ($form->handleRequest($request)->isValid())
        {
            $message->setDate(new \DateTime() );
            $message->setObject("[Mariage] Confirmation venue de l'invité : " . $message->getFirstname() );
            //$em = $this->getDoctrine()->getManager();
            //$em->persist($message);
            //$em->flush();
            $this->sendMyMessage($message);
            $request->getSession()->getFlashBag()->add('notice', 'Message envoyé.');

            return $this->redirect($this->generateUrl('homepage'
            ));
        }

        return $this->render('MariageGuestBundle:Message:add_message.html.twig', array(
            'form' => $form->createView(),
        ));
    }


    private function sendMyMessage(Message $message)
    {
        $mail = \Swift_Message::newInstance();
        $mail->setSubject( $message->getObject() );
        $mail->setFrom($this->container->getParameter('mailer_user')); //get user email in parameters.yml
        //$mail->setFrom('iggiotti.florian@neuf.fr');
        $mail->setTo('iggiotti.florian@gmail.com');
        $mail->setBody($message->getBody() );

        $this->get('mailer')->send($mail);
    }
}
