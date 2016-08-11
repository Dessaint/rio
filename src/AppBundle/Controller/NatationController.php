<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Epreuves;
use AppBundle\Entity\Participants;

class NatationController extends Controller
{
    /**
     * @Route("/test", name="test")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();


        $epreuves = $em->getRepository('AppBundle:Epreuves')->findAll();

        $participants = $em->getRepository('AppBundle:Participants')->findAll();

        return $this->render('default/natation.html.twig', array(
            'epreuves' => $epreuves,
            'participants' => $participants
        ));
    }
}
