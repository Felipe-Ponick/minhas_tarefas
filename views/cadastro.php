<?php include_once "../views/layout/header.php"; ?>

<div id="login">
<div class="w-25"> <h1 class="text-center">Cadastrar Usuário</h1></div>
<form action="/cadastro" method="POST">
    <div class="form-group pb-2">
        <input id="nome" name="nome" placeholder="Digite seu nome">
    </div>
    <div class="form-group pb-2">
        <input name="email" placeholder="Digite seu email">
    </div>
    <div class="form-group pb-2">
        <input name="login" placeholder="Digite seu login">
    </div>
     <div class="form-group pb-2">
        <input name="password" placeholder="Digite sua senha">
    </div>
     <div class="form-group pb-2">
        <button type="submmit">Cadastrar</button>
    </div>
     <div class="form-group pb-2">
        <a href="/login">Entrar com uma conta existente</a>
    </div>
</form>
</div>
<?php include_once "../views/layout/footer.php"; ?>