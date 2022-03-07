# Sistema de Controle de Documentos

Ultima Atualizacao: 13/12/2021

## Objetivo:
   Realizar o controle de arquivamentos dos documentos, facilitando a localização 
   dos documentos arquivados nas caixas.

## Caracteristicas:
 
 1) multi-empresa
 2) Controle Local:Arquivo/Corredor/Estante/Prateleira/Caixa
 3) Controle de Documentos Por Setor
 4) Classificação de Tipo de Documentos
 5) Varios filtro para realizar a localização do documentos arquivados
 6) Site Responsivo

## Procedimento de Instalação:
1) Executar Script para criação do banco de dados
    - documentation\bd_arquivo2021.sql
   
2) Login de acesso:

   Login: administrador@email.com
   senha: 123456
   
   login:supervisor@email.com
   senha:123456
   
 3) URL de acesso ao sistema:
    pasta:Nome da pasta onde foi copiado os fontes 
    maquina local: localhost/\<pasta\>

 4) Sistema esta publicado na url abaixo:
    https://sisarqv2.000webhostapp.com/

## Algumas Funcionalidades:
   1) Menu Dinamico
   2) Controle de Acesso da Opcoes do Sistema por Usuario
   3) Controle de Incluir,Alterar,Excluir e Consultar dados por Usuario
   4) Bloqueio de Acesso de Usuario
   5) Liberação de menu so apos a implementação do Processo
   6) Bloqueio de acesso do usuario, não permite que mesmo usuario se logar mais de uma vez simultaneamente

## Tecnologia Utilizadas:
    1. PHP puro
    2. HTML
    3, CSS
    4. JAVA SCRIPT
    5. BOOTSTRAP
    6. AJAX
    7. MYSQL

## Correções Pendentes/melhorias
   1. Implementar tratamento de erro nas rotina de inclusão.(Chave primaria)
   2. Link Inicio , erro de pagina na existe
   3. Criar indice unico da tabela de menu/usuario constraint de indice unid usuario/menu
   4. Quando do cadastro de acesso do menu não apresentar no combobox se o menu ja estiver cadastrado para usuario
   5. Cadastro de documento,, Ver Formatacao de data esta como mm/dd/yyyy
   6. Quando da Alteração de Usuario, botao mostra senha esta redirecionando para a tela de Usuario(lista). Esta Errado
      e para habilitar para mostra a senha na tela 
   7. Criar gatilho quando da inclusão de novo usuario, incluir opcao de menu de Sair
   
