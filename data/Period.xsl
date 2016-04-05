<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : Week.xsl
    Created on : April 5, 2016, 10:26 AM
    Author     : dkim
    Description:
        Purpose of transformation follows.
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html"/>

    <!-- TODO customize transformation rules 
         syntax recommendation http://www.w3.org/TR/xslt 
    -->
    <xsl:template match="/">
        <h1>Start time based XSL</h1>
        <table class="table table-bordered table-condensed myreport">
            <xsl:call-template name="headings"/>
            <xsl:apply-templates select="/timetable/period"/>            
        </table>
    </xsl:template>
    
    <!-- Trends for headings -->
    <xsl:template name="headings">
        <thead>
            <tr>
                <th></th>
                <xsl:for-each select="timetable/period/booking">
                    <th>
                        <xsl:value-of select="./@day"/>
                    </th>                   
                </xsl:for-each>
            </tr>
        </thead>
    </xsl:template>
    
    <xsl:template match="period">
        <tr>
            <td>
                <xsl:value-of select="./@start"/>
            </td>
            <xsl:for-each select="booking/name">
                <td>
                    <xsl:value-of select="."/>
                </td>                   
            </xsl:for-each>       
        </tr>
    </xsl:template>

</xsl:stylesheet>
