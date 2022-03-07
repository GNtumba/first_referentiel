<?php

namespace App\Entity;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AgriculturalActivityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Entity\Utils\TimestampTrait;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=AgriculturalActivityRepository::class)
 * @ORM\HasLifecycleCallbacks()
 * @ApiResource(
 *      normalizationContext={"groups": {"read:agriculcollection","timestamp:read","slug:read"}},
 *      collectionOperations={
 *         "agriculural-activities-vue"={
 *             "method"="GET",
 *             "path"="/agricultural-activities",
 *             "openapi_context"={
 *                  "summary"= "Voir les activités agricoles"
 *              }
 *          },
 *         "post"={
 *             "method"="POST",
 *             "path"="/agricultural-activities",
 *             "denormalization_context"={"groups":{"write:AgriculturalActivity"}},
 *             "openapi_context"={
 *                  "summary"= "Ajouter une activité agricole"
 *              }
 *         }
 *      },
 *      itemOperations={
 *         "get"={
 *            "method"="GET",
 *             "path"="/agricultural-activities/{id}",
 *             "openapi_context"={
 *                  "summary"= "Modifier une activité agricole"
 *              }
 *          } ,
 *         "agricultural-activities-update"={
 *            "denormalization_context"={"groups":{"write:AgriculturalActivity"}},
 *            "method"="PATCH",
 *             "path"="/agricultural-activities/{id}",
 *             "openapi_context"={
 *                  "summary"= "Modifier une activité agricole"
 *              }
 *          } 
 *       } 
 * )
 */
class AgriculturalActivity
{

    use TimestampTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read:productor:activities_data","read:agriculcollection"})
     */
    private $id;

    

    /**
     * @ORM\Column(type="text")
     * @Groups({"read:productor:activities_data","write:AgriculturalActivity","read:agriculcollection"})
     * @Assert\NotNull
     * @Assert\Type("string")
     */
    private $goal;

    /**
     * @ORM\ManyToOne(targetEntity=Productor::class, inversedBy="AgriculturalActivity")
     */
    private $productor;

    /**
     * @ORM\ManyToOne(targetEntity=ExploitedArea::class, inversedBy="agriculturalActivities")
     * @Groups({"read:productor:activities_data","write:AgriculturalActivity","read:agriculcollection"})
     * @Assert\NotNull
     */
    private $exploitedArea;

    /**
     * @ORM\ManyToOne(targetEntity=SourceOfSupplyActivity::class)
     * @Groups({"read:productor:activities_data","write:AgriculturalActivity","read:agriculcollection"})
     * @Assert\NotNull
     */
    private $sourceOfSupplyActivity;

    /**
     * @ORM\ManyToOne(targetEntity=Address::class, inversedBy="agriculturalActivities")
     */
    private $adress;


    /*
    * @Groups({"read:agriculcollection"})
    */
    public function getIri(): string
    {
        return '/api/agricultural-activities/'. $this->id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getGoal(): ?string
    {
        return $this->goal;
    }

    public function setGoal(string $goal): self
    {
        $this->goal = $goal;

        return $this;
    }

    public function getProductor(): ?Productor
    {
        return $this->productor;
    }

    public function setProductor(?Productor $productor): self
    {
        $this->productor = $productor;

        return $this;
    }

    public function getExploitedArea(): ?ExploitedArea
    {
        return $this->exploitedArea;
    }

    public function setExploitedArea(?ExploitedArea $exploitedArea): self
    {
        $this->exploitedArea = $exploitedArea;

        return $this;
    }

    public function getSourceOfSupplyActivity(): ?SourceOfSupplyActivity
    {
        return $this->sourceOfSupplyActivity;
    }

    public function setSourceOfSupplyActivity(?SourceOfSupplyActivity $sourceOfSupplyActivity): self
    {
        $this->sourceOfSupplyActivity = $sourceOfSupplyActivity;

        return $this;
    }

    public function getAdress(): ?Address
    {
        return $this->adress;
    }

    public function setAdress(?Address $adress): self
    {
        $this->adress = $adress;

        return $this;
    }
}
