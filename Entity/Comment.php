<?php

namespace Sensorario\CommentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sensorario\CommentBundle\Entity\Comment
 *
 * @ORM\Table(name="billing_comment")
 * @ORM\Entity(repositoryClass="Sensorario\CommentBundle\Entity\CommentRepository")
 */
class Comment
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer $id
     *
     * @ORM\Column(name="unique_id", type="string", length="50", nullable="true")
     */
    private $unique_id;

    /**
     * @var object $author
     *
     * @ORM\Column(name="author", type="string", length=255)
     */
    private $author;

    /**
     * @var string $comment
     *
     * @ORM\Column(name="comment", type="string", length=140)
     */
    private $comment;

    /**
     * @var datetime $creation_date
     *
     * @ORM\Column(name="creation_date", type="datetime")
     */
    private $creation_date;

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
     * Set author
     *
     * @param object $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * Get author
     *
     * @return object 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set comment
     *
     * @param string $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set creation_date
     *
     * @param datetime $creationDate
     */
    public function setCreationDate($creationDate)
    {
        $this->creation_date = $creationDate;
    }

    /**
     * Get creation_date
     *
     * @return datetime 
     */
    public function getCreationDate()
    {
        return $this->creation_date;
    }

    /**
     * Set unique_id
     *
     * @param string $uniqueId
     */
    public function setUniqueId($uniqueId)
    {
        $this->unique_id = $uniqueId;
    }

    /**
     * Get unique_id
     *
     * @return string 
     */
    public function getUniqueId()
    {
        return $this->unique_id;
    }

}