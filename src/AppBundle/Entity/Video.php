<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Video
 *
 * @ORM\Table(name="video")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VideoRepository")
 */
class Video
{
    public function __construct() {
        $this->videos = new ArrayCollection();
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @var string
     *
     * @ORM\Column(name="urlVideo", type="string", length=100)
     */
    private $urlVideo;

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
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    public function setSounds($sounds)
    {
        $this->sounds = $sounds;
    }

    /**
     * @return mixed
     */
    public function getSounds()
    {
        return $this->sounds;
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
     * @return mixed
     */
    public function getUrlVideo()
    {
        return $this->urlVideo;
    }

    /**
     * @param mixed $urlVideo
     */
    public function setUrlVideo($urlVideo)
    {
        $this->urlVideo = $urlVideo;
    }



}

