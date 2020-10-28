<?php
namespace src;

define("BASE_URL", "http://projetoy.pc/");

class Config {
    const BASE_DIR = '';

    const DB_DRIVER = 'mysql';
    const DB_HOST = 'localhost';
    const DB_DATABASE = 'devsbook';
    CONST DB_USER = 'root';
    const DB_PASS = '';

    const ERROR_CONTROLLER = 'ErrorController';
    const DEFAULT_ACTION = 'index';
}