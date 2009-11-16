{include file="header.tpl" title=Setup}
{include file="messagebox.tpl"}
<h1>Setup</h1>
<p>Welcome to the Setup. Choose your art of installation:</p>
<form action="input_radio.htm">
  <p>Geben Sie Ihre Zahlungsweise an:</p>
  <p>
    <input type="radio" name="Zahlmethode" value="complete"> Complete Setup (Create new Tables, don't overwrite existing structure)<br>
    <input type="radio" name="Zahlmethode" value="force"> Force Installation (<br>
    <input type="radio" name="Zahlmethode" value="AmericanExpress"> American Express
  </p>
</form>



{include file="footer.tpl"}