<?php

namespace App\Controller;

use App\Entity\Reserva;
use App\Entity\Campers;
use App\Form\ReservaType;
use App\Repository\ReservaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/reserva')]
class ReservaController extends AbstractController
{
    #[Route('/', name: 'reserva_index', methods: ['GET'])]
    public function index(ReservaRepository $reservaRepository): Response
    {
        return $this->render('reserva/index.html.twig', [
            'reservas' => $reservaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'reserva_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        if($this->isGranted('ROLE_USER')){
            $reserva = new Reserva();
            $form = $this->createForm(ReservaType::class, $reserva);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                //var_dump($form->get('fecha')->getData());
                //var_dump($request->request->get("campers"));
                //die();
                $encontrado= $this->getDoctrine()->getRepository(Reserva::class)->findOneByfecha($form->get('fecha')->getData(),$form->get('campers')->getData());
                 if ($encontrado){
                    return $this->render('reserva/new.html.twig', [
                    'reserva' => $reserva,
                    'form' => $form->createView(),
                    'info' => 'Fecha ocupada. Elige otra fecha',
                    ]);
                }else{
                     $reserva->setUser($this->getUser());
                     //$reserva->setCampers($this->getDoctrine()->getRepository(Campers::class)->find($id));
                $entityManager->persist($reserva);
                $entityManager->flush();

                return $this->redirectToRoute('main');
                 }
                
            }

            return $this->render('reserva/new.html.twig', [
                'reserva' => $reserva,
                'form' => $form->createView(),
            ]);
        }else{
            $error[]="Debes iniciar sesion";
            return $this->redirectToRoute('app_login', $error);
        }
    }

    #[Route('/{id}', name: 'reserva_show', methods: ['GET'])]
    public function show(Reserva $reserva): Response
    {
        if($this->isGranted('ROLE_USER')){
            return $this->render('reserva/show.html.twig', [
                'reserva' => $reserva,
            ]);
        }else{
            $error[]="Debes iniciar sesion";
            return $this->redirectToRoute('main', $error);
        }
    }

    #[Route('/{id}/edit', name: 'reserva_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reserva $reserva): Response
    {
        if($this->isGranted('ROLE_USER')){
            $form = $this->createForm(ReservaType::class, $reserva);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('reserva_index');
            }

            return $this->render('reserva/edit.html.twig', [
                'reserva' => $reserva,
                'form' => $form->createView(),
            ]);
        }else{
            $error[]="Debes iniciar sesion";
            return $this->redirectToRoute('main', $error);
        }
    }

    #[Route('/{id}', name: 'reserva_delete', methods: ['POST'])]
    public function delete(Request $request, Reserva $reserva): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reserva->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($reserva);
            $entityManager->flush();
        }

        return $this->redirectToRoute('reserva_index');
    }
}
