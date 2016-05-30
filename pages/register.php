<div class="errorlog"></div>
<form autocomplete="off" id="registerForm">
    <label class="form-label in-line" for="username">Choose username: </label>
    <input id="regUsername" name="username" maxlength="20" placeholder="Username" type="text"><br/>
    <label class="form-label in-line" for="regPassword">Choose password: </label>
    <input id="regPassword" name="password" placeholder="Password" type="password"><br/>
    <label class="form-label in-line" for="captcha">Code below: </label>
    <input id="captcha" name="captcha" maxlength="4" placeholder="Code" type="text"><br/>
    <img onclick="this.src = this.src + '#'" src="system/captcha.php" alt="capcha"/><br/>
    <input class="button" onclick="register()" name="submit" type="button" value="Register">
</form>