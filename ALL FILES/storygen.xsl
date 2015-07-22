<?xml version="1.0" ?>

<!-- This xslt document takes GET parameters from storygen.php, and using them, 
transforms story-data.xml into the requested story, generating an html document
corresponding to 1 page of the book. Links to the following page, preceeding page
and home, are also generated, as well as an image for every page. An external link
to flip.js is included, which provides the xml-http-request for the page-turning
animation - Todd Baert, 102490961-->


<xsl:stylesheet 
	version="1.0" 
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform" 
>
  
<xsl:param name="title" />
<xsl:param name="story" />
<xsl:param name="hero" />
<xsl:param name="villain" />
<xsl:param name="lair" />
<xsl:param name="page" />

<xsl:output
	method="html"
	encoding="utf-8"
	omit-xml-declaration="yes"
	indent="yes"
/>

<xsl:strip-space elements="span div"/>

<xsl:template match="/">
		<xsl:text disable-output-escaping="yes">&lt;!DOCTYPE html>
		</xsl:text>  
	<html>
		<head>
                        <!-- book title -->
			<title><xsl:value-of select="$title" /></title>
			<link rel="stylesheet" type="text/css" href="css/book.css" />
			
			<!-- javascript to handle the page-turn animation-->
                        <script src="flip.js"></script> 
		</head>
		<body>
		    <div id="storybook">
			
			
			<div id="pagetext">
			    
			    <xsl:if test="$page = 0">
				<xsl:call-template name="titlepage"/>
			    </xsl:if>
			    
			    <xsl:if test="$page != 0">
				<xsl:call-template name="choosestory"/>
				
				<div id="image">
				    <xsl:if test="$page != 2">
					<img src="{concat('images/',$hero,$page,'.jpg')}" alt="Hero"/>
				    </xsl:if>

				    <xsl:if test="$page = 2">
					<img src="{concat('images/',$villain,'.jpg')}" alt="Villain"/>
				    </xsl:if>
				</div>
				
			    </xsl:if>
			</div>
			
			<div id="flipprev"><img src="images/flipclear.png"/></div>
			
			<div id="links">        
                            
			    <span id="prevlink">
				<xsl:if test="$page &gt;= 1">
				    <xsl:call-template name="prev"/>
				</xsl:if>
			    </span>
			    
			    <span id="homelink">
				<xsl:call-template name="home"/>
			    </span>
			    
			    <span id="nextlink">
				<xsl:if test="$page &lt; 3">
				<xsl:call-template name="next"/>
				</xsl:if>
			    </span>
                            
                            
                            
                            
			</div>
			    
			<div id="flipnext"><img src="images/flipclear.png"/></div>
			    
		    </div>
		    

    </body> 
    
	</html>
</xsl:template>

<xsl:template name ="titlepage">
    <div id="title">	        
	<xsl:value-of select="$title"/>
    </div>  
</xsl:template>

<xsl:template match="hero" name ="hero">
    <span class="hero">
	<xsl:value-of select="$hero"/>
    </span>
</xsl:template>

<xsl:template match="villain" name ="villain">
    <span class="villain">
	<xsl:value-of select="$villain"/>
    </span>
</xsl:template>

<xsl:template match="lair" name ="lair">
    <span class="lair">
	<xsl:value-of select="$lair"/>
    </span>
</xsl:template>


<xsl:template name="choosestory">
    <xsl:for-each select="//page">
        <xsl:if test="(pagenumber = $page) and (../storynumber = $story)">

              <xsl:apply-templates select="text"/>
       
        </xsl:if>
    </xsl:for-each>
</xsl:template>

<xsl:template match="homelink" name ="home">
<a href="home.php">Home</a>
</xsl:template>

<xsl:template match="prevlink" name ="prev" >
    <a name="prev" onmouseover="xmlhttpflipPrev()" onmouseout="flipclear()" href="{concat('storygen.php?title=',$title,'&amp;story=',$story,'&amp;hero=',$hero,'&amp;villain=',$villain,'&amp;lair=',$lair,'&amp;page=',($page - 1))}">Previous Page</a>
</xsl:template>

<xsl:template match="nextlink" name ="next" >
    <a name ="next" onmouseover="xmlhttpflipNext()" onmouseout="flipclear()" href="{concat('storygen.php?title=',$title,'&amp;story=',$story,'&amp;hero=',$hero,'&amp;villain=',$villain,'&amp;lair=',$lair,'&amp;page=',($page + 1))}">Next Page</a>
</xsl:template>

<xsl:template match="@*|comment()|processing-instruction()" />
</xsl:stylesheet>


