<?php

namespace Eshop\Controller;

use Eshop\Repository\UserManager;
use Simplex\Service\Form;
use Simplex\Templating;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController
{
    public function register(Request $request): Response
    {
        if (isset($_SESSION) && isset($_SESSION['security']) && $_SESSION['security']['isLoggedIn']) {
            header('Location: /');
            exit;
        }

        if ($request->getMethod() === Request::METHOD_POST) {

            $user = Form::handleSubmit($request);

            (new UserManager())->create($user);
            header('Location: /');
            exit;
        }

        $templating = new Templating();

        return new Response(
            $templating->render('Eshop::register.php', []),
            Response::HTTP_OK,
            ['content-type' => 'text/html']
        );
    }

    public function login(Request $request): Response
    {
        if (isset($_SESSION) && isset($_SESSION['security']) && $_SESSION['security']['isLoggedIn']) {
            header('Location: /');
            exit;
        }

        if ($request->getMethod() === Request::METHOD_POST) {
            $submittedData = Form::handleSubmit($request);
            $user = (new UserManager())->findByEmail($submittedData->getEmail());

            if (!$user) {
                header('Location: /login?no-user');
                exit;
            }

            if ($user->verifyPassword($submittedData->getPassword())) {
                $_SESSION['security'] = [
                    'user' => $user,
                    'isLoggedIn' => true
                ];
                header('Location: /');
                exit;
            }
        }

        $templating = new Templating();
        return new Response(
            $templating->render('Eshop::login.php', [])
        );
    }

    public function logout()
    {
        if (!isset($_SESSION['security'])) {
            exit;
        }

        unset($_SESSION['security']);
        header('Location: /');
    }

    public function update(Request $request): Response
    {
        if (isset($_SESSION) && isset($_SESSION['security']) && $_SESSION['security']['isLoggedIn']) {
            if ($request->getMethod() === Request::METHOD_POST) {
                $profile = Form::handleSubmit($request);
                $profile->setId($_SESSION['security']['user']->getId());

                if ($profile->getPassword() === "") {
                    $profile->setEncryptedPassword($_SESSION['security']['user']->getEncryptedPassword());
                }
                (new UserManager())->updateProfile($profile);
                $_SESSION['security']['user'] = $profile;
            }

            $templating = new Templating();
            return new Response(
                $templating->render('Eshop::updateProfile.php', ['profileToUpdate' => $_SESSION['security']['user']]),
                Response::HTTP_OK,
                ['content-type' => 'text/html']
            );
        }
    }
}
