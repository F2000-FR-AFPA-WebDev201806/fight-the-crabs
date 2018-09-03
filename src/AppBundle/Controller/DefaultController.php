<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class DefaultController extends Controller {

    /**
     * @Route("/game", name="game")
     */
    public function gameAction() {
        $aTab1 = [
            [1, 2, 3],
            [4, 5, 6],
            [7, 8, 9],
        ];
        dump($aTab1);

        return $this->render('@App/Default/game.html.twig', [
                    'grid' => $aTab1,
        ]);
    }

    /**
     * @Route("/game/play/{x}/{y}", name="game_play")
     */
    public function playAction($x, $y) {
        // Modifier la case (x, y)


        return new \Symfony\Component\HttpFoundation\JsonResponse([$x, $y]);
    }

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction() {
        // replace this example code with whatever you need
        return $this->render('@App/Default/index.html.twig', [
        ]);
    }

    /**
     * @Route("/connexion", name="connexion")
     */
    public function connexionAction(AuthenticationUtils $authenticationUtils) {
        $error = $authenticationUtils->getLastAuthenticationError();
        dump($error);

        $oUser = new \AppBundle\Entity\User;

        $oForm = $this->createFormBuilder($oUser)
                ->add('login', TextType::Class)
                ->add('password', PasswordType::class)
                ->getForm();

        // replace this example code with whatever you need
        return $this->render('@App/Default/connexion.html.twig', [
                    'form' => $oForm->createView(),
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

    /**
     * @Route("/deconnexion", name="deconnexion")
     */
    public function deconnexionAction() {

    }

}
