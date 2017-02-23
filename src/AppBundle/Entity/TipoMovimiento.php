<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TipoMovimiento
 *
 * @ORM\Table(name="tipo_movimiento")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TipoMovimientoRepository")
 */
class TipoMovimiento
{
    const GASTO = 0;
    const INGRESO = 1;

    /**
     * @return mixed
     */
    public function getMovimiento()
    {
        return $this->movimiento;
    }

    /**
     * @param mixed $movimiento
     */
    public function setMovimiento($movimiento)
    {
        $this->movimiento = $movimiento;
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
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;
    /**
     * @ORM\OneToMany(targetEntity="Movimiento", mappedBy="tipo")
     */
    private $movimiento;


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
     * Set nombre
     *
     * @param string $nombre
     * @return TipoMovimiento
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

}
