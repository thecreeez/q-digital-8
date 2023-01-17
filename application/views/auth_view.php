<form method="POST" action="/auth/post" class="form-signin">
    <h1 class="h3 mb-3 font-weight-normal">Вход</h1>
    <label for="inputLogin" class="sr-only">Логин</label>
    <input type="text" id="inputLogin" class="form-control" placeholder="Логин" name="login" required="" autofocus="">
    <label for="inputPassword" class="sr-only">Пароль</label>
    <input type="password" id="inputPassword" class="form-control mb-2" placeholder="Пароль" name="password" required="">
    <button class="btn btn-lg btn-primary btn-block" type="submit" name="requestType" value="LOGIN">Войти</button>
    <p class="mt-3 mb-1 text-muted">Для регистрации просто введите желаемый логин и пароль</p>
</form>