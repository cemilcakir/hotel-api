<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Booking
 *
 * @ORM\Table(name="booking")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BookingRepository")
 * @Serializer\ExclusionPolicy("ALL")
 */
class Booking
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups({"Default", "Deserialize"})
     * @Serializer\Expose()
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="userId", type="integer")
     * @Serializer\Groups({"Default", "Deserialize"})
     * @Serializer\Expose()
     */
    private $userId;

    /**
     * @var int
     *
     * @ORM\Column(name="hotelId", type="integer")
     * @Serializer\Groups({"Default", "Deserialize"})
     * @Serializer\Expose()
     */
    private $hotelId;

    /**
     * @var int
     *
     * @ORM\Column(name="roomId", type="integer")
     * @Serializer\Groups({"Default", "Deserialize"})
     * @Serializer\Expose()
     */
    private $roomId;

    /**
     * @var \datetime
     * @ORM\Column(name="entranceDate", type="date")
     * @Serializer\Groups({"Default", "Deserialize"})
     * @Serializer\Expose()
     */
    private $entranceDate;

    /**
     * @var \datetime
     * @ORM\Column(name="leaveDate", type="date")
     * @Serializer\Groups({"Default", "Deserialize"})
     * @Serializer\Expose()
     */
    private $leaveDate;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return int
     */
    public function getHotelId()
    {
        return $this->hotelId;
    }

    /**
     * @param int $hotelId
     */
    public function setHotelId($hotelId)
    {
        $this->hotelId = $hotelId;
    }

    /**
     * @return int
     */
    public function getRoomId()
    {
        return $this->roomId;
    }

    /**
     * @param int $roomId
     */
    public function setRoomId($roomId)
    {
        $this->roomId = $roomId;
    }

    /**
     * @return \datetime
     */
    public function getEntranceDate()
    {
        return $this->entranceDate;
    }

    /**
     * @param \datetime $entranceDate
     */
    public function setEntranceDate($entranceDate)
    {
        $this->entranceDate = $entranceDate;
    }

    /**
     * @return \datetime
     */
    public function getLeaveDate()
    {
        return $this->leaveDate;
    }

    /**
     * @param \datetime $leaveDate
     */
    public function setLeaveDate($leaveDate)
    {
        $this->leaveDate = $leaveDate;
    }


}

