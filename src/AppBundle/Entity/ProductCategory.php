<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductCategory
 *
 * @ORM\Table(name="product_category")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductCategoryRepository")
 */
class ProductCategory
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
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\Category", inversedBy="productCategory")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;


    /**
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\Product", inversedBy="productCategory")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    private $product;


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
     * Set category
     *
     * @param \AppBundle\Entity\Category $category
     * @return ProductCategory
     */
    public function setCategory(\AppBundle\Entity\Category $category = null)
    {
        $this->category = $category;
        return $this;
    }
    /**
     * Get category
     *
     * @return \AppBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }


    /**
     * Set product
     *
     * @param \AppBundle\Entity\Product $product
     * @return ProductCategory
     */
    public function setProduct(\AppBundle\Entity\Product $product = null)
    {
        $this->product = $product;
        return $this;
    }
    /**
     * Get product
     *
     * @return \AppBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }

}

