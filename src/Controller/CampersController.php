<?php

namespace App\Controller;

use App\Entity\Campers;
use App\Form\CampersType;
use App\Repository\CampersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/campers')]
class CampersController extends AbstractController
{
    #[Route('/', name: 'campers_index', methods: ['GET'])]
    public function index(CampersRepository $campersRepository): Response
    {
        return $this->render('campers/index.html.twig', [
            'campers' => $campersRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'campers_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SluggerInterface $slugger): Response
    {
        if($this->isGranted('ROLE_ADMIN')){
            $camper = new Campers();
            $form = $this->createForm(CampersType::class, $camper);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();         
                $image=$form->get('image')->getData();

                    if ($image) {
                        $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                        // this is needed to safely include the file name as part of the URL
                        $safeFilename = $slugger->slug($originalFilename);
                        $newFilename = $safeFilename.'-'.uniqid().'.'.$image->guessExtension();

                        // Move the file to the directory where brochures are stored
                        try {
                            $image->move(
                                "img/",
                                $newFilename
                            );
                        } catch (FileException $e) {
                            // ... handle exception if something happens during file upload
                        }

                $camper->setImage($newFilename);
                $camper->setDate(new \DateTime());
                $entityManager->persist($camper);
                $entityManager->flush();

                return $this->redirectToRoute('main');
            }
            }

            return $this->render('campers/new.html.twig', [
                'camper' => $camper,
                'form' => $form->createView(),
            ]);
            }else{
            $error[]="No tienes permisos";
            return $this->redirectToRoute('main', $error);
        }
    }

    #[Route('/{id}', name: 'campers_show', methods: ['GET'])]
    public function show(Campers $camper): Response
    {
         if($this->isGranted('ROLE_ADMIN')){
            return $this->render('campers/show.html.twig', [
                'camper' => $camper,
            ]);
        }else{
            $error[]="No tienes permisos";
            return $this->redirectToRoute('main', $error);
        }
    }

    #[Route('/{id}/edit', name: 'campers_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Campers $camper): Response
    {
         if($this->isGranted('ROLE_ADMIN')){
            $form = $this->createForm(CampersType::class, $camper);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('campers_index');
            }

            return $this->render('campers/edit.html.twig', [
                'camper' => $camper,
                'form' => $form->createView(),
            ]);
        
        }else{
            $error[]="No tienes permisos";
            return $this->redirectToRoute('main', $error);
        }
    }

    #[Route('/{id}', name: 'campers_delete', methods: ['POST'])]
    public function delete(Request $request, Campers $camper): Response
    {
        if ($this->isCsrfTokenValid('delete'.$camper->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($camper);
            $entityManager->flush();
        }

        return $this->redirectToRoute('campers_index');
    }
}
