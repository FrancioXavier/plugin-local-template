<?php

/**
 * @package  meu_plugin
 * @copyright 2017, Mohammed Essaid MEZERREG <me@mohessaid.com>
 * @license MIT
 * @doc 
 */

// Allows you to execute a PHP code right after the plugin's database scheme has been installed.
 
defined('MOODLE_INTERNAL') || die();

function xmldb_local_meu_plugin_install() {
    global $DB;

    // Cria a tabela local_meu_plugin_table.
    $dbman = $DB->get_manager();

    // Definir a tabela.
    $table = new xmldb_table('local_meu_plugin_table');

    // Adicionar campos à tabela.
    $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
    $table->add_field('name', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null);
    $table->add_field('value', XMLDB_TYPE_TEXT, null, null, null, null, null);

    // Adicionar chave primária.
    $table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));

    // Criar a tabela se não existir.
    if (!$dbman->table_exists($table)) {
        $dbman->create_table($table);
    }

    return true;
}