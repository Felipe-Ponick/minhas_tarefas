<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Tarefa</title>
</head>
<body>
    <h2>Cadastro de Tarefa</h2>
    <form action="/tarefas/cadastrar" method="post">
        <label for="id_usuario">ID do Usuário:</label>
        <input type="text" id="id_usuario" name="id_usuario" required><br><br>
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" required><br><br>
        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao" required></textarea><br><br>
        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>
