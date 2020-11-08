<?php

namespace App\Entity;

use App\Repository\DowntimeCommentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DowntimeCommentRepository::class)
 */
class DowntimeComment extends Comment
{
    /**
     * @ORM\ManyToOne(targetEntity=Downtime::class, inversedBy="comments")
     */
    private $downtime;

    public function getDowntime(): ?Downtime
    {
        return $this->downtime;
    }

    public function setDowntime(?Downtime $downtime): self
    {
        $this->downtime = $downtime;

        return $this;
    }
}
