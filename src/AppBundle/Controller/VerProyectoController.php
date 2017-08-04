<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Proyecto;
use AppBundle\Entity\Persona;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class VerProyectoController extends Controller
{
    /**
     * @Route("/proyecto/{slug}", name="ver_proyecto")
     */
    public function indexAction($slug)
    {
        $em = $this->getDoctrine()->getRepository(Proyecto::class);
        $proyecto = $em->findOneBy(array('nombre' => $slug));
        $personas = $proyecto->getPersonas();
        return $this->render('default/proyecto.html.twig',
            array('proyecto' => $proyecto,
                  'personas' => $personas));
    }
}
