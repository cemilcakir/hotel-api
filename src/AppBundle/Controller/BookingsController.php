<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Booking;
use AppBundle\Exception\ValidationException;
use FOS\RestBundle\Controller\ControllerTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class BookingsController extends  AbstractController
{
    use ControllerTrait;

    /**
     * @Rest\View()
     */
    public function getBookingsAction(){
        $bookings=$this->getDoctrine()->getRepository('AppBundle:Booking')->findAll();
        return $bookings;
    }

    /**
     * @Rest\View()
     * @ParamConverter("booking",converter="fos_rest.request_body")
     * @Rest\NoRoute()
     */
    public function postBookingsAction(Booking $booking, ConstraintViolationListInterface $validationErrors)
    {
        if (count($validationErrors)){
            throw new ValidationException($validationErrors);
        }

        $em= $this->getDoctrine()->getManager();
        $em->persist($booking);
        $em->flush();

        return $booking;
    }

    /**
     * @Rest\View()
     */
    public function deleteBookingAction(Booking $booking)
    {
        if(null == $booking){
            return $this->view(null,404);
        }

        $em=$this->getDoctrine()->getManager();
        $em->remove($booking);
        $em->flush();
    }

    /**
     * @Rest\View()
     */
    public function getBookingAction(Booking $booking){

        if(null == $booking){
            return $this->view(null,404);
        }

        return $booking;
    }
}