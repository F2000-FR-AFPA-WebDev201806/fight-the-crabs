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
        if ($request->getSession()->has('grid')) {
            $aGrid = $request->getSession()->get('grid');
            $iCurrentPlayer = $request->getSession()->get('current_player');
        } else {
            $aGrid = [
                ['', '', ''],
                ['', '', ''],
                ['', '', ''],
            ];
            $iCurrentPlayer = Board::PLAYER_CROSS;

            // Enregistrement en session
            $request->getSession()->set('grid', $aGrid);
            $request->getSession()->set('current_player', $iCurrentPlayer);
        }

        return $this->render('@App/Default/game.html.twig', [
                    'grid' => $aGrid,
                    'player' => $iCurrentPlayer,
        ]);
    }

    /**
     * @Route("/game/play/{x}/{y}", name="game_play")
     */
    public function playAction(Request $request, $x, $y) {
        // Modifier la case (x, y)
        // Récupérer le jeu en session
        if ($request->getSession()->has('grid')) {
            $aGrid = $request->getSession()->get('grid');
            $iCurrentPlayer = $request->getSession()->get('current_player');

            // Est-ce que la case vide ?
            if (empty($aGrid[$y][$x])) {
                // Mettre le pion correspondant au joueur actuelle
                // Passer au joueur suivant
                switch ($iCurrentPlayer) {
                    case Board::PLAYER_CROSS:
                        $aGrid[$y][$x] = 'fas fa-times';
                        $iCurrentPlayer = Board::PLAYER_CIRCLE;
                        break;

                    case Board::PLAYER_CIRCLE:
                        $aGrid[$y][$x] = 'fas fa-circle';
                        $iCurrentPlayer = Board::PLAYER_CROSS;
                        break;
                }

                // Enregistrement en session
                $request->getSession()->set('grid', $aGrid);
                $request->getSession()->set('current_player', $iCurrentPlayer);

                return $this->render('@App/Default/board.html.twig', [
                            'grid' => $aGrid,
                            'player' => $iCurrentPlayer,
                ]);
            }
        }

        return new Response();
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
