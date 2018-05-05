<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Hotel;
use AppBundle\Entity\EntityMerger;
use AppBundle\Exception\ValidationException;
use FOS\RestBundle\Controller\ControllerTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HotelsController extends  AbstractController
{
    use ControllerTrait;

    /**
     * @var EntityMerger
     */

    private $entityMerger;

    /**
     * @Rest\View()
     */
    public function __construct(EntityMerger $entityMerger) {
        $this->entityMerger = $entityMerger;
    }

    public function getHotelsAction()
    {
        $Hotels=$this->getDoctrine()->getRepository('AppBundle:Hotel')->findAll();
        return $Hotels;
    }

    /**
     * @Rest\View()
     * @ParamConverter("hotel",converter="fos_rest.request_body")
     * @Rest\NoRoute()
     */
    public function postHotelsAction(Hotel $hotel, ConstraintViolationListInterface $validationErrors)
    {
        if (count($validationErrors)){
            throw new ValidationException($validationErrors);
        }

        $em= $this->getDoctrine()->getManager();
        $em->persist($hotel);
        $em->flush();

        return $hotel;
    }

    /**
     * @Rest\NoRoute()
     * @ParamConverter("modifiedHotel", converter="fos_rest.request_body",
     *     options={
     *         "validator"={"groups"={"Patch"}},
     *         "deserializationContext"={"groups"={"Deserialize"}}
     *     }
     * )
     */
    public function patchHotelsAction(
        ?Hotel $theHotel, Hotel $modifiedHotel,
        ConstraintViolationListInterface $validationErrors)
    {
        if (null === $theHotel) {
            throw new NotFoundHttpException();
        }

        if (count($validationErrors) > 0) {
            throw new ValidationException($validationErrors);
        }

        $this->entityMerger->merge(
            $theHotel,
            $modifiedHotel
        );
        $this->persistHotel($theHotel);

        return $theHotel;
    }

    /**
     * @Rest\View()
     */
    public function deleteHotelAction(Hotel $hotel)
    {
        if(null == $hotel){
            return $this->view(null,404);
        }

        $em=$this->getDoctrine()->getManager();
        $em->remove($hotel);
        $em->flush();
    }

    /**
     * @Rest\View()
     */
    public function getHotelAction(Hotel $hotel)
    {
        if(null == $hotel){
            return $this->view(null,404);
        }

        return $hotel;
    }

    /**
     * @param Hotel $hotel
     */
    protected function persistHotel(Hotel $hotel): void
    {
        $em = $this->getDoctrine()
            ->getManager();
        $em->persist($hotel);
        $em->flush();
    }
}
