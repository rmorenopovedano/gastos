<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Movimiento
 *
 * @ORM\Table(name="movimiento")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MovimientoRepository")
 */
class Movimiento
{
    const ENERO ='Enero';
    const FEBRERO= 'Febrero';
    const MARZO= 'Marzo';
    const ABRIL= 'Abril';
    const MAYO= 'Mayo';
    const JUNIO= 'Junio';
    const JULIO= 'Julio';
    const AGOSTO= 'Agosto';
    const SEPTIEMBRE= 'Septiembre';
    const OCTUBRE= 'Octubre';
    const NOVIEMBRE= 'Noviembre';
    const DICIEMBRE= 'Diciembre';
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
     * @Assert\NotBlank(message="This field cannot be empty.")
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\ManyToOne(targetEntity="TipoMovimiento", inversedBy="movimiento")
     * @ORM\JoinColumn(name="tipo_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255)
     */
    private $descripcion;

    /**
     * @var float
     * @Assert\Type(type="float", message="Introduce un valor correcto")
     *@Assert\NotBlank(message="This field cannot be empty.")
     * @ORM\Column(name="cantidad", type="float")
     */
    private $cantidad;

    /**
     * @var string
     *
     * @ORM\Column(name="mes", type="string")
     */
    private $mes;

    public function getTypeName() {
        switch($this->getMes()) {
            case self::ENERO: return 'Enero';
            case self::FEBRERO: return 'Febrero';
            case self::MARZO: return 'Marzo';
            case self::ABRIL: return 'Abril';
            case self::MAYO: return 'Mayo';
            case self::JUNIO: return 'Junio';
            case self::JULIO: return 'Julio';
            case self::AGOSTO: return 'Agosto';
            case self::SEPTIEMBRE: return 'Septiembre';
            case self::OCTUBRE: return 'Octubre';
            case self::NOVIEMBRE: return 'Noviembre';
            case self::DICIEMBRE: return 'Diciembre';
        }
        return '';
    }
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
     * Set tipo
     *
     * @param string $tipo
     * @return Movimiento
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Movimiento
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set cantidad
     *
     * @param integer $cantidad
     * @return Movimiento
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return integer 
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set mes
     *
     * @param string $mes
     * @return Movimiento
     */
    public function setMes($mes)
    {
        $this->mes = $mes;

        return $this;
    }

    /**
     * Get mes
     *
     * @return string 
     */
    public function getMes()
    {
        return $this->mes;
    }

    /**
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->getNombre();
    }
}
