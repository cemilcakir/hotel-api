<?php
/**
 * Created by PhpStorm.
 * User: cemil
 * Date: 08.04.2018
 * Time: 13:19
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Room
 *
 * @ORM\Table(name="room")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RoomRepository")
 * @Serializer\ExclusionPolicy("ALL")
 */
class Room
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
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=70)
     * @Assert\NotBlank()
     * @Assert\Length(min=1, max=70)
     * @Serializer\Groups({"Default", "Deserialize"})
     * @Serializer\Expose()
     */
    private $type;

    /**
     * @var int
     *
     * @ORM\Column(name="price", type="integer")
     * @Assert\NotBlank()
     * @Serializer\Groups({"Default", "Deserialize"})
     * @Serializer\Expose()
     */
    private $price;

    /**
     * @var int
     *
     * @ORM\Column(name="floor", type="integer")
     * @Assert\NotBlank()
     * @Serializer\Groups({"Default", "Deserialize"})
     * @Serializer\Expose()
     */
    private $floor;

    /**
     * @var int
     *
     * @ORM\Column(name="size", type="integer")
     * @Assert\NotBlank()
     * @Serializer\Groups({"Default", "Deserialize"})
     * @Serializer\Expose()
     */
    private $size;

    /**
     * @var int
     *
     * @ORM\Column(name="capacity", type="integer")
     * @Assert\NotBlank()
     * @Serializer\Groups({"Default", "Deserialize"})
     * @Serializer\Expose()
     */
    private $capacity;

    /**
     * @var string
     *
     * @ORM\Column(name="detail", type="text")
     * @Assert\NotBlank()
     * @Assert\Length(min=10, max=5000)
     * @Serializer\Groups({"Default", "Deserialize"})
     * @Serializer\Expose()
     */
    private $detail;

    /**
     * @var int
     *
     * @ORM\Column(name="hotelId", type="integer", nullable=true)
     * @Serializer\Groups({"Default", "Deserialize"})
     * @Serializer\Expose()
     */
    private $hotelId;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
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
    public function getFloor(): int
    {
        return $this->floor;
    }

    /**
     * @param int $floor
     */
    public function setFloor(int $floor): void
    {
        $this->floor = $floor;
    }

    /**
     * @return string
     */
    public function getDetail(): string
    {
        return $this->detail;
    }

    /**
     * @param string $detail
     */
    public function setDetail(string $detail): void
    {
        $this->detail = $detail;
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



}