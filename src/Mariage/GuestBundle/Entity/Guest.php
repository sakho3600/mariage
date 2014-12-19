<?php

namespace Mariage\GuestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Guest
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Mariage\GuestBundle\Entity\GuestRepository")
 */
class Guest
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateConf", type="datetime")
     */
    private $dateConf;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=50)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="family", type="string", length=50)
     */
    private $family;

    /**
     * @var boolean
     *
     * @ORM\Column(name="confirm", type="boolean")
     */
    private $confirm;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dateConf
     *
     * @param \DateTime $dateConf
     * @return Guest
     */
    public function setDateConf($dateConf)
    {
        $this->dateConf = $dateConf;

        return $this;
    }

    /**
     * Get dateConf
     *
     * @return \DateTime 
     */
    public function getDateConf()
    {
        return $this->dateConf;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return Guest
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set family
     *
     * @param string $family
     * @return Guest
     */
    public function setFamily($family)
    {
        $this->family = $family;

        return $this;
    }

    /**
     * Get family
     *
     * @return string 
     */
    public function getFamily()
    {
        return $this->family;
    }

    /**
     * Set confim
     *
     * @param boolean $confirm
     * @return Guest
     */
    public function setConfirm($confirm)
    {
        $this->confirm = $confirm;

        return $this;
    }

    /**
     * Get confim
     *
     * @return boolean 
     */
    public function getConfirm()
    {
        return $this->confirm;
    }
}
