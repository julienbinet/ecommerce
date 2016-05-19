<?php

namespace EcommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Media
 *
 * @ORM\Table(name="media")
 * @ORM\Entity(repositoryClass="EcommerceBundle\Repository\MediaRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Media {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    public $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank
     */
    public $path;
    
       /**
     * @Assert\File(maxSize="6000000")
     */
    public $file;

    private $temp;
    
       /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        // check if we have an old image path
        if (isset($this->path)) {
            // store the old name to delete after the update
            $this->temp = $this->path;
            $this->path = null;
        } else {
            $this->path = null;
        }
    }
    
    public function getUploadDir() {
        return __DIR__ . "/../../../web/uploads";
    }

    public function getAbsolutePath() {
        return null === $this->path ? null : $this->getUploadDir() . '/' . $this->path;
    }

    public function getAssetPath() {
        return 'uploads/'.$this->path;
    }
    
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload() {

        if (null !== $this->file) {
            $this->path = sha1(uniqid(mt_rand(), true)) . '.' . $this->file->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload() {

//        var_dump($this->getUploadDir(), $this->path);die('upload');
        
        if (null !== $this->file) {
            $this->file->move($this->getUploadDir(), $this->path);
            unset($this->file);
        }

        if ($this->temp !== null)
            unlink($this->getUploadDir() . '/' .$this->temp);
    }

    /**
     * @ORM\PreRemove()
     */
    public function preRemoveUpload() {
        $this->temp = $this->getAbsolutePath();
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload() {
        if (file_exists($this->temp)) {
            unlink($this->getUploadDir() . '/' .$this->temp);
        }
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    public function getPath() {
        return $this->path;
    }

    
        /**
     * Set path
     *
     * @param boolean $path
     *
     * @return string
     */
    public function setPath($path) {
        $this->path = $path;

        return $this;
    }
    
     
        /**
     * Set name
     *
     * @param boolean $name
     *
     * @return string
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }
    
    

    public function getName() {
        return $this->name;
    }

}
