#Instruções para execução
O projeto foi executado usando o framework Laravel, 
então nas configurações do arquivo .ENV, que fica na raiz do projeto, 
coloque os dados do seu banco de dados, 
depois disso execute o comando 'php artisan migrate' para gerar as tabelas, 
e em seguida o comando 'php artisan serve', 
e pode seguir com as rotas abaixo descritas

desde já obrigado pela oportunidade


#Rota de cadastro de usuario
/registrar/EMAIL/SENHA/NOME

#Rota para login
/logar/EMAIL/SENHA

#Rota para deslogar do sistema
/sair

#Rota para os dados pessoais do usuario logado
/dadosUsuario

##Rotas das faturas

#Rota cadastro fatura
/faturas/cadastrar?status=VALOR&url=VALOR&vencimento=VALOR

#Rota Buscar fatura
/faturas/buscar/IDFATURA

#Rota Lista de faturas
/faturas

#Rota editar fatura
/faturas/editar/IDFATURA?status=VALOR&url=VALOR&vencimento=VALOR

#Rota excluir fatura
/faturas/excluir/IDFATURA
