<?php

namespace ChamadosBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ChamadosBundle\Entity\Sac;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ChamadosBundle\Form\SacType;


class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction(Request $request)
    {

      $chamado = new Sac();
      $form = $this->createForm('ChamadosBundle\Form\SacType', $chamado);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
        return $this->redirectToRoute('buscaResult', array('id' => $request->request->get('sac')['numero_pedido']));
      }

      return $this->render('ChamadosBundle:Default:busca.html.twig', array(
        'chamado' => $chamado,
        'form' => $form->createView(),
      ));
    }
}
