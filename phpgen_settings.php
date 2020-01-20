<?php

//  define('SHOW_VARIABLES', 1);
//  define('DEBUG_LEVEL', 1);

//  error_reporting(E_ALL ^ E_NOTICE);
//  ini_set('display_errors', 'On');

set_include_path('.' . PATH_SEPARATOR . get_include_path());


include_once dirname(__FILE__) . '/' . 'components/utils/system_utils.php';
include_once dirname(__FILE__) . '/' . 'components/mail/mailer.php';
include_once dirname(__FILE__) . '/' . 'components/mail/phpmailer_based_mailer.php';
require_once dirname(__FILE__) . '/' . 'database_engine/mysql_engine.php';

//  SystemUtils::DisableMagicQuotesRuntime();

SystemUtils::SetTimeZoneIfNeed('America/Argentina/Buenos_Aires');

function GetGlobalConnectionOptions()
{
    return
        array(
          'server' => 'mysql669.umbler.com',
          'port' => '41890',
          'username' => 'admsl3',
          'password' => 'Wiaslsp1',
          'database' => 'sl3',
          'client_encoding' => 'utf8'
        );
}

function HasAdminPage()
{
    return true;
}

function HasHomePage()
{
    return true;
}

function GetHomeURL()
{
    return 'index.php';
}

function GetHomePageBanner()
{
    return '';
}

function GetPageGroups()
{
    $result = array();
    $result[] = array('caption' => 'Estoque', 'description' => '');
    $result[] = array('caption' => 'Congregação', 'description' => '');
    $result[] = array('caption' => 'Voluntários', 'description' => '');
    $result[] = array('caption' => 'Acesso', 'description' => '');
    return $result;
}

function GetPageInfos()
{
    $result = array();
    $result[] = array('caption' => 'Assistência Ministério', 'short_caption' => 'Assistência Ministério', 'filename' => 'assistenciaministerio.php', 'name' => 'assistenciaministerio', 'group_name' => 'Congregação', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Batismos', 'short_caption' => 'Batismos', 'filename' => 'batismos.php', 'name' => 'batismos', 'group_name' => 'Congregação', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Categoria', 'short_caption' => 'Categoria', 'filename' => 'cadcategoria.php', 'name' => 'cadcategoria', 'group_name' => 'Estoque', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Congregações', 'short_caption' => 'Congregações', 'filename' => 'cadcongregacoes.php', 'name' => 'cadcongregacoes', 'group_name' => 'Congregação', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Digitadores', 'short_caption' => 'Digitadores', 'filename' => 'caddigitadores.php', 'name' => 'caddigitadores', 'group_name' => 'Congregação', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Minitério', 'short_caption' => 'Minitério', 'filename' => 'cadministerio.php', 'name' => 'cadministerio', 'group_name' => 'Congregação', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Voluntários', 'short_caption' => 'Voluntários', 'filename' => 'cadvoluntarios.php', 'name' => 'cadvoluntarios', 'group_name' => 'Voluntários', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'convocacoeseventos', 'short_caption' => 'convocacoeseventos', 'filename' => 'convocacoeseventos.php', 'name' => 'convocacoeseventos', 'group_name' => 'Voluntários', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Departamentos', 'short_caption' => 'Departamentos', 'filename' => 'departamentos.php', 'name' => 'departamentos', 'group_name' => 'Estoque', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Estoqueprodutos', 'short_caption' => 'Estoqueprodutos', 'filename' => 'estoqueprodutos.php', 'name' => 'estoqueprodutos', 'group_name' => 'Estoque', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Eventos', 'short_caption' => 'Eventos', 'filename' => 'eventos.php', 'name' => 'eventos', 'group_name' => 'Voluntários', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Funcoes', 'short_caption' => 'Funcoes', 'filename' => 'funcoes.php', 'name' => 'funcoes', 'group_name' => 'Voluntários', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Funcoesdevoluntarios', 'short_caption' => 'Funcoesdevoluntarios', 'filename' => 'funcoesdevoluntarios.php', 'name' => 'funcoesdevoluntarios', 'group_name' => 'Voluntários', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Movimentacoesestoque', 'short_caption' => 'Movimentacoesestoque', 'filename' => 'movimentacoesestoque.php', 'name' => 'movimentacoesestoque', 'group_name' => 'Estoque', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Permissao Ccb', 'short_caption' => 'Permissao Ccb', 'filename' => 'permissao_ccb.php', 'name' => 'permissao_ccb', 'group_name' => 'Acesso', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Produtos', 'short_caption' => 'Produtos', 'filename' => 'produtos.php', 'name' => 'produtos', 'group_name' => 'Estoque', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Santasceias', 'short_caption' => 'Santasceias', 'filename' => 'santasceias.php', 'name' => 'santasceias', 'group_name' => 'Congregação', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Treinamentos', 'short_caption' => 'Treinamentos', 'filename' => 'treinamentos.php', 'name' => 'treinamentos', 'group_name' => 'Voluntários', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Grupo/Obra CCB', 'short_caption' => 'Grupo/Obra CCB', 'filename' => 'grupoccb.php', 'name' => 'grupoccb', 'group_name' => 'Congregação', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Grupo Voluntários CCB', 'short_caption' => 'Grupo Voluntários CCB', 'filename' => 'grupovoluntarios.php', 'name' => 'grupovoluntarios', 'group_name' => 'Congregação', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Tipo Função', 'short_caption' => 'Tipo Função', 'filename' => 'tipofuncao.php', 'name' => 'tipofuncao', 'group_name' => 'Voluntários', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Consulta Voluntários', 'short_caption' => 'Consulta Voluntários', 'filename' => 'CONSULTAVOLUNTARIO.php', 'name' => 'CONSULTAVOLUNTARIO', 'group_name' => 'Voluntários', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Checkin Evento', 'short_caption' => 'Checkin Evento', 'filename' => 'CHECKIN_EVENTO.php', 'name' => 'CHECKIN_EVENTO', 'group_name' => 'Voluntários', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Checkin Evento Ministério', 'short_caption' => 'Checkin Evento Ministério', 'filename' => 'CHECKIN_EVENTO_MINISTERIO.php', 'name' => 'CHECKIN_EVENTO_MINISTERIO', 'group_name' => 'Voluntários', 'add_separator' => false, 'description' => '');
    return $result;
}

