# SISEDU 2024
**Trabalho de Desenvolvimento Web II**

**Para rodar o projeto:**
- **PHP 8.0** ou versões superiores
- **Laravel Framework 9.0** ou versões superiores
- **Composer 2.0** ou versões superiores

**1° Forma:**
- Descompactando o arquivo zipado do projeto e adicionando o banco de dados manualmente a sua máquina usando o **phpMyAdmin** ou qualquer IDE **MySQL**.

**2° Forma:**
- **Clonando o projeto do repositório GitHub:**
    1. `git clone https://github.com/ribshow/SISEDU-2024`
    2. Copie o arquivo `.env.example` para a raiz do projeto com o nome `.env`
    3. Adicione o banco de dados manualmente à sua máquina usando o **phpMyAdmin** ou outra IDE **MySQL**
    4. Configure seu arquivo `.env` para conectar o banco ao projeto

**Sobre o projeto:**
Existem 3 tipos de usuário: **aluno**, **professor** e o **administrador**.

**Aluno**
- Pode ver suas notas caso possua
- Alterar seu nome, email e senha

**Professor**
- Tem as mesmas funções do aluno
- Pode listar todos os alunos, editar informações cadastradas, deletar o usuário
- Lançar notas para alunos, editar notas de alunos e excluir notas dos alunos

**Administrador**
- Tem as mesmas funções dos outros 2 tipos de usuário
- Pode cadastrar um aluno e pode cadastrar um professor


