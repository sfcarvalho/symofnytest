<?php

namespace ChamadosBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ChamadosBundle\Entity\Pedidos;
use ChamadosBundle\Form\PedidosType;

/**
 * Pedidos controller.
 *
 * @Route("/pedidos")
 */
class PedidosController extends Controller
{
    /**
     * Lists all Pedidos entities.
     *
     * @Route("/", name="pedidos_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pedidos = $em->getRepository('ChamadosBundle:Pedidos')->findAll();

        return $this->render('pedidos/index.html.twig', array(
            'pedidos' => $pedidos,
        ));
    }

    /**
     * Creates a new Pedidos entity.
     *
     * @Route("/new", name="pedidos_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $pedido = new Pedidos();
        $form = $this->createForm('ChamadosBundle\Form\PedidosType', $pedido);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pedido);
            $em->flush();

            return $this->redirectToRoute('pedidos_show', array('id' => $pedido->getId()));
        }

        return $this->render('pedidos/new.html.twig', array(
            'pedido' => $pedido,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Pedidos entity.
     *
     * @Route("/{id}", name="pedidos_show")
     * @Method("GET")
     */
    public function showAction(Pedidos $pedido)
    {
        $deleteForm = $this->createDeleteForm($pedido);

        return $this->render('pedidos/show.html.twig', array(
            'pedido' => $pedido,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Pedidos entity.
     *
     * @Route("/{id}/edit", name="pedidos_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Pedidos $pedido)
    {
        $deleteForm = $this->createDeleteForm($pedido);
        $editForm = $this->createForm('ChamadosBundle\Form\PedidosType', $pedido);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pedido);
            $em->flush();

            return $this->redirectToRoute('pedidos_edit', array('id' => $pedido->getId()));
        }

        return $this->render('pedidos/edit.html.twig', array(
            'pedido' => $pedido,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Pedidos entity.
     *
     * @Route("/{id}", name="pedidos_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Pedidos $pedido)
    {
        $form = $this->createDeleteForm($pedido);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pedido);
            $em->flush();
        }

        return $this->redirectToRoute('pedidos_index');
    }

    /**
     * Creates a form to delete a Pedidos entity.
     *
     * @param Pedidos $pedido The Pedidos entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Pedidos $pedido)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pedidos_delete', array('id' => $pedido->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