function GetPagesHeader()
{
    return
        '<div class="alert alert-danger SQLGeneratorEvaluationVersion"><h3 class="SQLGeneratorEvaluationVersion-head">Administração Setor Leste 3 </div>';
}

function GetPagesFooter()
{
    return
        'e-mail: suporte@ccbsl3.net.br -- 2020';
}

function ApplyCommonPageSettings(Page $page, Grid $grid)
{
    $page->SetShowUserAuthBar(true);
    $page->setShowNavigation(true);
    $page->OnCustomHTMLHeader->AddListener('Global_CustomHTMLHeaderHandler');
    $page->OnGetCustomTemplate->AddListener('Global_GetCustomTemplateHandler');
    $page->OnGetCustomExportOptions->AddListener('Global_OnGetCustomExportOptions');
    $page->getDataset()->OnGetFieldValue->AddListener('Global_OnGetFieldValue');
    $page->getDataset()->OnGetFieldValue->AddListener('OnGetFieldValue', $page);
    $grid->BeforeUpdateRecord->AddListener('Global_BeforeUpdateHandler');
    $grid->BeforeDeleteRecord->AddListener('Global_BeforeDeleteHandler');
    $grid->BeforeInsertRecord->AddListener('Global_BeforeInsertHandler');
    $grid->AfterUpdateRecord->AddListener('Global_AfterUpdateHandler');
    $grid->AfterDeleteRecord->AddListener('Global_AfterDeleteHandler');
    $grid->AfterInsertRecord->AddListener('Global_AfterInsertHandler');
}

function GetAnsiEncoding() { return 'windows-1252'; }

function Global_OnGetCustomPagePermissionsHandler(Page $page, PermissionSet &$permissions, &$handled)
{

}

function Global_CustomHTMLHeaderHandler($page, &$customHtmlHeaderText)
{

}

function Global_GetCustomTemplateHandler($type, $part, $mode, &$result, &$params, CommonPage $page = null)
{

}

function Global_OnGetCustomExportOptions($page, $exportType, $rowData, &$options)
{

}

function Global_OnGetFieldValue($fieldName, &$value, $tableName)
{

}

function Global_GetCustomPageList(CommonPage $page, PageList $pageList)
{

}

function Global_BeforeInsertHandler($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
{

}

function Global_BeforeUpdateHandler($page, $oldRowData, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
{

}

function Global_BeforeDeleteHandler($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
{

}

function Global_AfterInsertHandler($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
{

}

function Global_AfterUpdateHandler($page, $oldRowData, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
{

}

function Global_AfterDeleteHandler($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
{

}

function GetDefaultDateFormat()
{
    return 'Y-m-d';
}

function GetFirstDayOfWeek()
{
    return 0;
}

function GetPageListType()
{
    return PageList::TYPE_SIDEBAR;
}

function GetNullLabel()
{
    return null;
}

function UseMinifiedJS()
{
    return true;
}

function GetOfflineMode()
{
    return false;
}

function GetInactivityTimeout()
{
    return 600;
}

function GetMailer()
{
    $mailerOptions = new MailerOptions(MailerType::Sendmail, '', '');
    
    return PHPMailerBasedMailer::getInstance($mailerOptions);
}

function sendMailMessage($recipients, $messageSubject, $messageBody, $attachments = '', $cc = '', $bcc = '')
{
    GetMailer()->send($recipients, $messageSubject, $messageBody, $attachments, $cc, $bcc);
}

function createConnection()
{
    $connectionOptions = GetGlobalConnectionOptions();
    $connectionOptions['client_encoding'] = 'utf8';

    $connectionFactory = MySqlIConnectionFactory::getInstance();
    return $connectionFactory->CreateConnection($connectionOptions);
}
