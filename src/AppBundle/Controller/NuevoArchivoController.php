<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

use AppBundle\Entity\Archivo;
use AppBundle\Entity\Estado;
use AppBundle\Entity\PersonaProyecto;
use AppBundle\Entity\Proyecto;
use AppBundle\Form\ArchivoForm;

class NuevoArchivoController extends Controller
{
    /**
     * @Route("/nuevo_archivo", name="nuevo_archivo")
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm(ArchivoForm::class, null,
            array('action' => $this->generateUrl('nuevo_archivo'))
        );

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            //TODO: revisar que el archivo no exista

            $em = $this->getDoctrine()->getRepository(Estado::class);
            $estado = $em->findOneBy(array('nombre' => 'Borrador'));
            $personaProyecto = getPersonaProyecto($form->get('proyecto')->getData());

            $archivo = new Archivo();
            $archivo->setArchivoFile($form->get('archivo')->getData());
            $archivo->setEstado($estado);
            $archivo->setPersonaProyecto($personaProyecto);

            $em = $this->getDoctrine()->getManager();
            $em->persist($archivo);
            $em->flush();
        }

        $referer = $request->headers->get('referer');
        return new RedirectResponse($referer);
    }

    /**
     * Get PersonaProyecto for this user
     *
     * @param int $proyectoId
     *
     * @return PersonaProyecto
     */
    private function getPersonaProyecto($proyectoId)
    {
        $em = $this->getDoctrine()->getRepository(Proyecto::class);
        $proyecto = $em->find($proyectoId);
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getRepository(PersonaProyecto::class);
        return $em->findOneBy(array('persona' => $user, 'proyecto' => $proyecto));
    }
}
