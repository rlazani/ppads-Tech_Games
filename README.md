# ppads-Tech_Games

Repositório criado para disciplina PRÁTICA PROFISSIONAL EM ANÁLISE E DESENVOLVIMENTO DE SISTEMAS, Grupo Tech Games

O sistema desenvolvido até a primeira iteração (branch master / tag v1) foi descartado pois passamos a utilizar uma abordagem baseada em Dao para acessar o banco de dados e foi mais fácil reiniciar o código. 

O sistema atual encontra-se no branch iteração 2.

##############


LISTA COM REQUISITOS DE HARDWARE / SOFTWARE:

Sistema Operacional Windows, Linux, ou Macintosh

Pacote de desenvolvimento XAMPP compatível com o sistema operacional. Esse pacote contém todas as dependências para o desenvolvimento PHP em um computador pessoal: Servidor Apache, Banco de Dados MariaDB, PHP.

Browser Chorme, Firefox ou Edge. 


##############


INSTRUÇÕES PARA EXECUÇÃO EM COMPUTADOR PESSOAL:

1 - Pacote XAMPP: 
Esse software foi desenvolvido localmente utilizando o pacote "XAMPP", que contém MySQL e Apache e todas as dependências necessárias para o desenvolvimento de uma aplicação web em PHP. Esse pacote deve ser baixado no endereço eletrônico https://www.apachefriends.org/pt_br/index.html

2 - Pasta hotdocs:
Após extraído, o arquivo zip da tag v2 terá o nome de <ppads-Tech_Games-2.0>. Essa pasta deve ser copiada dentro da pasta xampp/hotdocs


3 - Inicialização do Apache e MySQL:
Para iniciar o servidor Apache e o banco de dados, abrir o XAMPP Control Panel e clicar nos botões Start referentes ao módulo Apache e MySQL. Os nomes Apache e MySQL devem ficar verdes e os números dos Ports devem aparecer. 

4- Criação do banco de dados:
O banco de dados da aplicação pode ser acessado via browser no endereço localhost/phpmyadmin. Depois, clicar na aba MySQl para inserir os comandos SQL abaixo de criação do banco de dados e tables. Algumas colunas não estão sendo utilizadas no projeto e serão cortadas e/ou renomeadas na próxima versão. 


CREATE DATABASE browsergames; 

USE browsergames; 


CREATE TABLE users ( 

id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,  

name VARCHAR(100), 

lastname VARCHAR(100),  

email  VARCHAR(200),  

password VARCHAR(200),  

image VARCHAR(200),  

token VARCHAR(200),  

bio TEXT 

); 


CREATE TABLE membros ( 

id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,  

name VARCHAR(100), 

lastname VARCHAR(100),  

email  VARCHAR(200),  

password VARCHAR(200),  

image VARCHAR(200),  

token VARCHAR(200),  

bio TEXT 

); 


CREATE TABLE movies ( 

Id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,  

title VARCHAR(100),  

description TEXT,  

image VARCHAR(200),  

trailer VARCHAR(150),  

category VARCHAR(50),  

length VARCHAR(50),  

users_id INT(11) UNSIGNED,  

FOREIGN KEY(users_id) REFERENCES  users(id) 

); 


CREATE TABLE reviews( 

Id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,  

Rating INT,  

Review TEXT,  

Users_id INT(11) UNSIGNED,  

FOREIGN KEY (users_id) REFERENCES users(id),  

FOREIGN KEY (movies_id) REFERENCES movies(id) 

); 



5- Acessando o aplicativo:
O aplicativo pode ser acessado via browser no endereço localhost/ppads-Tech_Games-2.0. Depois de acessado, é possível criar uma conta de membro clicando no link Login/Cadastro e uma conta de administrador no botão Admin. Ambos os links estão localizados na menu superior. Após a criação das contas, é possível realizar as operações de membro ou de administrador conforme a documentação do projeto. A criação de conta do Administrador foi necessária pois o banco de dados estará vazio, então será necessário criar um administrador localmente, mas quando o aplicativo estiver online, essa funcionalidade será excluída. 

Obs: No documento de especificação foram colocadas algumas imagens das instruções e algumas telas do aplicativo. 
