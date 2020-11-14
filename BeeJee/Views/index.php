<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <!-- Brand -->
  <?php	if ($auth) : ?>  
		<a class="navbar-brand" href="#">Привет администратор</a>
	<?php else : ?>
		<a class="navbar-brand" href="/login">Войти</a>
	<?php endif;  ?>
  <!-- Links -->
    <ul class="navbar-nav" i>
       <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Сортировать
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="./?page=1&sort=email">по email</a>
        <a class="dropdown-item" href="./?page=1&sort=login">по имени пользователя</a>
        <a class="dropdown-item" href="./?page=1&sort=verified">по статусу</a>
      </div>
      <?php	if ($auth) : ?>  
     	<li class="nav-item">
     	 <a class="nav-link" href="./login/logout">Выйти</a>
    	</li> 
	  <?php endif;  ?>
  </ul>
</nav>

<body>
<div class="container mt-3">
<form method="POST" action="/index/add">
	<div class="form-group">
    <label for="user">Имя пользователя</label>
    <input type="user" class="form-control" id="user" name="login" required>
    
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" required>

  <label for="comment">Текст задачи</label>
  <textarea class="form-control" rows="5" id="comment" name="task_name" required></textarea>
  <button type="submit" class="btn btn-primary">Добавить</button>
  </div> 
 </div>
</form> 

<div class='tasks'>
	<div class="card">
  		<div class="card-body"> 
   <?php if(isset($_SESSION['success'])) : ?>
			<div class="alert alert-success" role="alert"><?=$_SESSION['success']?></div>		
	<?php unset($_SESSION['success']); endif; ?>
<?php foreach ($args as $arg) : ?>	
		<?php if ($auth) : ?>
		<form method="POST" action="/index/update">
			  <div class="form-check">
			    	<?php if($arg['verified'] == 1) :?>
			    		<input type="checkbox" class="form-check-input" id="comment" name="checked" checked>
			    	<?php else :?>
			    		<input type="checkbox" class="form-check-input"  name="checked">
			    	<?php endif; ?>
			    <label class="form-check-label" for="check">Проверено</label>
			  </div><br />
			<input type="text" name="login" id="comment" value="<?=$arg['login']?> "><br />
			<input type="text" name="email" id="comment" value="<?=$arg['email']?>"><br /> 
			<textarea name="task_name" id="comment" value=""><?=$arg['task_name']?></textarea><br /><br />
			<input type="hidden" name="id" value="<?=$arg['id']?>">
			<button type="submit" class="btn btn-primary btn-sm ml-5">Редактировать</button><br /><br />
		</form>
		<?php else : ?>
				<?php if ($arg['verified'] == 1) : ?>
					<span class='badge badge-success ml-2'>Проверено</span>
				<?php endif; ?>	
						<?php if ($arg['edited'] == 1 ) : ?>
								<span class='badge badge-success ml-2'>Отредактировано</span><br />
						<?php endif; ?>	
		    <?=$arg['login']?> 
			<br> 
			<?=$arg['email']?> 
			<br> 
			<?=$arg['task_name']?>
			<br> <br>
		<?php endif; ?>
<?php endforeach; ?>
  		</div>
				<?=$links->get();?>	
		</div>
</div>

</body>
</html>