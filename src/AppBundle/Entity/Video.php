<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Video
 *
 * @ORM\Table(name="video")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VideoRepository")
 * @Vich\Uploadable
 */
class Video
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;
    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Sound", inversedBy="videos")
     * @ORM\JoinTable(name="video_sound",
     *      joinColumns={@ORM\JoinColumn(name="idvideo", referencedColumnName="id", nullable=false)},
     *      inverseJoinColumns={@ORM\JoinColumn(name="idsound", referencedColumnName="id", nullable=false)}
     *      )
     */
    private $sounds;
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=1000)
     */
    private $description;
    /**
     * @var string
     *
     * @ORM\Column(name="realisateur", type="string", length=50)
     */
    private $realisateur;
    /**
     * @var integer
     *
     * @ORM\Column(name="annee_realisation", type="integer")
     */
    private $annee_realisation;
    /**
     * @var string
     *
     * @ORM\Column(name="urlVideo", type="string", length=255)
     */
    private $urlVideo;
    /**
     * @Vich\UploadableField(mapping="product_video", fileNameProperty="urlVideo")
     * @var File
     */
    private $videoFile;
    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $updatedAt;

    public function __construct()
    {
        $this->videos = new ArrayCollection();
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return File
     */
    public function getVideoFile()
    {
        return $this->videoFile;
    }

    /**
     * @return Video
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $video
     *
     */
    public function setVideoFile($video = null)
    {
        $this->videoFile = $video;
        if ($video) {
            $this->updatedAt = new \DateTime('now');
        }

        return $this;
    }

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
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Video
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSounds()
    {
        return $this->sounds;
    }

    public function setSounds($sounds)
    {
        $this->sounds = $sounds;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getRealisateur()
    {
        return $this->realisateur;
    }

    /**
     * @param mixed $realisateur
     */
    public function setRealisateur($realisateur)
    {
        $this->realisateur = $realisateur;
    }

    /**
     * @return mixed
     */
    public function getAnneeRealisation()
    {
        return $this->annee_realisation;
    }

    /**
     * @param mixed $annee_realisation
     */
    public function setAnneeRealisation($annee_realisation)
    {
        $this->annee_realisation = $annee_realisation;
    }

    /**
     *
     * @return string
     */
    public function getUrlVideo()
    {
        return $this->urlVideo;
    }

    /**
     * @param string $urlVideo
     * @return Video
     */
    public function setUrlVideo($urlVideo)
    {
        $this->urlVideo = $urlVideo;
    }


    /**
     * Add sound
     *
     * @param \AppBundle\Entity\Sound $sound
     *
     * @return Video
     */
    public function addSound(Sound $sound)
    {
        $this->sounds[] = $sound;

        return $this;
    }

    /**
     * Remove sound
     *
     * @param \AppBundle\Entity\Sound $sound
     */
    public function removeSound(Sound $sound)
    {
        $this->sounds->removeElement($sound);
    }
}
