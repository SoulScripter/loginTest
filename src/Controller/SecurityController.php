<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\RegisterType;
use App\Form\LoginType;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Util\Validator\EmailValidator;
use App\Util\Validator\ValidatorException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;

#[Route(path: '/', name: 'security')]
class SecurityController extends AbstractController
{
    public function __construct(
        private UserRepository $userRepository,
        private EntityManagerInterface $em,
    ){}

    #[Route(path: '/register', name: '_register')]
    public function register(Request $request): Response
    {
        $form = $this->createForm(RegisterType::class);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $error = $this->handleRegistration($form);

            if($error !== null){
                $this->addFlash('danger', $error);
            } else {
                $this->addFlash('success', 'User wurde angelegt');

                return $this->redirectToRoute('home');
            }
        }

        return $this->render('register.html.twig', ['form' => $form]);
    }

    #[Route('/login', '_login')]
    public function login(Request $request): Response
    {
        $form = $this->createForm(LoginType::class);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $user = $this->handleLogin($form);

            if(!($user instanceof User)){
                $this->addFlash('danger', $user);
            } else {
                $this->addFlash('success', 'User wurde eingeloggt');

                $session = $request->getSession();
                $session->set('user', $user);

                return $this->redirectToRoute('home');
            }
        }

        return $this->render('login.html.twig', ['form' => $form]);
    }

    private function handleRegistration(FormInterface $form): ?string
    {
        $registration = $form->getData();

        if($registration['password'] !== $registration['passwordRepeat']){
            return 'Passwords missmatch';
        }

        try{
            EmailValidator::validate($registration['email']);
        } catch (ValidatorException $e) {
            return $e->getMessage();
        }

        if($this->userRepository->findOneBy(['username' => $registration['username']]) !== null){
            return 'Username already taken';
        }

        $user = new User();

        $user->setUsername($registration['username'])
            ->setPassword($registration['password'])
            ->setEmail($registration['email'])
            ->setFirstName($registration['firstName'])
            ->setLastName($registration['lastName'])
            ->setDateOfBirth($registration['dateOfBirth'])
            ->setCity($registration['city'])
            ->setStreet($registration['street'])
            ->setHouseNumber($registration['houseNumber'])
            ->setNationality($registration['nationality'])
            ->setPhone((int)$registration['phone'])
            ->setPostalCode((int)$registration['postalCode']);
        
        $this->em->persist($user);
        $this->em->flush();

        return null;
    }

    private function handleLogin(FormInterface $form): string|User
    {
        $logginAttempt = $form->getData();
        $user = $this->userRepository->findOneBy(
            [
                'username' => $logginAttempt['username'],
                'password' => $logginAttempt['password'],
            ]
        );

        if($user === null){
            return "Username und/oder Password inkorrekt";
        }

        return $user;
    }
}