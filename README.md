
# Plugin Local
Template para criação de plugins locais no Moodle. Caso queira estudar os arquivos base do plugin, [clique aqui](https://moodledev.io/docs/4.4/apis/commonfiles).

## Como configurar
Clone o repositório com o nome do plugin que irá ser criado.
```
git clone https://github.com/FrancioXavier/plugin-local-template.git nome_do_plugin
```

## Editar arquivo Version.php com as informações do plugin:
```
$plugin->component = 'local_meu_plugin;
$plugin->version = 2024052200;
$plugin->requires = 2022041900.40;
$plugin->maturity = MATURITY_ALPHA;
$plugin->release = 'v0.0.1';
```

- component: tipo e nome do plugin.
- version: lançamento do plugin em ano (2024), mês (05), dia (22).
- requires: qual versão do moodle é obrigatória.
- maturity: Nível de maturidade do plugin.
- release: numeração de versão do plugin.

## Atualizar nome dos arquivos e das funções com o nome do seu plugin

Atualize nome dos arquivos (como os arquivos da pasta Lang por exemplo) com o nome do plugin e das funções do projeto, como por exemplo do do arqivo install.php:

```
function xmldb_local_meu_plugin_install() {
}
```

o nome 'meu_plugin' deve ser trocado pelo nome do plugin, 'local' deve ser mantido por ser o tipo do plugin.

## instalação do plugin no Moodle
Após configurar tudo, crie um .zip da pasta do plugin e adicione como um novo plugin em configurações admin -> plugins -> adicionar novo plugin.
