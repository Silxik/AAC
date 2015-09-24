<style>
    .registerForm {
        background: #000;
        text-align: center;
        padding: 10px;
    }
</style>
<form autocomplete="off" class="registerForm">
    <label for="username">Choose username: </label>
    <input id="regUsername" name="username" maxlength="20" placeholder="Username" type="text"><br/>
    <label for="password">Choose password: </label>
    <input id="regPassword" name="password" placeholder="Password" type="password"><br/>
    <label for="captcha">Code below: </label>
    <input id="captcha" name="captcha" maxlength="4" placeholder="Code" type="text"><br/>
    <img onclick="this.src = this.src + '#'" src="system/captcha.php"/><br/>
    <input class="button" onclick="register('<?= BASE_URL ?>')" name="submit" type="button" value="Register">
</form>