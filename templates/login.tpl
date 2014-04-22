{include file="header.tpl" title=Login} {include file="menu.tpl"} {include file="messagebox.tpl"}
<table>
    <h1>Welcome to PhpMeta. For more functions, please log in!</h1>
    <form method="POST" action="login.php">


        <tr>
            <td>Username</td>
            <td>
                <input type="text" name="loginUsername" placeholder="Loginname" autofocus />
            </td>
        </tr>
        <tr>
            <td>Password</td>
            <td>
                <input type="password" name="loginPassword" />
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit" value="Login" />
            </td>
        </tr>


    </form>
</table>
{if $registration}
<a onclick="showHide('register')" class="button">Register</a>
<table id="register" style="display:none">
    <form method="POST" action="login.php?action=register">

        <tr>
            <td>Username:</td>
            <td>
                <input type="text" name="registerUsername" placeholder="Username" />
            </td>
        </tr>
        <tr>
            <td>E-Mail:</td>
            <td>
                <input type="mail" name="registerEmail" placeholder="E-Mail" />
            </td>
        </tr>
        <tr>
            <td>Password:</td>
            <td>
                <input type="password" name="registerPassword" />
            </td>
        </tr>
        <tr>
            <td>Confirm password:</td>
            <td>
                <input type="password" name="registerPassword2" />
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit" value="Register" />
            </td>
        </tr>
    </form>
</table>
{/if}
<a href="README">See details</a>
{include file="footer.tpl"}
