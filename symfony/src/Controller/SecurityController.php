<?php

/**
 * Best Practices présentes dans le fichier :
 *
 * - Respect des standards SF
 * - (PHP7) typage du retour des méthodes
 * - injection des services dans le constructeur de la classe ou dans le contrôleur (absence de $this->get())
 * - préfixe "app_" des noms de routes liées à l'Application
 * - le nom de la classe est cohérent avec les contrôleurs qu'elle contient
 */

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    protected $authenticationUtils;

    public function __construct(AuthenticationUtils $authenticationUtils)
    {
        $this->authenticationUtils = $authenticationUtils;
    }

    /**
     * @Route("/login", name="app_login")
     */
    public function login(): Response
    {
        // Récupère l'erreur d'authentification s'il y'en  aune
        $error = $this->authenticationUtils->getLastAuthenticationError();
        // Nom d'utilisateur entré par l'utilisateur
        $lastUsername = $this->authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }
}
