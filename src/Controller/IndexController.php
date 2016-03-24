<?php

namespace Grigoros\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Grigoros\Application;
use Doctrine\DBAL\Connection;

/**
 * Description of IndexController
 *
 * @author Diego de Biagi <diegobiagiviana@gmail.com>
 */
class IndexController {

    public function indexAction(Application $app, Request $request) {
        $data = [
            'title' => 'Users Table',
            'collection' => []
        ];

        /* @var $faker \Faker\Generator */
        $faker = $app['faker'];

        $rand = rand(10, 20);

        for($i = 1; $i <= $rand; $i++){
            $user = [
                'id' => $i,
                'name' => $faker->name,
                'email' => $faker->email,
                'city' => $faker->city,
                'company' => $faker->company
            ];

            $data['collection'][] = $user;
        }

        $view = $app['twig']->render('Pages/index.html.twig', ['users' => $data]);

        return new Response($view, 200);
    }

}
