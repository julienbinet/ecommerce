<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Tva
 *
 * @ORM\Table(name="tva")
 * @ORM\Entity
 */
class Tva
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="multiplicate", type="float", precision=10, scale=0, nullable=false)
     */
    private $multiplicate;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=125, nullable=false)
     */
    private $nom;

    /**
     * @var float
     *
     * @ORM\Column(name="valeur", type="float", precision=10, scale=0, nullable=false)
     */
    private $valeur;


}

