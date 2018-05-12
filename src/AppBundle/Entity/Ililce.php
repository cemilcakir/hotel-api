<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Ililce
 *
 * @ORM\Table(name="ililce")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\IlilceRepository")
 * @Serializer\ExclusionPolicy("ALL")
 */
class Ililce
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
     * @ORM\Column(name="plaka", type="integer")
     * @Assert\NotBlank()
     * @Serializer\Groups({"Default", "Deserialize"})
     * @Serializer\Expose()
     */
    private $plaka;

    /**
     * @var string
     *
     * @ORM\Column(name="bolge", type="string", length=255, nullable=true)
     * @Assert\Length(min=1, max=255)
     * @Serializer\Groups({"Default", "Deserialize"})
     * @Serializer\Expose()
     */
    private $bolge;

    /**
     * @var string
     *
     * @ORM\Column(name="il", type="string", length=255, nullable=true)
     * @Assert\Length(min=1, max=255)
     * @Serializer\Groups({"Default", "Deserialize"})
     * @Serializer\Expose()
     */
    private $il;

    /**
     * @var string
     *
     * @ORM\Column(name="ilce", type="string", length=255, nullable=true)
     * @Assert\Length(min=1, max=255)
     * @Serializer\Groups({"Default", "Deserialize"})
     * @Serializer\Expose()
     */
    private $ilce;

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
    public function getPlaka(): int
    {
        return $this->plaka;
    }

    /**
     * @param int $plaka
     */
    public function setPlaka(int $plaka): void
    {
        $this->plaka = $plaka;
    }

    /**
     * @return string
     */
    public function getBolge(): string
    {
        return $this->bolge;
    }

    /**
     * @param string $bolge
     */
    public function setBolge(string $bolge): void
    {
        $this->bolge = $bolge;
    }

    /**
     * @return string
     */
    public function getIl(): string
    {
        return $this->il;
    }

    /**
     * @param string $il
     */
    public function setIl(string $il): void
    {
        $this->il = $il;
    }

    /**
     * @return string
     */
    public function getIlce(): string
    {
        return $this->ilce;
    }

    /**
     * @param string $ilce
     */
    public function setIlce(string $ilce): void
    {
        $this->ilce = $ilce;
    }


}