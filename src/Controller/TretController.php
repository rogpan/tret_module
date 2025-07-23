<?php

namespace Drupal\tret_module\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Drupal\Core\Controller\ControllerBase;

class TretController extends ControllerBase {
  public function gerarTret(Request $request) {
    if ($request->getMethod() === 'POST') {
      $nomeCompleto = mb_strtoupper($request->request->get('nome_completo', ''));
      $nip = mb_strtoupper($request->request->get('NipUsuario', ''));
      $postgrad = mb_strtoupper($request->request->get('post_grad', ''));
      $ip = mb_strtoupper($request->request->get('enderecoIp', ''));
      $mac = mb_strtoupper($request->request->get('enderecoFisico', ''));
      $id = mb_strtoupper($request->request->get('idMaq', ''));

      date_default_timezone_set('America/Sao_Paulo');
      $dia = date('d');
      $mes = date('m');
      $ano = date('Y');
      $meses = ['janeiro','fevereiro','mar\u00e7o','abril','maio','junho','julho','agosto','setembro','outubro','novembro','dezembro'];
      $mesTexto = $meses[intval($mes) - 1];
      $data = "Rio de Janeiro, $dia de $mesTexto de $ano.";

      $html = <<<HTML
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>TRET - {$nomeCompleto}</title>
  
<style>
  @page {
    size: A4;
    margin: 2cm;
  }

  body {
    font-family: 'Carlito', sans-serif;
    font-size: 11pt;
    margin: 0;
  }

  #corpotret {
    width: 100%;
    text-align: justify;
  }

  #titulotret {
    text-align: center;
    font-weight: bold;
    margin-top: 1cm;
  }

  #datatret {
    text-align: right;
    margin-top: 1cm;
  }

  #textotret {
    margin-top: 1cm;
  }

  #assinaturatret {
    width: 100%;
    margin-top: 1cm;
    text-align: center;
  }

  .digital-tag {
    font-style: italic;
    font-size: 10pt;
    color: #555;
  }

  button {
    margin: 1cm 1cm 0 0;
  }

  ol {
    list-style-type: lower-alpha;
  }

  /* Ocultar elementos desnecessários na impressão */
  @media print {
    button {
      display: none;
    }

    body {
      width: auto;
      height: auto;
    }
  }
</style>

  <script>
    function fechar_formulario(){window.location.href='/drupal10/web/tret';}
  </script>
</head>
<body>
  <div id="corpotret">
    <div id="titulotret">
      MARINHA DO BRASIL<br>
      BASE DE FUZILEIROS NAVAIS DO RIO MERITI<br>
      TERMO DE RECEBIMENTO DE ESTAÇÃO DE TRABALHO
    </div>
    <div id="datatret">{$data}</div>
    <div id="textotret">
      Pelo presente instrumento, eu, <b>{$postgrad} {$nomeCompleto}, {$nip}</b>, perante a Marinha do Brasil, doravante denominada MB, na qualidade de usuário do ambiente computacional de propriedade daquela Instituição, <b>declaro ter recebido desta OM</b> uma estação de trabalho com as seguintes configurações:
      <div id="identificatret">
        I – de identificação:<br>
        <ol>
          <li>endereço IP: {$ip}</li>
          <li>endereço físico de rede: {$mac}</li>
          <li>identificação da máquina: {$id}</li>
        </ol>
      </div>
      <div id="programastret">
        II – de instalação de programas:
        <ol>
        a) Sistema Operacional: Ubuntu 22.04 LTS MB, Ubuntu 24.04 LTS MB;</br>
        b) Pré-Instalados (Antivírus Kaspersky, Libre Office, Mozila FireFox, Adobe Acrobat Reader, 7-zip ou WinRAR, Eraser, PDF Creator e Oracle Java SE);
        </ol>
        III – de senha de acesso à máquina (“boot”), inicialmente estabelecida pelo Administrador da Rede Local (ADMIN) da OM e por mim alterada, sendo agora de meu conhecimento; e
</br></br>
IV – de senha de configuração (“setup”), de conhecimento exclusivo do ADMIN e dos militares pertencentes à Seção de Informática e à qual não devo tomar conhecimento.
</div>
      <br>
     Assim, quaisquer alterações ou inclusões nos dados acima são de minha inteira responsabilidade e devem ser previamente autorizadas pelo Oficial de Segurança das Informações e Comunicações (OSIC), conforme previsto nas normas de Segurança das Informações Digitais da OM. </br>
      <br>Estou ciente que o ADMIN(executou) a “formatação” prévia dos discos rígidos da referida estação de trabalho e sua correspondente reconfiguração e que, a qualquer momento e sempre que julgar necessário, poderei solicitar ao  ADMIN auxílio para a realização dessa “formatação”, de modo a garantir a configuração padronizada da OM e a inexistência de arquivos ou programas irregulares.</br>    
    </div>
    <div id="assinaturatret">
      <hr style="width:50%;">
      <p><b>{$postgrad} {$nomeCompleto}
       <p><b>{$nip}</b></p>
      
    </div>
    <div>
      <button onclick="fechar_formulario()">Voltar</button>
      <button onclick="window.print()">Salvar em PDF</button>
    </div>
  </div>
</body>
</html>
HTML;

      return new Response($html);
    }

    return new Response('Acesse este endpoint via POST a partir do formul\u00e1rio.');
  }
}
