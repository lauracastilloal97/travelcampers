<?php

namespace App\Controller;

use App\Entity\UserData;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class CsvController extends AbstractController
{
    #[Route('/csv_email', name: 'csv_email')]
    public function index(Request $request): Response
    {
        if($this->isGranted('ROLE_ADMIN')){
            $datos = $request->query->all();
            if($datos){
                $list = array(
                    //these are the columns
                    array_keys($datos[0]),
                    //these are the rows
                );
                foreach ($datos as $valor) {
                    array_push($list,$valor);
                }
                $fp = fopen('php://temp', 'w');
                foreach ($list as $fields) {
                    fputcsv($fp, $fields,";");
                }
                rewind($fp);
                $response = new Response(stream_get_contents($fp));
                fclose($fp);

                $response->headers->set('Content-Type', 'text/csv');
                //it's gonna output in a testing.csv file
                $response->headers->set('Content-Disposition', 'attachment; filename="informe.csv"');

                return $response;
            }else{
                return $this->redirectToRoute('user_data_index');    
            }
        }else{
            $error[]="No tienes permisos";
            return $this->redirectToRoute('main', $error);
        }
    }

//    #[Route('/csv', name: 'csv_email')]
//    public function emailList(Request $request): Response
//    {
//        if($this->isGranted('ROLE_ADMIN')){
//            $datos = $request->query->all();
//           
//            $list = array(
//                //these are the columns
//                array_keys($datos[0]),
//                //these are the rows
//            );
//            foreach ($datos as $valor) {
//                array_push($list,$valor);
//            }
//            $fp = fopen('php://temp', 'w');
//            foreach ($list as $fields) {
//                fputcsv($fp, $fields,";");
//            }
//            rewind($fp);
//            $response = new Response(stream_get_contents($fp));
//            fclose($fp);
//            
//            $response->headers->set('Content-Type', 'text/csv');
//            //it's gonna output in a testing.csv file
//            $response->headers->set('Content-Disposition', 'attachment; filename="informe.csv"');
//            
//            return $response;
//        }else{
//            $error[]="No tienes permisos";
//            return $this->redirectToRoute('main', $error);
//        }
//    }
}
