<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * PhoneNumber
 *
 * @ORM\Table(name="phone", indexes={@ORM\Index(name="user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class PhoneNumber
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="phone_no", type="string", length=12, nullable=false, options={"fixed"=true})
     *
     * @Assert\NotBlank
     * @Assert\Regex(
     *     pattern="/^\d{3} \d{3}-\d{4}/",
     *     match=true,
     *     message="PhoneNumber format should be '/\d{3} \d{3}-\d{4}/'"
     * )
     *
     */
    private $phoneNo;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="phoneNumbers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     *
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getPhoneNo(): ?string
    {
        return $this->phoneNo;
    }

    public function setPhoneNo(string $phoneNo): self
    {
        $this->phoneNo = $phoneNo;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }


}
