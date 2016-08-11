<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Epreuves;
use AppBundle\Entity\Participants;
use AppBundle\Form\ParticipantsType;

/**
 * Participants controller.
 *
 */
class ParticipantsController extends Controller
{
    /**
     * Lists all Participants entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $participants = $em->getRepository('AppBundle:Participants')->findAll();

        return $this->render('participants/index.html.twig', array(
            'participants' => $participants,
        ));
    }

    /**
     * Creates a new Participants entity.
     *
     */
    public function newAction(Request $request)
    {
        $participant = new Participants();
        $form = $this->createForm('AppBundle\Form\ParticipantsType', $participant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            // $epr = $participant->getEpreuve();
            // $epreuve = $em->getRepository('AppBundle:Epreuves')->findOneById($epr);
            // $besoin->setEpreuve($epreuve);
                

            $em->persist($participant);
            $em->flush();

            return $this->redirectToRoute('participants_show', array('id' => $participant->getId()));
        }

        return $this->render('participants/new.html.twig', array(
            'participant' => $participant,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Participants entity.
     *
     */
    public function showAction(Participants $participant)
    {
        $deleteForm = $this->createDeleteForm($participant);

        return $this->render('participants/show.html.twig', array(
            'participant' => $participant,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Participants entity.
     *
     */
    public function editAction(Request $request, Participants $participant)
    {
        $deleteForm = $this->createDeleteForm($participant);
        $editForm = $this->createForm('AppBundle\Form\ParticipantsType', $participant);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($participant);
            $em->flush();

            return $this->redirectToRoute('participants_edit', array('id' => $participant->getId()));
        }

        return $this->render('participants/edit.html.twig', array(
            'participant' => $participant,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Participants entity.
     *
     */
    public function deleteAction(Request $request, Participants $participant)
    {
        $form = $this->createDeleteForm($participant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($participant);
            $em->flush();
        }

        return $this->redirectToRoute('participants_index');
    }

    /**
     * Creates a form to delete a Participants entity.
     *
     * @param Participants $participant The Participants entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Participants $participant)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('participants_delete', array('id' => $participant->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
