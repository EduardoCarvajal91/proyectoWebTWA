<?php

namespace AppBundle\Controller;
use AppBundle\Entity\Proyecto;
use AppBundle\Entity\Persona;
use AppBundle\Form\ProyectoForm;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class NuevoProyectoController extends Controller
{
    /**
     * @Route("/nuevo_proyecto", name="nuevo_proyecto")
     */
    public function indexAction(Request $request)
    {
        $proyecto = new Proyecto();
        $form = $this->createForm(ProyectoForm::class, $proyecto);

        $form->handleRequest($request);
        $personas = array();
        if ($form->isSubmitted() && $form->isValid())
        {
            $personas = $this->getPersonas($form);
            $proyecto->setPersonas($personas);

            $em = $this->getDoctrine()->getManager();
            $em->persist($proyecto);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render(
            'default/nuevo_proyecto.html.twig',
            array('form' => $form->createView())
        );
    }

    private function getPersonas($data)
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }

        $user = $this->get('security.token_storage')->getToken()->getUser();

        $personas = array();
        //Director
        $personas[] = $user;


        $em = $this->getDoctrine()->getRepository(Persona::class);

        //Trabajadores
        for ($i=1; $i<=3; $i++)
            $this->addPersona($data, 'trab'.$i, $personas, $em);

        //Responsable legal
        $this->addPersona($data, 'resp_legal', $personas, $em);

        return $personas;
    }

    private function addPersona($data, $nombre, &$personas, $em)
    {
        $rut = $data->get($nombre)->getData();
        if (empty($rut))
            return;

        $trab = $em->findOneBy(array('rut' => $rut));
        if (isset($trab))
            $personas[] = $trab;
    }

    private function getPersonasForm($form)
    {
        $personas = array();
        for ($i=1; $i<=3; $i++)
            $personas[] = $form->get('trab'.$i)->getData();

        $personas[] = $form->get('resp_legal')->getData();

        return $personas;
    }
}
