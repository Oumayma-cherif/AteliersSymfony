<?php

namespace App\Entity;

use App\Repository\EtudiantRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EtudiantRepository::class)
 */
class Etudiant
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $nsc;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity=Classroom::class, inversedBy="etudiants")
     */
    private $classroom;



    /**
     * @return mixed
     */
    public function getNsc()
    {
        return $this->nsc;
    }

    /**
     * @param mixed $nsc
     */
    public function setNsc($nsc): self
    {
        $this->nsc = $nsc;
        return $this;
    }



    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getClassroom(): ?Classroom
    {
        return $this->classroom;
    }

    public function setClassroom(?Classroom $classroom): self
    {
        $this->classroom = $classroom;

        return $this;
    }


}
