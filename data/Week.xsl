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

    <xsl:template match="/">
        <h1>Day based XSL</h1>
        <table class="table table-bordered table-condensed myreport">
            <xsl:call-template name="headings"/>
            <xsl:apply-templates select="/timetable/day"/>            
        </table>
    </xsl:template>
    
    <!-- Trends for headings -->
    <xsl:template name="headings">
        <thead>
            <tr>
                <th></th>
                <xsl:for-each select="/timetable/day/booking/period">
                    <th>
                        <xsl:value-of select="./@start"/>
                    </th>                   
                </xsl:for-each>
            </tr>
        </thead>
    </xsl:template>
    
    <xsl:template match="day">
        <tr>
            <td>
                <xsl:value-of select="./@day"/>
            </td>
            <xsl:for-each select="booking/name">
                <td>
                    <xsl:value-of select="."/>
                </td>                   
            </xsl:for-each>       
        </tr>
    </xsl:template>

</xsl:stylesheet>
