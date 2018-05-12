<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Room;
use AppBundle\Entity\EntityMerger;
use AppBundle\Exception\ValidationException;
use FOS\RestBundle\Controller\ControllerTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RoomsController extends AbstractController{
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
     */
    public function getHotelRoomsAction($hotelId)
    {
        $em = $this->getDoctrine()->getRepository('AppBundle:Room')->findBy(array('hotelId' => $hotelId));
        return $em;
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
     * @Rest\NoRoute()
     * @ParamConverter("modifiedRoom", converter="fos_rest.request_body",
     *     options={
     *         "validator"={"groups"={"Patch"}},
     *         "deserializationContext"={"groups"={"Deserialize"}}
     *     }
     * )
     */
    public function patchRoomsAction(
        ?Room $theRoom, Room $modifiedRoom,
        ConstraintViolationListInterface $validationErrors)
    {
        if (null === $theRoom) {
            throw new NotFoundHttpException();
        }

        if (count($validationErrors) > 0) {
            throw new ValidationException($validationErrors);
        }

        $this->entityMerger->merge(
            $theRoom,
            $modifiedRoom
        );
        $this->persistRoom($theRoom);

        return $theRoom;
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

    /**
     * @param Room $room
     */
    protected function persistRoom(Room $room): void
    {
        $em = $this->getDoctrine()
            ->getManager();
        $em->persist($room);
        $em->flush();
    }
}

