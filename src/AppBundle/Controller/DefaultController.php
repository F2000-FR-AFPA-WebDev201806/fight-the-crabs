<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use AppBundle\Model\Board;

class DefaultController extends Controller {

    /**
     * @Route("/game", name="game")
     */
    public function gameAction(Request $request) {
        // Vérification de la session
        if ($request->getSession()->has('board')) {
            // Lecture de la session
            $oBoard = $request->getSession()->get('board');
        } else {
            // Enregistrement en session
            $oBoard = new Board;
            $request->getSession()->set('board', $oBoard);
        }

        return $this->render('@App/Default/game.html.twig', [
                    'board' => $oBoard,
        ]);
    }

    /**
     * @Route("/game/play/{x}/{y}", name="game_play")
     */
    public function playAction(Request $request, $x, $y) {
        // Modifier la case (x, y)
        // Récupérer le jeu en session
        if ($request->getSession()->has('board')) {
            $oBoard = $request->getSession()->get('board');

            // Est-ce que la case vide ?
            //Appel fonction nextPlayer
            if ($oBoard->play($x, $y)) {
                if (!$oBoard->isWin()) {
                    $oBoard->nextPlayer();
                }

                // Enregistrement en session
                $request->getSession()->set('board', $oBoard);

                return $this->render('@App/Default/board.html.twig', [
                            'board' => $oBoard,
                ]);
            }
        }

        return new Response();
    }

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction() {
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
