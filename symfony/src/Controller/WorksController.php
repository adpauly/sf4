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

use App\Entity\Work;
use App\Form\EditWorkType;
use App\Manager\WorkManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/works")
 */
class WorksController extends AbstractController
{
    protected $workManager;

    public function __construct(WorkManager $workManager)
    {
        $this->workManager = $workManager;
    }

    /**
     * @Route("/", name="app_works")
     */
    public function works(): Response
    {
        $works = $this->workManager->findBy([], ['id' => 'desc']);

        $paramsTwig = [
            'works' => $works,
        ];

        return $this->render('works/list.html.twig', $paramsTwig);
    }

    /**
     * @Route("/edit/{id}", name="app_work_edit", defaults={"id" = null})
     * @ParamConverter("work", class="App:Work", isOptional="true")
     */
    public function editWork(Request $request, Work $work = null): Response
    {
        if (empty($work)) {
            $work = new Work();
        }

        $editWorkForm = $this->createForm(EditWorkType::class, $work);
        $editWorkForm->handleRequest($request);
        if ($editWorkForm->isSubmitted() && $editWorkForm->isValid()) {
            $this->workManager->persist($work);
            $this->workManager->flush();

            return $this->redirectToRoute('app_works');
            // return $this->redirectToRoute('app_work_edit', ['workId' => $work->getId()]);
        }

        $paramsTwig = [
            'editWorkForm' => $editWorkForm->createView(),
        ];

        return $this->render('works/edit.html.twig', $paramsTwig);
    }
}
