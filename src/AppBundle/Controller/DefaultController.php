<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class DefaultController extends Controller {

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request) {
        // replace this example code with whatever you need
        return $this->render('@App/Default/index.html.twig', [
        ]);
    }

    /**
     * @Route("/inscription", name="inscription")
     */
    public function inscriptionAction(Request $request) {
        $oUser = new \AppBundle\Entity\User;

        $oForm = $this->createFormBuilder($oUser)
                ->add('login', TextType::Class)
                ->add('password', PasswordType::class)
                ->getForm();

        $oForm->handleRequest($request);
        if ($oForm->isSubmitted() && $oForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($oUser);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('@App/Default/inscription.html.twig', [
                    'form' => $oForm->createView(),
        ]);
    }

}
