<?php
//******
//Antes criar o banco com o mesmo nome que está no .env.example
header('Content-Type: text/html; charset=utf-8');
require_once __DIR__.'/app/Classes/Functions.php';
$functions = new \App\Classes\Functions();
$array = $functions->server();
$php = $array['php'];
$composer = $array['composer'];
$php_eol1 = PHP_EOL;

echo '1 - Instalação do composer.' . $php_eol1;
system('cp composer.example.json composer.json');
system($composer . ' install --prefer-dist --no-dev -o');

echo $php_eol1 . '2 - Copiando o arquivo .env.' . $php_eol1;

if (!file_exists('.env')) {
    system('cp .env.example .env');
}

echo $php_eol1 . '3 - Key Generate.' . $php_eol1;
system($php . '  artisan key:generate');

echo $php_eol1 . '4 - Storage Link.' . $php_eol1;
system($php . '  artisan storage:link');

echo $php_eol1 . '5 - Executando pacotes - Sem pacotes.' . $php_eol1;
system($php.'  artisan config:cache');

echo $php_eol1 . '6 - Executando Migrate geral.' . $php_eol1;
system($php . '  artisan migrate');


echo $php_eol1 . '7 - Executando Seed geral.' . $php_eol1;
system($php . ' artisan db:seed');
system($php . ' artisan module:seed');

echo $php_eol1 . '8 - Executando vendor:publish.' . $php_eol1;
system($php.'  artisan vendor:publish --provider="Nwidart\Modules\LaravelModulesServiceProvider"');


echo $php_eol1 . '9 - Limpar todos os CACHES!' . $php_eol1;
system($php.'  artisan optimize:clear');

system($php.'  artisan cache:clear');

system($php.'  artisan config:clear');

system($php.'  artisan view:clear');

system($php.'  artisan route:clear');

system($php.'  artisan config:cache');
 
echo $php_eol1 . '10 - Criando menu dos módulos.' . $php_eol1;
system($php.'  artisan menu:make');

echo $php_eol1 . 'Fim.' . $php_eol1;

echo $php_eol1 . 'Dados para acesso.' . $php_eol1;
echo $php_eol1 . 'Usuário: admin@admin.com.br' . $php_eol1;
echo $php_eol1 . 'Senha: 123456' . $php_eol1;

system('php artisan serve --port=8010');

