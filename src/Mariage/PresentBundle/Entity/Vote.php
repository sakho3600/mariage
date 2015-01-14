<?php

namespace Mariage\PresentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vote
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Mariage\PresentBundle\Entity\VoteRepository")
 */
class Vote
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
     * @ORM\Column(name="dateVote", type="date")
     */
    private $dateVote;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=20)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="ipAddress", type="string", length=50)
     */
    private $ipAddress;


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
     * Get dateVote
     *
     * @return \DateTime 
     */
    public function getDateVote()
    {
        return $this->dateVote;
    }


    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }


    /**
     * Get ipAddress
     *
     * @return string
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }


    public function __construct($country, $ip)
    {
        $this->dateVote = new \DateTime;
        $this->country = $country;
        $this->ipAddress = $ip;
    }

}
