<?php


namespace App\Controller\Registration;

use App\Entity\User;
use App\Form\RegistrationType;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{

    /**
     * @var UserService
     */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @Route("/register", name="registration")
     * @param Request $request
     */
    public function register(Request $request)
    {
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $encodedPassword = $this->userService->UserPasswordEncoder($user);
            $user->setPassword($encodedPassword);

            $this->userService->PersistUser($user);

            return $this->redirectToRoute('homepage');
        }

        return $this->render(
            'registration/registration.html.twig', [
                'form' => $form->createView()
        ]);
    }
}