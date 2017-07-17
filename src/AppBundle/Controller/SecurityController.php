<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 14-07-2017
 * Time: 13:41
 */

// src/AppBundle/Controller/SecurityController.php
namespace AppBundle\Controller;

use AppBundle\Form\LoginForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request, AuthenticationUtils $authUtils)
    {
        // get the login error if there is one
        $error = $authUtils->getLastAuthenticationError();

        $lastRUT = $authUtils->getLastUsername();
        $form = $this->createForm(LoginForm::class, [
            '_rut' => $lastRUT,
        ]);
        // last username entered by the user


        return $this->render('security/login.html.twig', array(
            'form' => $form->createView(),
            'error'    => $error,
        ));
    }
}