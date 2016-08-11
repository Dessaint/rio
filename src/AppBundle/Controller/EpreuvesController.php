<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Epreuves;
use AppBundle\Form\EpreuvesType;

/**
 * Epreuves controller.
 *
 */
class EpreuvesController extends Controller
{
    /**
     * Lists all Epreuves entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $epreuves = $em->getRepository('AppBundle:Epreuves')->findAll();

        return $this->render('epreuves/index.html.twig', array(
            'epreuves' => $epreuves,
        ));
    }

    /**
     * Creates a new Epreuves entity.
     *
     */
    public function newAction(Request $request)
    {
        $epreufe = new Epreuves();
        $form = $this->createForm('AppBundle\Form\EpreuvesType', $epreufe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($epreufe);
            $em->flush();

            return $this->redirectToRoute('epreuves_show', array('id' => $epreufe->getId()));
        }

        return $this->render('epreuves/new.html.twig', array(
            'epreufe' => $epreufe,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Epreuves entity.
     *
     */
    public function showAction(Epreuves $epreufe)
    {
        $deleteForm = $this->createDeleteForm($epreufe);

        return $this->render('epreuves/show.html.twig', array(
            'epreufe' => $epreufe,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Epreuves entity.
     *
     */
    public function editAction(Request $request, Epreuves $epreufe)
    {
        $deleteForm = $this->createDeleteForm($epreufe);
        $editForm = $this->createForm('AppBundle\Form\EpreuvesType', $epreufe);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($epreufe);
            $em->flush();

            return $this->redirectToRoute('epreuves_edit', array('id' => $epreufe->getId()));
        }

        return $this->render('epreuves/edit.html.twig', array(
            'epreufe' => $epreufe,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Epreuves entity.
     *
     */
    public function deleteAction(Request $request, Epreuves $epreufe)
    {
        $form = $this->createDeleteForm($epreufe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($epreufe);
            $em->flush();
        }

        return $this->redirectToRoute('epreuves_index');
    }

    /**
     * Creates a form to delete a Epreuves entity.
     *
     * @param Epreuves $epreufe The Epreuves entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Epreuves $epreufe)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('epreuves_delete', array('id' => $epreufe->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
