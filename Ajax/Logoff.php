<?php

unset($_SESSION['Login']);
unset($_SESSION['Nome']);
unset($_SESSION['Sobrenome']);

if (isset($_COOKIE['Login'])){
    unset($_COOKIE['Login']); 
    unset($_COOKIE['Nome']); 
}

session_start();
session_destroy();
echo "Sessão Encerrada";