<?php

namespace App\Controller;

use App\Entity\Rute;
use App\Form\RuteType;
use App\Repository\RuteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;


#[Route('/rute')]
class RuteController extends AbstractController
{
    #[Route('/', name: 'rute_index', methods: ['GET'])]
    public function index(RuteRepository $ruteRepository): Response
    {
        return $this->render('rute/index.html.twig', [
            'rutes' => $ruteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'rute_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SluggerInterface $slugger): Response
    {
        if($this->isGranted('ROLE_ADMIN')){
            $rute = new Rute();
            $form = $this->createForm(RuteType::class, $rute);
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

                $rute->setImage($newFilename);
                $rute->setDate(new \DateTime());
                $entityManager->persist($rute);
                $entityManager->flush();

                return $this->redirectToRoute('main');
            }
        }

            return $this->render('rute/new.html.twig', [
                'rute' => $rute,
                'form' => $form->createView(),
            ]);
        
        }else{
            $error[]="No tienes permisos";
            return $this->redirectToRoute('main', $error);
        }
    }

    #[Route('/{id}', name: 'rute_show', methods: ['GET'])]
    public function show(Rute $rute): Response
    {
        
            return $this->render('rute/show.html.twig', [
                'rute' => $rute,
            ]);

    }

    #[Route('/{id}/edit', name: 'rute_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Rute $rute): Response
    {
        if($this->isGranted('ROLE_ADMIN')){
            $form = $this->createForm(RuteType::class, $rute);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('rute_index');
            }

            return $this->render('rute/edit.html.twig', [
                'rute' => $rute,
                'form' => $form->createView(),
            ]);
        }else{
            $error[]="No tienes permisos";
            return $this->redirectToRoute('main', $error);
        }
    }

    #[Route('/{id}', name: 'rute_delete', methods: ['POST'])]
    public function delete(Request $request, Rute $rute): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rute->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($rute);
            $entityManager->flush();
        }

        return $this->redirectToRoute('rute_index');
    }
}
