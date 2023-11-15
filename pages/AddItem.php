<?php
if (!isset($_COOKIE['Theme'])){
    setcookie("Theme", "Day", time() + (10 * 365 * 24 * 60 * 60));
}

if (isset($_COOKIE['ThemeSession'])){
    if ($_COOKIE['ThemeSession'] == 'Moon'){
        $_COOKIE['Theme'] = 'Moon';
    } else if ($_COOKIE['ThemeSession'] == 'Sun'){
        $_COOKIE['Theme'] = 'Sun';
    }
}

if (isset($_COOKIE['Theme'])){
    if ($_COOKIE['Theme'] == 'Moon'){
        echo "<script>ThemeChange('Moon', false);</script>";
    } else if ($_COOKIE['Theme'] == 'Sun'){
        echo "<script>ThemeChange('Sun', false);</script>";
    }
}

require_once (realpath (__DIR__ .'./../src/startPage.php'));

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar item</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="./items.css">
</head>
<body>

    <div class="TypeChoose">
        <ul>
            <li class="ChangeType Comp">Componentes</li>
            <li class="ChangeType Forn">Fornecedores</li>
        </ul>
    </div>
    <div class="Comps">
        <div class="search">
            <input placeholder="Pesquisar..." type="text" id="Pesquisa">
            <button class="Add-Item">Adicionar Item</button>
        </div>
        <table class="input-table table-main none">
            <tr class="input-tr">
                <td colspan="2" class="td-input" ><input type="text" name="" class="input-item Comp"></td>
                <td class="td-input" ><input type="text" name="" class="input-item Desc"></td>
                <td class="td-input" ><input type="text" name="" class="input-item Desenho"></td>
                <td class="td-input" ><input type="text" name="" class="input-item Forn"></td>
                <td class="td-input" ><input type="text" name="" class="input-item Aplic"></td>
                <td class="td-input" ><button class="Criar-Item">Criar</button></td>
            </tr>
        </table>
        <table class="table-main">
            <thead>
                <th>Seq.</th>
                <th>Componente</th>
                <th>Descrição</th>
                <th>Desenho</th>
                <th>Forn</th>
                <th>Aplicação</th>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>C 004 005</td>
                    <td>Rotor BA EA211</td>
                    <td>04E 121 121C</td>
                    <td>Ensinger</td>
                    <td>VW 01 30</td>
                </tr>
            </tbody>
        </table>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="./items.js"></script>
</html>