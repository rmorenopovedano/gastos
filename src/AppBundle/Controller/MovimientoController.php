<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Movimiento;
use Doctrine\DBAL\Types\DateType;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class MovimientoController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */

    public function indexAction(Request $request){
        $movimiento = new Movimiento();
        $repository=$this->getDoctrine()->getRepository('AppBundle:Movimiento');
        $totalGastos=$repository->calcularTotalGastos();
        $totalIngresos=$repository->calcularTotalIngresos();
        $total=$totalIngresos[0][1]-$totalGastos[0][1];

        $searchMovimiento=$this->createForm('AppBundle\Form\MovimientoFilterType', $movimiento);
        $searchMovimiento->handleRequest($request);

        $page = ($searchMovimiento->isSubmitted()) ? 1 : $request->get('page', 1);
        $queryBuilder=$repository->cargarMovimiento($movimiento->getMes(),$movimiento->getTipo());
        $adapter = new DoctrineORMAdapter($queryBuilder);
        $pagerfanta = new Pagerfanta($adapter);
        $pagerfanta->setMaxPerPage(5);
        $pagerfanta->setCurrentPage($page);

        return $this->render('AppBundle:Movimiento:lista.html.twig', array(
            "movimiento"=>$pagerfanta->getCurrentPageResults(),
            "pager" => $pagerfanta,
            "formSearch"=>$searchMovimiento->createView(),
            "total"=>$total
        ));
    }

//    public function indexAction(Request $request)
//    {
//        // replace this example code with whatever you need
//        $repository=$this->getDoctrine()->getRepository('AppBundle:Movimiento');
//        $movimiento=$repository->findAll();
//        $totalGastos=$repository->calcularTotalGastos();
//        $totalIngresos=$repository->calcularTotalIngresos();
//        $total=$totalIngresos[0][1]-$totalGastos[0][1];
//        $filtro=$this->filter();
//        $filtro->handleRequest($request);
//        if ($filtro->isSubmitted()) {
//            $data = $filtro->getData();
//            $movimiento=$repository->findBy([
//                    "mes"=>$data['mes'],
//                    "tipo"=>$data['tipo'],
//                ]
//            );
//        }
//        return $this->render('AppBundle:Movimiento:lista.html.twig', [
//            "movimiento"=>$movimiento,
//            "total"=>$total,
//            "formSearch"=>$filtro->createView(),
//        ]);
//    }
    /**
     * @Route("add")
     */
    public function add(Request $request)
    {
        $movimiento= new Movimiento();
        $form = $this->createForm('AppBundle\Form\MovimientoType', $movimiento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $movimiento = $form->getData();
             $em = $this->getDoctrine()->getManager();
             $em->persist($movimiento);
             $em->flush();

            return $this->redirectToRoute('homepage');
        }
        return $this->render('AppBundle:Movimiento:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
    * @Route("delete/{id}")
    */
    public function delete($id){
        $repository = $this->getDoctrine()->getRepository('AppBundle:Movimiento');
        $movimiento=$repository->find($id);
        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($movimiento);
        $em->flush();
        return $this->redirectToRoute('homepage');
    }

    public function filter(){
        $form = $this->createForm('AppBundle\Form\MovimientoFilterType');
        return $form;
    }
    /**
     * @Route("resumen/{mes}")
     */
    public function resumenAction($mes=null){
        $repo=$this->getDoctrine()->getRepository('AppBundle:Movimiento');
        $movimiento=$repo->findAll();
        $gastosMes=$repo->resumenGastoMes($mes, 0);
        $ingresosMes=$repo->resumenGastoMes($mes, 1);
        $gastoMes=$gastosMes[0][1];
        $ingresoMes=$ingresosMes[0][1];
        $total=$ingresoMes-$gastoMes;
        return $this->render('AppBundle:Movimiento:resumen.html.twig',[
            "resumen"=>$total,
            "entidad"=>$movimiento,
            "movimiento"=>$gastosMes,
            "mes"=>$mes,
        ]);
    }

}
