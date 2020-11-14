<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="/">Назад</a>

</nav>

<body>
	<div class="container mt-3">
   <?php if(isset($_SESSION['error'])) : ?>
      <div class="alert alert-danger" role="alert"><?=$_SESSION['error']?></div>   
  <?php unset($_SESSION['error']); endif; ?>
	<form method="POST" action="/login/login">
	<div class="form-group">
    <label for="user">Имя пользователя</label>
    <input type="user" class="form-control" id="user" name="login" required>
    
    <label for="password">Пароль</label>
    <input type="password" class="form-control" id="password" name="password" required>

    <button type="submit" class="btn btn-primary">Войти</button>
</div>

  </div> 
 </div>

</form> 


</body>