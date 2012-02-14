{include file="header.tpl" title=Setup}
{include file="messagebox.tpl"}
<h1>Setup</h1>
<p>Welcome to the Setup. Choose your art of installation:</p>
<form action="setup.php" method="get">
  <p>
    <input type="radio" name="install" value="complete"> Complete Setup (Create new Tables, don't overwrite existing structure)<br>
    <input type="radio" name="install" value="force"> Force Installation (Does overwrite a installation if necessary)<br>
  </p>
  <input type="submit" value="Install" />
</form>



{include file="footer.tpl"}