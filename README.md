# SISEDU 2024
Trabalho de Desenvolvimento Web II

Para rodar o projeto:
PHP 8.0 ou versões superiores,
Laravel Framework 9.0 ou versões superiores,
Composer 2.0 ou versões superiores,

1° Forma: 
Descompactando o arquivo zipado do projeto e adicionando o banco de dados manualmente a sua máquina usando o phpmyadmin ou qualquer ide mysql.

2° Forma:
Clonando o projeto do repositório github
I. git clone https://github.com/ribshow/SISEDU-2024
II.  copie o arquivo .env.example para a raiz do projeto com nome .env
III. adicione o banco de dados manualmente sua máquina usando o phpmyadmin ou outra ide mysql
IV. configure seu arquivo .env para conectar o banco ao projeto

Sobre o projeto:
Existem 3 tipos de usuário, aluno, professor e o administrador.

Aluno - pode ver suas notas caso possua, alterar seu nome, email e senha.

Professor - tem as mesmas funções do aluno, pode listar todos os alunos, editar informações cadastradas, deletar o usuário,
lançar notas para alunos, editar notas de alunos e excluir notas dos alunos.

Administrador - tem as mesmas funções dos outros 2 tipos de usuário, pode cadastrar um aluno e pode cadastrar um professor.

