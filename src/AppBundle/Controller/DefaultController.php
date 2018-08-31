<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

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
     * @Route("/game", name="game")
     */
    public function gameAction(Request $request) {
        //$oRepoGrid = $this->getDoctrine()->getRepository('AppBundle:Grid');
        //$aGrid = $oGrid->findAll();
        //dump($aGrid);
        $aTab1 = [
            [1, 2, 3],
            [4, 5, 6],
            [7, 8, 9],
        ];
        dump($aTab1);
        //require_once '/path/to/vendor/autoload.php' ;
        // replace this example code with whatever you need
        return $this->render('@App/Default/game.html.twig', [
                    'grid' => $aTab1,
        ]);
    }

    /**
     * @Route("/inscription", name="inscription")
     */
    public function inscriptionAction(Request $request) {
        // replace this example code with whatever you need
        return $this->render('@App/Default/game.html.twig', [
        ]);
    }

}
