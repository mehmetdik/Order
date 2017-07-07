<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductRepository")
 */
class Product
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
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity="\AppBundle\Entity\ProductCategory", mappedBy="product")
     */
    private $productCategory;

    /**
     * @ORM\OneToMany(targetEntity="\AppBundle\Entity\Orders", mappedBy="product")
     */
    private $orders;
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
     * @return Product
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
     * Set slug
     *
     * @param string $slug
     *
     * @return Product
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }


    /**
     * Add productCategory
     *
     * @param \AppBundle\Entity\ProductCategory $productCategory
     * @return Product
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



    /**
     * Add orders
     *
     * @param \AppBundle\Entity\Orders $orders
     * @return Product
     */
    public function addOrders(\AppBundle\Entity\Orders $orders)
    {
        $this->orders[] = $orders;
        return $this;
    }
    /**
     * Remove orders
     *
     * @param \AppBundle\Entity\Orders $orders
     */
    public function removeOrders(\AppBundle\Entity\orders $orders)
    {
        $this->orders->removeElement($orders);
    }
    /**
     * Get orders
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getorders()
    {
        return $this->orders;
    }
}

