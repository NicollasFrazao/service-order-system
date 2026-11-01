# Service Order System

A PHP + MySQL web application for managing service orders at a repair shop: customers, devices, the services performed on each device, and a printable service order.

Context: freelance project for a computer and mobile-device repair shop, in use around 2016. Author: Nícollas Frazão. The interface is in Brazilian Portuguese.

## What it does

- **Login** for shop users (`tb_usuario`), stored in the PHP session.
- **Service order wizard** in three steps, with progress kept in a cookie so an unfinished order can be resumed:
  1. Customer: search an existing customer by RG, CPF or code, or register a new one (name, RG, CPF, two phone numbers, address, reference notes).
  2. Devices: add one or more devices to the order. A device has a category, brand and model (cascading selects) and is identified by IMEI and secondary IMEI or by serial number, depending on the category. An existing device is found again by IMEI or serial number.
  3. Order data: assigned employee, status, and the budget, start, completion, pickup and expiration dates, plus notes.
- **Services per device**: each device in an order carries a list of services with supplier, cost and price; the order search shows total cost, total price and profit.
- **Order search** by verification code, filtered by status, with links to print or delete an order.
- **Printable service order** (`ImprimirOrdem.php`): customer, devices, services and the shop's warranty terms, formatted for printing from the browser.
- **Maintenance screens** for employees, suppliers, customers, categories, brands and models, with batched add/edit/delete that is saved in one request.
- Client-side field validation and input masks (CPF, phone, dates, names) through a custom validation script in `js/`.

## Tech stack

- PHP 5 (procedural pages plus a small `Conexao` class over `mysqli`; input escaping uses `mysql_escape_string`, which was removed in PHP 7)
- MySQL
- Vanilla JavaScript with a hand-written XMLHttpRequest helper (`js/ajax.js`), jQuery 1.11.2 and jQuery UI 1.11.4
- HTML/CSS written by hand, no framework

## Running locally

The database schema and data are not included, so the application only runs against a database you create by hand.

1. Use PHP 5.6 (or older 5.x) with the `mysql` and `mysqli` extensions and a MySQL server.
2. Create a database and the tables the code expects:
   `tb_usuario`, `tb_cliente`, `tb_categoria`, `tb_marca`, `tb_modelo`, `tb_aparelho`, `tb_os`, `item_os` (order to device link), `tb_servico`, `tb_fornecedor`, `tb_funcionario`, `tb_status`.
   Column names can be read from the queries in `php/` (for example `tb_os.cd_verificador`, `tb_servico.vl_custo`, `tb_servico.vl_preco`).
3. Set the host, user, password and database name in `php/ConexaoPrincipal.php` (the committed values are placeholders).
4. Serve the folder, for example `php -S localhost:8000`, and open `login.php`.

Passwords are stored base64-encoded; a plain-text password in `tb_usuario.cd_senha` is accepted once and rewritten as base64 on the next login.

## Project structure

```
index.php                     Main single-page UI: order wizard, search, maintenance screens
login.php                     Login screen
ImprimirOrdem.php             Printable service order (linked from the order search)
ModeloImprimirOrdem*.php      Alternative print layouts; the PDF one needs mPDF in pdf/, not included
php/                          Endpoints called through AJAX (Cadastrar*, Buscar*, Finalizar*, ...)
js/                           Validation script, AJAX helper, jQuery, jQuery UI
images/                       Menu icons
```

Endpoints answer with plain text in the form `status;-;message;-;data`, parsed on the client.

## Notes

This is legacy code, kept as a portfolio sample:

- SQL is built by string concatenation; escaping relies on the removed `mysql_escape_string`, so the code does not run on PHP 7 or later without changes.
- Only `index.php` checks the session. The AJAX endpoints in `php/` and the print page do not.
- Passwords are base64-encoded, not hashed.
- Business rules live in a single 3,900-line `index.php` mixing PHP, HTML, CSS and JavaScript.
- `ModeloImprimirOrdemPDF.php` depends on mPDF (`pdf/mpdf.php`), which is not in the repository.
- `teste.txt` and `php/Teste.php` are leftovers from development.
- There are no automated tests.
