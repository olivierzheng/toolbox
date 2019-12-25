<?xml version="1.0" encoding="UTF-8"?>

<xsl:stylesheet version="1.0"
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="/">
  <h2>Admins</h2>
  <table border="1">
    <tr bgcolor="#9acd32">
      <th style="text-align:left">Name</th>
      <th style="text-align:left">Hash</th>
      <th style="text-align:left">Permission</th>
    </tr>
    <xsl:for-each select="config/mgt-config/users/entry">
    <tr>
      <td><xsl:value-of select="@name" /></td>
      <td><xsl:value-of select="phash" /></td>
      <td><xsl:value-of select="permissions" /></td>
    </tr>
    </xsl:for-each>
  </table>

  <h2>Rulebase</h2>
  <h3>Security</h3>
  <table border="1">
    <tr bgcolor="#9acd32">
      <th style="text-align:left">Vsys</th>
      <th style="text-align:left">Rule</th>
      
    </tr>
    <xsl:for-each select="config/devices/entry/vsys/entry">
    <tr>
      <td><xsl:value-of select="@name" /></td>
        <xsl:for-each select="rulebase/security/rules/entry">
        <tr>
        <td><xsl:value-of select="@name" /></td>
        <td><xsl:value-of select="action" /></td>
        <td><xsl:value-of select="from" /></td>
        <td><xsl:value-of select="source" /></td>
        <td><xsl:value-of select="to" /></td>
        <td><xsl:value-of select="destination" /></td>
        <td><xsl:value-of select="application" /></td>
        <td><xsl:value-of select="service" /></td>
        <td><xsl:value-of select="profile-setting" /></td>
        <td><xsl:value-of select="disabled" /></td>
        </tr>
        </xsl:for-each>
    </tr>
    </xsl:for-each>
  </table>

<h3>NAT</h3>
  <table border="1">
    <tr bgcolor="#9acd32">
      <th style="text-align:left">Vsys</th>
      <th style="text-align:left">Rule</th>
      
    </tr>
    <xsl:for-each select="config/devices/entry/vsys/entry">
    <tr>
      <td><xsl:value-of select="@name" /></td>
        <xsl:for-each select="rulebase/nat/rules/entry">
        <tr>
        <td><xsl:value-of select="@name" /></td>
        <td><xsl:value-of select="from" /></td>
        <td><xsl:value-of select="source" /></td>
        <td><xsl:value-of select="to" /></td>
        <td><xsl:value-of select="destination" /></td>
        </tr>
        </xsl:for-each>
    </tr>
    </xsl:for-each>
  </table>


</xsl:template>

</xsl:stylesheet>