<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class MisProyectosController extends Controller
{
    /**
     * @Route("/mis_proyectos", name="mis_proyectos")
     */
    public function indexAction()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $proyectos = $user->getProyectos();

        return $this->render('default/mis_proyectos.html.twig', array('proyectos' => $proyectos));
    }
}
