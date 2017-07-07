<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoryRepository")
 */
class Category
{
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="\AppBundle\Entity\ProductCategory", mappedBy="category")
     */
    private $productCategory;

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
     * Set name
     *
     * @param string $name
     *
     * @return Category
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



    /**
     * Add productCategory
     *
     * @param \AppBundle\Entity\ProductCategory $productCategory
     * @return Category
     */
    public function addProductCategory(\AppBundle\Entity\ProductCategory $productCategory)
    {
        $this->productCategory[] = $productCategory;
        return $this;
    }
    /**
     * Remove productCategory
     *
     * @param \AppBundle\Entity\ProductCategory $productCategory
     */
    public function removeProductCategory(\AppBundle\Entity\ProductCategory $productCategory)
    {
        $this->productCategory->removeElement($productCategory);
    }
    /**
     * Get productCategory
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProductCategory()
    {
        return $this->productCategory;
    }
}

