<?php

namespace Mariage\GuestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GuestController extends Controller
{
    public function indexAction()
    {
        return $this->render('MariageGuestBundle:Guest:guest.html.twig'
        );
    }
}
