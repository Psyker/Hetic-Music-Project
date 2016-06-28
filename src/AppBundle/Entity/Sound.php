<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Sound
 *
 * @ORM\Table(name="sound")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SoundRepository")
 * @Vich\Uploadable
 */
class Sound
{

    public function __construct() {
        $this->sounds = new ArrayCollection();
    }

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Vich\UploadableField(mapping="product_sound", fileNameProperty="urlSound")
     * @var File
     */
    private $soundFile;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Video", mappedBy="sounds")
     */
    private $videos;

    /**
     * @var string
     *
     * @ORM\Column(name="compositeur", type="string", length=50)
     */
    private $compositeur;

    /**
     * @var string
     *
     * @ORM\Column(name="urlSound", type="string", length=100)
     */
    private $urlSound;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var integer
     *
     * @ORM\Column(name="realisation_annee", type="integer")
     */
    private $realisation_annee;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Sound
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @return Sound
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $sound
     *
     */
    public function setSoundFile($sound = null)
    {
        $this->soundFile = $sound;
        if($sound){
            $this->updatedAt= new \DateTime('now');
        }

        return $this;
    }

    public function getSoundFile()
    {
        return $this->soundFile;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getVideos()
    {
        return $this->videos;
    }

    /**
     * @return mixed
     */
    public function getCompositeur()
    {
        return $this->compositeur;
    }

    /**
     * @param mixed $compositeur
     */
    public function setCompositeur($compositeur)
    {
        $this->compositeur = $compositeur;
    }

    /**
     * @return mixed
     */
    public function getUrlSound()
    {
        return $this->urlSound;
    }

    /**
     * @param mixed $urlSound
     */
    public function setUrlSound($urlSound)
    {
        $this->urlSound = $urlSound;
    }

    /**
     * @return mixed
     */
    public function getRealisationAnnee()
    {
        return $this->realisation_annee;
    }

    /**
     * @param mixed $realisation_annee
     */
    public function setRealisationAnnee($realisation_annee)
    {
        $this->realisation_annee = $realisation_annee;
    }


}

