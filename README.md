<h1 align="center">
    <img alt="banner" title="#banner" src="https://restbom.herokuapp.com/images/logo.png" />
</h1>

<h4 align="center"> 
  🚧  Restbom 🍽️ Concluído 🍽️ 🚧
</h4>

<p align="center">
 <a href="#-sobre-o-projeto">Sobre</a> •
 <a href="#-funcionalidades">Funcionalidades</a> •
 <a href="#-layout">Layout</a> • 
 <a href="#-como-executar-o-projeto">Como executar</a> • 
 <a href="#-tecnologias">Tecnologias</a> • 
 <a href="#-contribuidores">Contribuidores</a> • 
 <a href="#-autor">Autor</a> • 
 <a href="#user-content--licença">Licença</a>
</p>


## 💻 Sobre o projeto

🍽️ O Restbom é um sistema de administração online para restaurantes, que gerencia os pedidos, acompanha o preparo e leva ao admistrador o relatório de vendas do seu estabelecimento. Prático e rápido, o Restbom leva a tecnologia até você. Link da aplicação: https://restbom.herokuapp.com/

---

## ⚙️ Funcionalidades

- [x] O administrador do posto tem acesso ao seu posto virtual contendo:
  - [x] Cadastro e visualização de combustíveis; 
  - [x] Cadastro e visualização de bombas;
  - [x] Tabela de vendas;
  - [x] Com isso, ele poderá: 
    - Gerenciar seu posto online;
    - Não necessitará de frentistas.


- [x] Os usuários tem acesso a tela da bomba, onde podem:
  - [x] Selecionar o combustível, a quantidade a ser abastecida e/ou o valor;
  - [x] Realizar a sua compra e abastecer o seu veículo.

---

## 🎨 Layout


### Mobile

<p align="center">
  <img alt="login-mobile" title="#login-mobile" src="https://restbom.herokuapp.com/images/mobile2.jpeg" width="200px">

  <img alt="home-mobile" title="#home-mobile" src="https://restbom.herokuapp.com/images/mobile1.jpeg" width="200px">
</p>

### Web

<p align="center" style="display: flex; align-items: flex-start; justify-content: center;">
  <img alt="login-web" title="#login-web" src="https://restbom.herokuapp.com/images/web2.png" width="400px">

  <img alt="home-web" title="#home-web" src="https://restbom.herokuapp.com/images/web1.png" width="400px">
</p>

---

## 🚀 Como executar o projeto

### Pré-requisitos

Antes de começar, você vai precisar ter instalado em sua máquina as seguintes ferramentas:
[Git](https://git-scm.com), [Xampp](https://www.apachefriends.org/pt_br/index.html). 
Além disto é bom ter um editor para trabalhar com o código como [Sublime Text](https://www.sublimetext.com/)

#### 🎲 Rodando o projeto

```bash

# Clone este repositório
$ git clone https://github.com/vitordaniel31/Restbom.git

# Acesse a pasta do projeto no terminal/cmd
$ cd Restbom

$ composer install

#crie o arquivo .env com o conteúdo do aruqivo .env.exemple na pasta raiz do projeto e configure-o

#gere a api_key
$ php artisan key:generate

#inicie o servidor
$ php artisan serve
# O servidor inciará na porta:8000 - acesse http://localhost:8000

```

---

## 🛠 Tecnologias

As seguintes ferramentas foram usadas na construção do projeto:

-   **[GitHub](https://github.com/)**
-   **[Heroku](https://www.heroku.com/)**
-   **[Laravel](https://laravel.com/)**
-   **[MySQL](https://www.mysql.com/)**
-   **[npm](https://www.npmjs.com/)**

> Veja o arquivo  [package.json](https://github.com/vitordaniel31/Restbom/blob/main/package.json)

## 👨‍💻 Contribuidores

<table>
  <tr>
    <td align="center"><a><img style="border-radius: 50%;" src="https://restbom.herokuapp.com/images/isadora.jpeg" width="100px;" alt=""/><br /><sub><b>Isadora Mariz</b></sub></a><br /></td>
    <td align="center"><a><img style="border-radius: 50%;" src="https://restbom.herokuapp.com/images/leandro.jpeg" width="100px;" alt=""/><br /><sub><b>Leandro Tomaz</b></sub></a><br /></td>
    <td align="center"><a><img style="border-radius: 50%;" src="https://restbom.herokuapp.com/images/maria.jpg" width="100px;" alt=""/><br /><sub><b>Maria Fernanda</b></sub></a><br /></td>
    <td align="center"><a><img style="border-radius: 50%;" src="https://restbom.herokuapp.com/images/vanessa.jpeg" width="100px;" alt=""/><br /><sub><b>Vanessa Maria</b></sub></a><br /></td> 
  </tr>
</table>

## ✒️ Autor

<a>
 <img style="border-radius: 50%;" src="https://avatars.githubusercontent.com/u/51799954?s=400&u=642e80143821cdf21858ef95e54fc020df455afc&v=4" width="100px;" alt=""/>
 <sub><b>Vitor Daniel</b></sub></a> <a href="https://github.com/vitordaniel31" title="">🚀</a>

---

## 📝 Licença

Este projeto esta sobe a licença [MIT](https://github.com/vitordaniel31/Restbom/blob/main/LICENCE).

