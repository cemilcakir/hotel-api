<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Ililce;
use AppBundle\Entity\EntityMerger;
use AppBundle\Exception\ValidationException;
use FOS\RestBundle\Controller\ControllerTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class IlilceController extends  AbstractController
{
    public function getIlAction()
    {
        $query = $this->getDoctrine()->getManager()->createQuery(
            'SELECT distinct i.il
            FROM AppBundle:Ililce i'
        );

        $iller = $query->getResult();
        return $iller;
        //$Hotels=$this->getDoctrine()->getRepository('AppBundle:Ililce')->findAll();
        //return $Hotels;
    }

    /**
     * @Rest\View()
     */
    public function getIlceAction($il)
    {
        $em = $this->getDoctrine()->getRepository('AppBundle:Ililce')->findBy(array('il' => $il));
        return $em;
    }
}