<?php
session_start();
session_unset(); // Limpa todas as variáveis de sessão
session_destroy(); // Destroi a sessão

// Redireciona para a página de login com a mensagem como parâmetro de URL
header("Location: login.php?mensagem=" . urlencode("Deslogado com sucesso!"));
exit();
