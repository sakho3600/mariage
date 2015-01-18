<?php

namespace Mariage\PresentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Mariage\PresentBundle\Entity\Vote;


class PresentController extends Controller
{
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getManager()
            ->getRepository('MariagePresentBundle:Vote');

        $listIrlande = $repository->findBy(
            array('country' => 'irlande')
        );

        $listFinlande = $repository->findBy(
            array('country' => 'finlande')
        );

        if( count($listIrlande) > 0 && count($listFinlande) > 0 )
        {
            $rateIrlande = (count($listIrlande) / (count($listFinlande) + count($listIrlande))) * 100;
            $rateFinlande = (count($listFinlande) / (count($listFinlande) + count($listIrlande))) * 100;
        }
        else
        {
            $rateIrlande = 50;
            $rateFinlande = 50;
        }

        return $this->render('MariagePresentBundle:Present:index.html.twig',
            array(
                'rateIrlande' => $rateIrlande,
                'rateFinlande' => $rateFinlande
        ));
    }

    public function voteForCountryAction($id)
    {
        $vote = new Vote($id, $_SERVER['REMOTE_ADDR']);

        $em = $this->getDoctrine()->getManager();
        $em->persist($vote);
        $em->flush();

        return $this->redirect($this->generateUrl('mariage_present_homepage'));
    }

}
