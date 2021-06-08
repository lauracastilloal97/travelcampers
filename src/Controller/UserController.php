<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Reserva;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/', name: 'user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository, Request $request): Response
    {
        if($this->isGranted('ROLE_ADMIN')){
            
            $user = $userRepository->findAll();
    
            if($request->query->get('informe')){
                $arraytotal = [];
                foreach($user as $datos){
                    array_push($arraytotal,$datos->getSimpleValues());
                }
                return $this->redirectToRoute('csv_email',$arraytotal);
            }
            return $this->render('user/index.html.twig', [
                'users' => $userRepository->findAll(),
            ]);
        }else{
            $error[]="No tienes permisos";
            return $this->redirectToRoute('main', $error);
        }
    }

    #[Route('/new', name: 'user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SluggerInterface $slugger): Response
    {
        if($this->isGranted('ROLE_ADMIN')){

            $user = new User();
            $form = $this->createForm(UserType::class, $user);
            $form->handleRequest($request);
    
            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $avatar=$form->get('avatar')->getData();

                    if ($avatar) {
                        $originalFilename = pathinfo($avatar->getClientOriginalName(), PATHINFO_FILENAME);
                        // this is needed to safely include the file name as part of the URL
                        $safeFilename = $slugger->slug($originalFilename);
                        $newFilename = $safeFilename.'-'.uniqid().'.'.$avatar->guessExtension();

                        // Move the file to the directory where brochures are stored
                        try {
                            $avatar->move(
                                "img/",
                                $newFilename
                            );
                        } catch (FileException $e) {
                            // ... handle exception if something happens during file upload
                        }

                $user->setAvatar($newFilename);               
                $entityManager->persist($user);
                $entityManager->flush();
    
                return $this->redirectToRoute('main');
            }
    
            return $this->render('user/new.html.twig', [
                'user' => $user,
                'form' => $form->createView(),
            ]);
        }else{
            $error[]="No tienes permisos";
            return $this->redirectToRoute('main', $error);
        }
    }
    }

    #[Route('/{id}', name: 'user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        if($this->isGranted('ROLE_USER')){
            $reserva=$this->getDoctrine()->getRepository(Reserva::class)->findAll();

            return $this->render('user/show.html.twig', [
            'user' => $user,
                'reservas' =>$reserva,
            ]);
        }else{
            $error[]="Debes iniciar sesion";
            return $this->redirectToRoute('main', $error);
        }
    }

    #[Route('/{id}/edit', name: 'user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, SluggerInterface $slugger): Response
    {
        if($this->isGranted('ROLE_USER')){

            $form = $this->createForm(UserType::class, $user);
            $form->handleRequest($request);
    
            if ($form->isSubmitted() && $form->isValid()) {
                $avatar=$form->get('avatar')->getData();

                    if ($avatar) {
                        $originalFilename = pathinfo($avatar->getClientOriginalName(), PATHINFO_FILENAME);
                        // this is needed to safely include the file name as part of the URL
                        $safeFilename = $slugger->slug($originalFilename);
                        $newFilename = $safeFilename.'-'.uniqid().'.'.$avatar->guessExtension();

                        // Move the file to the directory where brochures are stored
                        try {
                            $avatar->move(
                                "img/",
                                $newFilename
                            );
                        } catch (FileException $e) {
                            // ... handle exception if something happens during file upload
                        }

                $user->setAvatar($newFilename);      
                $this->getDoctrine()->getManager()->flush();
    
                return $this->redirectToRoute('main');
            }
            }
    
            return $this->render('user/edit.html.twig', [
                'user' => $user,
                'form' => $form->createView(),
            ]);
        }else{
            $error[]="No tienes permisos";
            return $this->redirectToRoute('main', $error);
        }
    }

    #[Route('/{id}', name: 'user_delete', methods: ['DELETE'])]
    public function delete(Request $request, User $user): Response
    {
        if($this->isGranted('ROLE_ADMIN')){

            if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->remove($user);
                $entityManager->flush();
            }
    
            return $this->redirectToRoute('user_index');
        }else{
            $error[]="No tienes permisos";
            return $this->redirectToRoute('main', $error);
        }
    }
}
