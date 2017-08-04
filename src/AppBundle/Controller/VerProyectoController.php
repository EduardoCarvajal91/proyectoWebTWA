<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Proyecto;
//use AppBundle\Entity\Persona;
use AppBundle\Form\ArchivoForm;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class VerProyectoController extends Controller
{
    /**
     * @Route("/proyecto/{nombre}", name="ver_proyecto")
     */
    public function indexAction($nombre)
    {
        $em = $this->getDoctrine()->getRepository(Proyecto::class);
        $proyecto = $em->findOneBy(array('nombre' => $nombre));
        $personas = $proyecto->getPersonas();

        $form = $this->createForm(ArchivoForm::class, null, array(
                                    'action' => $this->generateUrl('nuevo_archivo')
        ));
        $form->get('proyecto')->setData($proyecto->getId());

        //Obtener archivos del proyecto
        $archivos = $proyecto->getArchivosProyecto();

        return $this->render('default/proyecto.html.twig',
            array('proyecto' => $proyecto,
                  'personas' => $personas,
                  'archivos' => $archivos,
                  'form' => $form->createView()));
    }
}
