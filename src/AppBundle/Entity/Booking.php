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
     * @var int
     *
     * @ORM\Column(name="peopleCount", type="integer")
     * @Serializer\Groups({"Default", "Deserialize"})
     * @Serializer\Expose()
     */
    private $peopleCount;

    /**
     * @var int
     *
     * @ORM\Column(name="price", type="integer")
     * @Serializer\Groups({"Default", "Deserialize"})
     * @Serializer\Expose()
     */
    private $price;

    /**
     * @var \DateTime
     * @Assert\Date()
     * @Serializer\Type("DateTime<'Y-m-d'>")
     * @ORM\Column(name="entranceDate", type="date")
     * @Serializer\Groups({"Default", "Deserialize"})
     * @Serializer\Expose()
     */
    private $entranceDate;

    /**
     * @var \DateTime
     * @Assert\Date()
     * @Serializer\Type("DateTime<'Y-m-d'>")
     * @ORM\Column(name="leaveDate", type="date")
     * @Serializer\Groups({"Default", "Deserialize"})
     * @Serializer\Expose()
     */
    private $leaveDate;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return int
     */
    public function getHotelId(): int
    {
        return $this->hotelId;
    }

    /**
     * @param int $hotelId
     */
    public function setHotelId(int $hotelId): void
    {
        $this->hotelId = $hotelId;
    }

    /**
     * @return int
     */
    public function getPeopleCount(): int
    {
        return $this->peopleCount;
    }

    /**
     * @param int $peopleCount
     */
    public function setPeopleCount(int $peopleCount): void
    {
        $this->peopleCount = $peopleCount;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getRoomId(): int
    {
        return $this->roomId;
    }

    /**
     * @param int $roomId
     */
    public function setRoomId(int $roomId): void
    {
        $this->roomId = $roomId;
    }

    /**
     * @return \datetime
     */
    public function getEntranceDate(): \datetime
    {
        return $this->entranceDate;
    }

    /**
     * @param \datetime $entranceDate
     */
    public function setEntranceDate(\datetime $entranceDate): void
    {
        $this->entranceDate = $entranceDate;
    }

    /**
     * @return \datetime
     */
    public function getLeaveDate(): \datetime
    {
        return $this->leaveDate;
    }

    /**
     * @param \datetime $leaveDate
     */
    public function setLeaveDate(\datetime $leaveDate): void
    {
        $this->leaveDate = $leaveDate;
    }
}

