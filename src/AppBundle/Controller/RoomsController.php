<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Room;
use AppBundle\Exception\ValidationException;
use FOS\RestBundle\Controller\ControllerTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class RoomsController extends AbstractController{
    use ControllerTrait;

    /**
     * @Rest\View()
     */
    public function getRoomsAction()
    {
        $rooms=$this->getDoctrine()->getRepository('AppBundle:Room')->findAll();
        return $rooms;
    }

    /**
     * @Rest\View()
     * @ParamConverter("room",converter="fos_rest.request_body")
     * @Rest\NoRoute()
     */
    public function postRoomsAction(Room $room, ConstraintViolationListInterface $validationErrors)
    {
        if (count($validationErrors)){
            throw new ValidationException($validationErrors);
        }

        $em= $this->getDoctrine()->getManager();
        $em->persist($room);
        $em->flush();

        return $room;
    }

    /**
     * @Rest\View()
     */
    public function deleteRoomAction(Room $room)
    {
        if(null == $room){
            return $this->view(null,404);
        }

        $em=$this->getDoctrine()->getManager();
        $em->remove($room);
        $em->flush();
    }

    /**
     * @Rest\View()
     */
    public function getRoomAction(Room $room)
    {
        if(null == $room){
            return $this->view(null,404);
        }

        return $room;
    }
}
