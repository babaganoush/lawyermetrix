<?php

namespace Main\DataImportBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Everyman\Neo4j;
use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;
use Goodby\CSV\Import\Standard\LexerConfig;

// use Main\DataImportBundle\Entity\Lawyer;
// use Main\DataImportBundle\Entity\LegalCase;

class DefaultController extends Controller {

    public function indexAction() {
        return $this->render('MainDataImportBundle:Default:index.html.twig');
    }

    public function importAction($county) {
        
        

        echo "importing county: [" . $county . "]...<br />";

        $client = new Neo4j\Client();

        $monthlyDispositionFeed = array();

        $config = new LexerConfig();
        $config->setDelimiter("\t")
                ->setFromCharset('UTF-8');
        $lexer = new Lexer($config);

        $interpreter = new Interpreter();
        $interpreter->unstrict();

        $count = 0;

        $interpreter->addObserver(function(array $row) use (&$monthlyDispositionFeed,&$count) {
                    $count+=1;

                    if ($count < 3) {

                        return;
                    } 
                    $monthlyDispositionFeed[] = array(
                        'court_number' => $row[6],
                        'offence_code' => $row[10],
                        'case_status_code' => $row[7],
                        'offence_code_literal' => $row[11],
                        'defendent_name' => $row[16],
                        'defendent_sex' => $row[19],
                        'defendent_dob' => $row[20],
                        'defendent_attorney' => $row[26],
                        'defendent_date' => $row[30],
                        'disposition' => $row[31],
                        'sentence' => $row[32],
                        
                    );
                });

        $lexer->parse('../../county_data/harris/2013-06-06 CrimDisposMonthly.txt', $interpreter);

        echo "<pre>";
        print_r($monthlyDispositionFeed);
        echo "</pre>";


        return new Response('import completed for county: ' . $county);
    }

}
