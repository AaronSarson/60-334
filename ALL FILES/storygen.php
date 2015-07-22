<?php

/* This script passes all the parameters required for storygen.xsl to parse the
 * correct story. Todd Baert, 102490961 */

if ($_SERVER['REQUEST_METHOD'] != 'GET') {
    exit(0);
}

$title=$_GET['title'];
$story=$_GET['story'];
$hero=$_GET['hero'];
$villain=$_GET['villain'];
$lair=$_GET['lair'];
$page=$_GET['page'];


	$xml = new DOMDocument;
	$xml->load('story-data.xml');

	$xsl = new DOMDocument;
	$xsl->load('storygen.xsl');

	$proc = new XSLTProcessor();
	$proc->importStylesheet($xsl);		

  if ($title != null && $story != null && $hero != null && $villain != null && $lair != null)
  {
   
    $proc->setParameter(null, 'title', $title);
    $proc->setParameter(null, 'story', $story);	   
    $proc->setParameter(null, 'hero', $hero);
    $proc->setParameter(null, 'villain', $villain);
    $proc->setParameter(null, 'lair', $lair);
    $proc->setParameter(null, 'page', $page);
      
  }

  echo $proc->transformToXML($xml);
?>