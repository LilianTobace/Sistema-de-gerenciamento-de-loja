O gerenciamento é uma das características mais importantes dos locais comerciais, responsável por controlar o caixa, estoque de produtos, cadastro de clientes e funcionários e geração de relatórios a fim de que haja uma administração eficiente e eficaz. Para a realização deste projeto será utilizada, como exemplo, uma empresa de enxovais da cidade de Ibitinga do estado de São Paulo como modelo. O sistema atenderá às necessidades administrativas de uma firma que comercializa produtos não perecíveis. O foco deste projeto é a utilização de dados do sistema para gerenciamento de vendas, cadastro de funcionários, fornecedores, clientes, despesas, estoques e produtos, além de gerar relatórios e realizar promoções, sendo um sistema simples, prático e intuitivo, para um comércio de pequeno porte, voltado para a venda por atacado.  
Este sistema foi desenvolvido como projeto final de conclusão de curso, por isso a documentação deste sistema se encontra no link a seguir: https://drive.google.com/file/d/1w-ZF8OpHMJp5GYkmuBO3i-MdcGkyeIip/view?usp=sharing
 

# CakePHP Application Skeleton

[![Build Status](https://img.shields.io/travis/cakephp/app/master.svg?style=flat-square)](https://travis-ci.org/cakephp/app)
[![Total Downloads](https://img.shields.io/packagist/dt/cakephp/app.svg?style=flat-square)](https://packagist.org/packages/cakephp/app)

A skeleton for creating applications with [CakePHP](https://cakephp.org) 3.x.

The framework source code can be found here: [cakephp/cakephp](https://github.com/cakephp/cakephp).

## Installation

1. Download [Composer](https://getcomposer.org/doc/00-intro.md) or update `composer self-update`.
2. Run `php composer.phar create-project --prefer-dist cakephp/app [app_name]`.

If Composer is installed globally, run

```bash
composer create-project --prefer-dist cakephp/app
```

In case you want to use a custom app dir name (e.g. `/myapp/`):

```bash
composer create-project --prefer-dist cakephp/app myapp
```

You can now either use your machine's webserver to view the default home page, or start
up the built-in webserver with:

```bash
bin/cake server -p 8765
```

Then visit `http://localhost:8765` to see the welcome page.

## Update

Since this skeleton is a starting point for your application and various files
would have been modified as per your needs, there isn't a way to provide
automated upgrades, so you have to do any updates manually.

## Configuration

Read and edit `config/app.php` and setup the `'Datasources'` and any other
configuration relevant for your application.

## Layout

The app skeleton uses a subset of [Foundation](http://foundation.zurb.com/) (v5) CSS
framework by default. You can, however, replace it with any other library or
custom styles.
