<?php
namespace Main\DataImportBundle\Entity;

use HireVoice\Neo4j\Annotation as OGM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * All entity classes must be declared as such.
 *
 * @OGM\Entity
 */
class LegalCase
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
    protected $caseNumber; 
    
    
    /**
     * @OGM\Property
     */
    protected $disposition;
    
      /**
     * @OGM\ManyToMany(relation="DEFENDING_ATTORNEY")
     */
    protected $defenders;
    
    /**
     * @OGM\ManyToMany(relation="PROSECUTING_ATTORNEY")
     */
    protected $prosecutors;


    function __construct()
    {
        $this->defenders = new ArrayCollection;
        $this->prosecutors = new ArrayCollection;
    }

    /* Add your accessors here */
    
    

    public function getId()
    {
        return $this->id;
    }
    
    
    
    function setCaseNumber($caseNumber)
    {
        
        return $this->caseNumber= $caseNumber;
        
    }
    
    
    
    function getCaseNumber()
    {
        
        return $this->caseNumber;
        
    }
    
    
     function getDisposition()
    {
        return $this->disposition;
    }
    
    
     function setDisposition($disposition)
    {
        
        $this->disposition = $disposition;
        
    }
    
    
    
    function addDefender(\Main\DataImportBundle\Entity\Lawyer $lawyer)
    {
        
        return $this->defenders[] = $lawyer;
        
    }
    
    
    
    function getDefenders()
    {
        return $this->defenders;   
    }
    
    
    
     function addProsecutor(\Main\DataImportBundle\Entity\Lawyer $lawyer)
    {
        
        return $this->prosecutors[] = $lawyer;
        
    }
    
    
    
    function getProsecutors()
    {
        return $this->prosecutors;   
    }

    
    
}
