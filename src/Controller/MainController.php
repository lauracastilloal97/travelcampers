<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Campers;
use App\Entity\Comentario;
use App\Entity\User;
use App\Entity\Rute;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;


class MainController extends AbstractController
{
    #[Route('/', name: 'main')]
    public function index(): Response
    {
        $manager=$this->getDoctrine()->getManager();
        $lastCamper=$this->getDoctrine()->getRepository(Campers::class)->findBy([],['date'=>"DESC"],3,0);
        $ComentarioRepository=$manager->getRepository(Comentario::class);
        $allRoute=$this->getDoctrine()->getRepository(Rute::class)->findBy([],['date'=>"DESC"],3,0);
        $comentario=$ComentarioRepository->findAll();
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'campers' =>$lastCamper,
            'comentarios'=>$comentario,
            'routes'=>$allRoute
        ]);
    }
    
            #[Route('/readCamper/{id}', name:'readCamper/{id}')]
    public function readCamper($id){
        $readCamper=$this->getDoctrine()->getRepository(Campers::class)->find($id);


        return $this->render('main/readCamper.html.twig',[
            'controller_name' => 'MainController',
            'camper'=>$readCamper,
        ]);


    }

    #[Route('/readRoute/{id}', name:'readRoute/{id}')]
    public function readRoute($id){
        $readRoute=$this->getDoctrine()->getRepository(Rute::class)->find($id);


        return $this->render('main/readRoute.html.twig',[
            'controller_name' => 'MainController',
            'route'=>$readRoute,
        ]);


    }
    
      /**
     * @Route("/ocultarComentario", name="ocultarComentario", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function ocultarComentario(Request $request)
    { 
        $instancia3 = $this->getDoctrine()->getRepository(Comentario::class)->find($request->query->get('idComentario'));
      
        if ( !$instancia3)
            return new Response("Error");

        //modificamos los datos que queramos de la $instance3 y la guardamos
        $instancia3->setEstado(0);

        $em = $this->getDoctrine()->getManager();
        $em->persist($instancia3);
        $em->flush();

              
        return new Response($instancia3->getEstado());

    }
        #[Route('/listCampers', name:'listCampers')]
    public function allCampers(PaginatorInterface $paginator,Request $request){
        
        $allCamper=$this->getDoctrine()->getRepository(Campers::class)->findBy([],['date'=>"DESC"]);

        $pagination = $paginator->paginate(
            $allCamper, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            4/*limit per page*/
        );
        $pagination->setTemplate('twitter_bootstrap_v4_pagination.html.twig');
        
        return $this->render('main/listCamper.html.twig',[
            'controller_name' => 'MainController',
            'pagination' => $pagination
        ]);
    }

    #[Route('/listRoutes', name:'listRoutes')]
    public function allRoutes(){
        
        $allRoute=$this->getDoctrine()->getRepository(Rute::class)->findAll();
        
        
        return $this->render('main/listRoutes.html.twig',[
            'controller_name' => 'MainController',
            'routes'=>$allRoute
        ]);
    }
    
}
