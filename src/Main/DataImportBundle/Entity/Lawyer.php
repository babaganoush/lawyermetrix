<?php
namespace Main\DataImportBundle\Entity;

use HireVoice\Neo4j\Annotation as OGM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * All entity classes must be declared as such.
 *
 * @OGM\Entity
 */
class Lawyer
{
    /**
     * The internal node ID from Neo4j must be stored. Thus an Auto field is required
     * @OGM\Auto
     */
    protected $id;
    
    
     /**
     * @OGM\Property
     * @OGM\Index
     */
    protected $barId; 
    

    /**
     * @OGM\Property
     */
    protected $fullName;
    


    function __construct()
    {
    //    $this->legalCases = new ArrayCollection;
    }

    /* Add your accessors here */
    
    

     function getId()
    {
        return $this->id;
    }
    
    
     function setBarId($barId)
    {
        
        $this->barId = $barId;
        
    }
    
    function getBarId()
    {
        
        return $this->barId;
    }
    
    
    function setFullName($fullName)
    {
        
        $this->fullName = $fullName;
        
    }
    
    function getFullName()
    {
        
        return $this->fullName;
    }
    
    
    
    
    
    
}
