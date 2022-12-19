<?php

namespace Modules\Lgpd\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Lgpd\Models\PageLgpd;
use Illuminate\Support\Facades\Schema;

class LgpdDatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected $body_page = '<h4><strong>POLÍTICA DE PRIVACIDADE</strong></h4><p>Esta página apresenta a política de privacidade deste website descrevendo os tipos de informações pessoais que podem ser coletados em nosso website e como estas serão utilizadas para melhor prestar os nossos serviços. Os dados coletados durante a sua navegação neste site são aqueles estritamente necessários para as finalidades às quais se destinam e estes não serão alugados, vendidos ou compartilhados em nenhuma circunstância sem a sua autorização expressa. Usando este website você concorda com a coleta e uso de suas informações pessoais como descrito neste documento.</p><h4><strong>SOBRE DADOS E SEGURANÇA</strong></h4><p>Todas as informações que coletamos são armazenadas em ambientes operacionais seguros não disponíveis ao acesso público e nossa equipe está capacitada a manter e defender a sua privacidade e segurança. Infelizmente não é possível a garantia total de qualquer transmissão de dados pela Internet, porém utilizamos as mais atuais ferramentas para proteger suas informações pessoais e até o momento não houve nenhum histórico de vazamento de dados de nossos sistemas na Internet.</p><h4><strong>SOBRE O ENDEREÇO IP</strong></h4><p>O endereço IP é um número utilizado pelos computadores na Internet para identificar o seu computador como único em um dado momento. Como a maioria dos sistemas que operam na Internet, nossos servidores web automaticamente também coletam seu endereço IP como “dados de tráfego” para as necessidades técnicas relacionadas principalmente com a sua de segurança e este não será utilizado para qualquer outra finalidade.</p><h4><strong>SOBRE COOKIES</strong></h4><p>Um cookie é um pequeno arquivo de dados que é enviado para o seu computador quando você visita um website. Assim como ocorre nos demais websites atuais, nossos cookies operam com o objetivo de otimizar a sua experiência de navegação e incluem um número de identificação que é exclusivo para o computador que você está usando. Este identificador nos ajuda a compreender melhor nossa base de usuários e como eles estão usando o nosso site e serviços. Você como usuário visitante possui a alternativa de configurar seu navegador para ser avisado sobre a recepção dos “cookies” e impedir a sua instalação no disco rígido. As informações pertinentes a esta configuração estão disponíveis em instruções e manuais do próprio navegador, entretanto algumas características deste site podem ser limitadas em caso de bloqueio de cookies. Este website irá utilizar as informações obtidas por intermédio dos cookies para analisar as páginas navegadas pelo usuário e suas pesquisas, bem como para melhorar as iniciativas comerciais e promocionais, apresentar publicidade ou promoções, banners de maior interesse, notícias sobre a nossa empresa e aperfeiçoar as ofertas de nossos conteúdos, bens e serviços.</p><h4><strong>SOBRE PIXEL DE CONTROLE OU WEB BEACONS</strong></h4><p>Um Pixel de controle é uma imagem eletrônica, web beacon, pixel transparente ou ainda semgle-pixel (1x1) tem finalidades similares aos Cookies. Adicionalmente um Pixel de Controle é utilizado para medir padrões de tráfego dos utilizadores quando navegam entre páginas com objetivo de maximizar o fluxo de tráfego através da web. Este website utiliza deste recurso para nos capacitar a melhorar a experiência de nossos visitantes.</p><h4><strong>SOBRE OS LOGS</strong></h4><p>Como implementação de segurança as atividades realizadas pelos usuários deste site são registradas por meio de LOGs que informam o endereço IP, o ID da sessão, as páginas acessadas pelo usuário, as datas e horários de acesso.</p><h4><strong>CONFIDENCIALIDADE</strong></h4><p>As informações pessoais inseridas neste website ou nos e-mails que por ele trafegarem são consideradas confidenciais, não podendo estas ser revelados a terceiros ressalvados os casos de ordem e/ou pedido e/ou determinação judicial.</p><h4><strong>SOBRE LINKS EXTERNOS</strong></h4><p>Este website pode conter links para outros desenvolvidos e controlados por terceiros e as práticas de privacidade e segurança destes não estão abrangidas por esta política de privacidade.</p><h4><strong>CONTATO COM O USUÁRIO</strong></h4><p>A partir do momento em que um visitante deste website inserir informações pessoais este poderá ser o destinatário de alguma divulgação e se isto ocorrer este terá a oportunidade de optar por não mais recebê-la. Em nenhuma circunstância será enviada comunicações não solicitadas a respeito de ofertas comerciais ou anúncios se você tiver optado por não receber esse tipo de informação.</p><h4><strong>SOBRE ESTA POLÍTICA DE PRIVACIDADE</strong></h4><p>Esta Política de Privacidade foi elaborada em agosto de 2020. Reservamo-nos ao direito de alterar ou atualizar a nossa Política de Privacidade a qualquer momento.</p>';
    protected $table = 'lgpd';

    public function run() {
        //Model::unguard();

        if (Schema::hasTable($this->table)) {
            $ret = PageLgpd::all();
            if (!$ret && is_null($ret) || $ret->count() == 0) {
                PageLgpd::create([
                    'page_title' => 'Política de Privacidade',
                    'page_body' => $this->body_page,
                    'slug' => 'politica-de-privacidade',
                    'modal_title' => 'Modal cookie',
                    'modal_body' => 'Você sabe o que são cookies? 🍪 Usamos cookies para garantir que você obtenha a melhor experiência em nosso site.',
                    'seo_title' => 'Política de Privacidade',
                    'seo_description' => 'Esta página apresenta a política de privacidade deste website descrevendo os tipos de informações pessoais que podem ser coletados em nosso website e como estas serão utilizadas para melhor prestar os nossos serviços.',
                    'seo_keywords' => 'Política de Privacidade, política de privacidade, politica de privacidade',
                ]);
            }
        }
    }

}
