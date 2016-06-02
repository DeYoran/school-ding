<form action="/gameshop/addGame" method="POST">
    <table id="login">
        <tr>
            <td>naam:</td>
            <td><input name="naam" ></td>
        </tr>
        <tr>
            <td>releasedatum:</td>
            <td><input type='date' name="datum" /></td>
        </tr>
        <tr>
            <td>inkoopprijs:</td>
            <td><input type='number' name="inkoop" /></td>
        </tr>
        <tr>
            <td>verkoopprijs:</td>
            <td><input type='number' name="verkoop" /></td>
        </tr>
        <tr>
            <td>platformen:</td>
            <td>
            <input type='checkbox' value='ps 4' name="platform[]" />Playstation 4<br />
            <input type='checkbox' value='xbox one' name="platform[]" />Xbox 1<br />
            <input type='checkbox' value='pc' name="platform[]" />Pc<br />
            <input type='checkbox' value='wii       u' name="platform[]        " />Wii U<br />
        </td>
        <tr>
            <td>Type:</td>
            <td>
            <input type='radio' value='voorverkoop' name="type" />Voorverkoop<br />
            <input type='radio' value='special' name="type" />Speciale editie<br />
            <input type='radio' value='none' name="type" />Geen voorverkoop
        </td>
        </tr>
        <tr>
            <td></td>
            <td><input  type="submit" /></td>
        </tr>
    </table>
</form>