<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *                                   ATTENTION!
 * If you see this message in your browser (Internet Explorer, Mozilla Firefox, Google Chrome, etc.)
 * this means that PHP is not properly installed on your web server. Please refer to the PHP manual
 * for more details: http://php.net/manual/install.php 
 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 */

    include_once dirname(__FILE__) . '/components/startup.php';
    include_once dirname(__FILE__) . '/components/application.php';
    include_once dirname(__FILE__) . '/' . 'authorization.php';


    include_once dirname(__FILE__) . '/' . 'database_engine/mysql_engine.php';
    include_once dirname(__FILE__) . '/' . 'components/page/page_includes.php';

    function GetConnectionOptions()
    {
        $result = GetGlobalConnectionOptions();
        $result['client_encoding'] = 'utf8';
        GetApplication()->GetUserAuthentication()->applyIdentityToConnectionOptions($result);
        return $result;
    }

    
    
    class cadvoluntarios_Id_CCBNestedPage extends NestedFormPage
    {
        protected function DoBeforeCreate()
        {
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`cadcongregacoes`');
            $this->dataset->addFields(
                array(
                    new StringField('Id_CCB', true, true),
                    new StringField('Ds_CCB'),
                    new StringField('Ds_SubSetor'),
                    new StringField('Ds_Endereco_CCB'),
                    new StringField('Cep_CCB'),
                    new StringField('tel_CCB'),
                    new StringField('Dia_Culto_1'),
                    new StringField('Hora_Culto_1'),
                    new StringField('Dia_Culto_2'),
                    new StringField('Hora_Culto_2'),
                    new StringField('Dia_Culto_3'),
                    new StringField('Hora_Culto_3'),
                    new StringField('Dia_Culto_4'),
                    new StringField('Hora_Culto_4'),
                    new StringField('Dia_RJM'),
                    new StringField('Hora_RJM'),
                    new StringField('Dia_Ensaio'),
                    new StringField('Hora_Ensaio'),
                    new StringField('Semana_ensaio')
                )
            );
        }
    
        protected function DoPrepare() {
    
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for Id_CCB field
            //
            $editor = new TextEdit('id_ccb_edit');
            $editor->SetMaxLength(7);
            $editColumn = new CustomEditColumn('Id CCB', 'Id_CCB', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Ds_CCB field
            //
            $editor = new TextAreaEdit('ds_ccb_edit', 50, 8);
            $editColumn = new CustomEditColumn('Ds CCB', 'Ds_CCB', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Ds_SubSetor field
            //
            $editor = new TextAreaEdit('ds_subsetor_edit', 50, 8);
            $editColumn = new CustomEditColumn('Ds Sub Setor', 'Ds_SubSetor', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Ds_Endereco_CCB field
            //
            $editor = new TextEdit('ds_endereco_ccb_edit');
            $editor->SetMaxLength(50);
            $editColumn = new CustomEditColumn('Ds Endereco CCB', 'Ds_Endereco_CCB', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Cep_CCB field
            //
            $editor = new TextEdit('cep_ccb_edit');
            $editor->SetMaxLength(9);
            $editColumn = new CustomEditColumn('Cep CCB', 'Cep_CCB', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for tel_CCB field
            //
            $editor = new TextEdit('tel_ccb_edit');
            $editor->SetMaxLength(21);
            $editColumn = new CustomEditColumn('Tel CCB', 'tel_CCB', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Dia_Culto_1 field
            //
            $editor = new TextEdit('dia_culto_1_edit');
            $editor->SetMaxLength(3);
            $editColumn = new CustomEditColumn('Dia Culto 1', 'Dia_Culto_1', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Hora_Culto_1 field
            //
            $editor = new TextEdit('hora_culto_1_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Hora Culto 1', 'Hora_Culto_1', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Dia_Culto_2 field
            //
            $editor = new TextEdit('dia_culto_2_edit');
            $editor->SetMaxLength(3);
            $editColumn = new CustomEditColumn('Dia Culto 2', 'Dia_Culto_2', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Hora_Culto_2 field
            //
            $editor = new TextEdit('hora_culto_2_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Hora Culto 2', 'Hora_Culto_2', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Dia_Culto_3 field
            //
            $editor = new TextEdit('dia_culto_3_edit');
            $editor->SetMaxLength(3);
            $editColumn = new CustomEditColumn('Dia Culto 3', 'Dia_Culto_3', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Hora_Culto_3 field
            //
            $editor = new TextEdit('hora_culto_3_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Hora Culto 3', 'Hora_Culto_3', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Dia_Culto_4 field
            //
            $editor = new TextEdit('dia_culto_4_edit');
            $editor->SetMaxLength(3);
            $editColumn = new CustomEditColumn('Dia Culto 4', 'Dia_Culto_4', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Hora_Culto_4 field
            //
            $editor = new TextEdit('hora_culto_4_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Hora Culto 4', 'Hora_Culto_4', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Dia_RJM field
            //
            $editor = new TextEdit('dia_rjm_edit');
            $editor->SetMaxLength(3);
            $editColumn = new CustomEditColumn('Dia RJM', 'Dia_RJM', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Hora_RJM field
            //
            $editor = new TextEdit('hora_rjm_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Hora RJM', 'Hora_RJM', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Dia_Ensaio field
            //
            $editor = new TextEdit('dia_ensaio_edit');
            $editor->SetMaxLength(3);
            $editColumn = new CustomEditColumn('Dia Ensaio', 'Dia_Ensaio', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Hora_Ensaio field
            //
            $editor = new TextEdit('hora_ensaio_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Hora Ensaio', 'Hora_Ensaio', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Semana_ensaio field
            //
            $editor = new TextEdit('semana_ensaio_edit');
            $editor->SetMaxLength(20);
            $editColumn = new CustomEditColumn('Semana Ensaio', 'Semana_ensaio', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
        }
    
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
    
        protected function setClientSideEvents(Grid $grid) {
    
        }
    
        protected function ApplyCommonColumnEditProperties(CustomEditColumn $column)
        {
            $column->SetDisplaySetToNullCheckBox(false);
            $column->SetDisplaySetToDefaultCheckBox(false);
            $column->SetVariableContainer($this->GetColumnVariableContainer());
        }
    
       static public function getNestedInsertHandlerName()
        {
            return get_class() . '_form_insert';
        }
    
        public function GetGridInsertHandler()
        {
            return self::getNestedInsertHandlerName();
        }
    
        protected function doGetCustomTemplate($type, $part, $mode, &$result, &$params)
        {
    
        }
    
        protected function doGetCustomFormLayout($mode, FixedKeysArray $columns, FormLayout $layout)
        {
    
        }
    
        protected function doFileUpload($fieldName, $rowData, &$result, &$accept, $originalFileName, $originalFileExtension, $fileSize, $tempFileName)
        {
    
        }
    
        public function doCustomDefaultValues(&$values, &$handled) 
        {
    
        }
    
        protected function doBeforeInsertRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterInsertRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
    }
    
    // OnBeforePageExecute event handler
    
    
    
    class cadvoluntariosPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Voluntários');
            $this->SetMenuLabel('Voluntários');
            $this->SetHeader(GetPagesHeader());
            $this->SetFooter(GetPagesFooter());
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`cadvoluntarios`');
            $this->dataset->addFields(
                array(
                    new StringField('Id_voluntario'),
                    new StringField('NM_VOLUNTARIO'),
                    new StringField('CD_RG_VOLUNTARIO'),
                    new StringField('NM_PROFISSAO'),
                    new StringField('Id_CCB'),
                    new StringField('NM_COMUM_CCB'),
                    new StringField('DS_ENDERECO_VOLUNTARIO'),
                    new StringField('CEP_VOLUNTARIO'),
                    new StringField('TEL1_VOLUNTARIO'),
                    new StringField('TEL2_VOLUNTARIO'),
                    new StringField('TEL3_VOLUNTARIO'),
                    new StringField('CD_SEXO'),
                    new StringField('EST_CIVIL'),
                    new StringField('DS_DISPONIBILIDADE_VOLUNTARIO'),
                    new StringField('DS_EMAIL_VOLUNTARIO'),
                    new IntegerField('ID_FUNCAO1'),
                    new IntegerField('ID_FUNCAO2'),
                    new IntegerField('ID_FUNCAO3'),
                    new StringField('DS_HABILIDADES'),
                    new StringField('DT_APRESENTACAO'),
                    new StringField('DT_BATISMO_VOLUNTARIO'),
                    new StringField('DT_NASC_VOLUNTARIO'),
                    new StringField('DS_ATIVIDADE_QUE_PARTICIPA'),
                    new StringField('ST_APOSENTADO'),
                    new StringField('ST_CONHECIMENTO_NIVEL_PROFISSIONAL'),
                    new StringField('ST_CURSO_EM_ANDAMENTO'),
                    new StringField('ST_ESTADO_CIVIL_VOLUNTARIO'),
                    new StringField('ST_PARTICPA_ATIV_MANUT_IGREJA'),
                    new StringField('ST_PENSIONISTA'),
                    new StringField('ST_PERMISSAO_TRABALHO_VOLUNTARIO'),
                    new StringField('ST_POSSUI_VINCULO_INSS'),
                    new StringField('DS_OBSERVACOES'),
                    new StringField('DS_TAMANHO_LUVA'),
                    new StringField('NR_BOTA_UTILIZAR'),
                    new StringField('ST_JA_REALIZOU_ASO'),
                    new StringField('ST_PARTICIPOU_NR35'),
                    new StringField('ST_PARTICIPOU_SEG_TRABALHO'),
                    new StringField('ST_QUER_PARTICIPAR_LINHA_VIDA'),
                    new IntegerField('ID_AUX', true, true, true),
                    new StringField('foto_voluntario'),
                    new StringField('foto_carta'),
                    new StringField('foto_nr35'),
                    new StringField('foto_tst'),
                    new StringField('foto_aso'),
                    new StringField('thumb_voluntario'),
                    new StringField('thumb_carta'),
                    new StringField('thumb_nr35'),
                    new StringField('thumb_tst'),
                    new StringField('thumb_aso'),
                    new StringField('Ds_SubSetor'),
                    new StringField('CPF_VOLUNTARIO'),
                    new DateTimeField('DT_ALTERACAO')
                )
            );
            $this->dataset->AddLookupField('Ds_SubSetor', 'cadcongregacoes', new StringField('Id_CCB'), new StringField('Ds_SubSetor', false, false, false, false, 'Ds_SubSetor_Ds_SubSetor', 'Ds_SubSetor_Ds_SubSetor_cadcongregacoes'), 'Ds_SubSetor_Ds_SubSetor_cadcongregacoes');
            $this->dataset->AddLookupField('Id_CCB', 'cadcongregacoes', new StringField('Id_CCB'), new StringField('Ds_CCB', false, false, false, false, 'Id_CCB_Ds_CCB', 'Id_CCB_Ds_CCB_cadcongregacoes'), 'Id_CCB_Ds_CCB_cadcongregacoes');
            $this->dataset->AddLookupField('ID_FUNCAO1', 'funcoes', new IntegerField('Id_Funcao'), new StringField('Ds_Funcao', false, false, false, false, 'ID_FUNCAO1_Ds_Funcao', 'ID_FUNCAO1_Ds_Funcao_funcoes'), 'ID_FUNCAO1_Ds_Funcao_funcoes');
            $this->dataset->AddLookupField('ID_FUNCAO2', 'funcoes', new IntegerField('Id_Funcao'), new StringField('Ds_Funcao', false, false, false, false, 'ID_FUNCAO2_Ds_Funcao', 'ID_FUNCAO2_Ds_Funcao_funcoes'), 'ID_FUNCAO2_Ds_Funcao_funcoes');
            $this->dataset->AddLookupField('ID_FUNCAO3', 'funcoes', new IntegerField('Id_Funcao'), new StringField('Ds_Funcao', false, false, false, false, 'ID_FUNCAO3_Ds_Funcao', 'ID_FUNCAO3_Ds_Funcao_funcoes'), 'ID_FUNCAO3_Ds_Funcao_funcoes');
        }
    
        protected function DoPrepare() {
    
        }
    
        protected function CreatePageNavigator()
        {
            $result = new CompositePageNavigator($this);
            
            $partitionNavigator = new PageNavigator('pnav', $this, $this->dataset);
            $partitionNavigator->SetRowsPerPage(20);
            $result->AddPageNavigator($partitionNavigator);
            
            return $result;
        }
    
        protected function CreateRssGenerator()
        {
            return null;
        }
    
        protected function setupCharts()
        {
    
        }
    
        protected function getFiltersColumns()
        {
            return array(
                new FilterColumn($this->dataset, 'Id_voluntario', 'Id_voluntario', 'CPF'),
                new FilterColumn($this->dataset, 'NM_VOLUNTARIO', 'NM_VOLUNTARIO', 'Nome'),
                new FilterColumn($this->dataset, 'CD_RG_VOLUNTARIO', 'CD_RG_VOLUNTARIO', 'RG'),
                new FilterColumn($this->dataset, 'Ds_SubSetor', 'Ds_SubSetor_Ds_SubSetor', 'SubSetor'),
                new FilterColumn($this->dataset, 'Id_CCB', 'Id_CCB_Ds_CCB', 'CCB'),
                new FilterColumn($this->dataset, 'NM_COMUM_CCB', 'NM_COMUM_CCB', 'Comum CCB'),
                new FilterColumn($this->dataset, 'NM_PROFISSAO', 'NM_PROFISSAO', 'PROFISSAO'),
                new FilterColumn($this->dataset, 'ID_FUNCAO1', 'ID_FUNCAO1_Ds_Funcao', 'Função Principal'),
                new FilterColumn($this->dataset, 'ID_FUNCAO2', 'ID_FUNCAO2_Ds_Funcao', 'Função Complementar'),
                new FilterColumn($this->dataset, 'ID_FUNCAO3', 'ID_FUNCAO3_Ds_Funcao', 'Função Adicional'),
                new FilterColumn($this->dataset, 'CEP_VOLUNTARIO', 'CEP_VOLUNTARIO', 'CEP'),
                new FilterColumn($this->dataset, 'DS_ENDERECO_VOLUNTARIO', 'DS_ENDERECO_VOLUNTARIO', 'Endereço'),
                new FilterColumn($this->dataset, 'TEL1_VOLUNTARIO', 'TEL1_VOLUNTARIO', 'Telefone Fixo'),
                new FilterColumn($this->dataset, 'TEL2_VOLUNTARIO', 'TEL2_VOLUNTARIO', 'Telefone Móvel'),
                new FilterColumn($this->dataset, 'TEL3_VOLUNTARIO', 'TEL3_VOLUNTARIO', 'Telefone Adicional'),
                new FilterColumn($this->dataset, 'DS_EMAIL_VOLUNTARIO', 'DS_EMAIL_VOLUNTARIO', 'E-mail'),
                new FilterColumn($this->dataset, 'EST_CIVIL', 'EST_CIVIL', 'Estado Civil'),
                new FilterColumn($this->dataset, 'DT_NASC_VOLUNTARIO', 'DT_NASC_VOLUNTARIO', 'Data Nascimento'),
                new FilterColumn($this->dataset, 'CD_SEXO', 'CD_SEXO', 'Sexo'),
                new FilterColumn($this->dataset, 'DS_DISPONIBILIDADE_VOLUNTARIO', 'DS_DISPONIBILIDADE_VOLUNTARIO', 'Atuação'),
                new FilterColumn($this->dataset, 'DS_HABILIDADES', 'DS_HABILIDADES', 'DS HABILIDADES'),
                new FilterColumn($this->dataset, 'DT_APRESENTACAO', 'DT_APRESENTACAO', 'DT APRESENTACAO'),
                new FilterColumn($this->dataset, 'DT_BATISMO_VOLUNTARIO', 'DT_BATISMO_VOLUNTARIO', 'DT BATISMO VOLUNTARIO'),
                new FilterColumn($this->dataset, 'DS_ATIVIDADE_QUE_PARTICIPA', 'DS_ATIVIDADE_QUE_PARTICIPA', 'DS ATIVIDADE QUE PARTICIPA'),
                new FilterColumn($this->dataset, 'ST_APOSENTADO', 'ST_APOSENTADO', 'ST APOSENTADO'),
                new FilterColumn($this->dataset, 'ST_CONHECIMENTO_NIVEL_PROFISSIONAL', 'ST_CONHECIMENTO_NIVEL_PROFISSIONAL', 'ST CONHECIMENTO NIVEL PROFISSIONAL'),
                new FilterColumn($this->dataset, 'ST_CURSO_EM_ANDAMENTO', 'ST_CURSO_EM_ANDAMENTO', 'ST CURSO EM ANDAMENTO'),
                new FilterColumn($this->dataset, 'ST_ESTADO_CIVIL_VOLUNTARIO', 'ST_ESTADO_CIVIL_VOLUNTARIO', 'ST ESTADO CIVIL VOLUNTARIO'),
                new FilterColumn($this->dataset, 'ST_PARTICPA_ATIV_MANUT_IGREJA', 'ST_PARTICPA_ATIV_MANUT_IGREJA', 'ST PARTICPA ATIV MANUT IGREJA'),
                new FilterColumn($this->dataset, 'ST_PENSIONISTA', 'ST_PENSIONISTA', 'ST PENSIONISTA'),
                new FilterColumn($this->dataset, 'ST_PERMISSAO_TRABALHO_VOLUNTARIO', 'ST_PERMISSAO_TRABALHO_VOLUNTARIO', 'ST PERMISSAO TRABALHO VOLUNTARIO'),
                new FilterColumn($this->dataset, 'ST_POSSUI_VINCULO_INSS', 'ST_POSSUI_VINCULO_INSS', 'ST POSSUI VINCULO INSS'),
                new FilterColumn($this->dataset, 'DS_OBSERVACOES', 'DS_OBSERVACOES', 'DS OBSERVACOES'),
                new FilterColumn($this->dataset, 'DS_TAMANHO_LUVA', 'DS_TAMANHO_LUVA', 'Luva'),
                new FilterColumn($this->dataset, 'NR_BOTA_UTILIZAR', 'NR_BOTA_UTILIZAR', 'Nr Bota'),
                new FilterColumn($this->dataset, 'ST_JA_REALIZOU_ASO', 'ST_JA_REALIZOU_ASO', 'ASO'),
                new FilterColumn($this->dataset, 'ST_PARTICIPOU_NR35', 'ST_PARTICIPOU_NR35', 'NR35'),
                new FilterColumn($this->dataset, 'ST_PARTICIPOU_SEG_TRABALHO', 'ST_PARTICIPOU_SEG_TRABALHO', 'TST'),
                new FilterColumn($this->dataset, 'ST_QUER_PARTICIPAR_LINHA_VIDA', 'ST_QUER_PARTICIPAR_LINHA_VIDA', 'ST QUER PARTICIPAR LINHA VIDA'),
                new FilterColumn($this->dataset, 'ID_AUX', 'ID_AUX', 'ID AUX'),
                new FilterColumn($this->dataset, 'foto_voluntario', 'foto_voluntario', 'Foto Voluntario'),
                new FilterColumn($this->dataset, 'foto_carta', 'foto_carta', 'Foto Carta'),
                new FilterColumn($this->dataset, 'foto_nr35', 'foto_nr35', 'Foto Nr35'),
                new FilterColumn($this->dataset, 'foto_tst', 'foto_tst', 'Foto Tst'),
                new FilterColumn($this->dataset, 'foto_aso', 'foto_aso', 'Foto Aso'),
                new FilterColumn($this->dataset, 'thumb_voluntario', 'thumb_voluntario', 'Foto Voluntário'),
                new FilterColumn($this->dataset, 'thumb_carta', 'thumb_carta', 'Foto Carta'),
                new FilterColumn($this->dataset, 'thumb_nr35', 'thumb_nr35', 'Foto Certificado NR35'),
                new FilterColumn($this->dataset, 'thumb_tst', 'thumb_tst', 'Foto Certificado TST'),
                new FilterColumn($this->dataset, 'thumb_aso', 'thumb_aso', 'Foto Certificado ASO'),
                new FilterColumn($this->dataset, 'CPF_VOLUNTARIO', 'CPF_VOLUNTARIO', 'CPF VOLUNTARIO'),
                new FilterColumn($this->dataset, 'DT_ALTERACAO', 'DT_ALTERACAO', 'DT ALTERACAO')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['Id_voluntario'])
                ->addColumn($columns['NM_VOLUNTARIO'])
                ->addColumn($columns['Ds_SubSetor'])
                ->addColumn($columns['Id_CCB'])
                ->addColumn($columns['NM_PROFISSAO'])
                ->addColumn($columns['ID_FUNCAO1'])
                ->addColumn($columns['ID_FUNCAO2'])
                ->addColumn($columns['ID_FUNCAO3'])
                ->addColumn($columns['CEP_VOLUNTARIO'])
                ->addColumn($columns['DS_ENDERECO_VOLUNTARIO'])
                ->addColumn($columns['TEL1_VOLUNTARIO'])
                ->addColumn($columns['TEL2_VOLUNTARIO'])
                ->addColumn($columns['TEL3_VOLUNTARIO'])
                ->addColumn($columns['DS_EMAIL_VOLUNTARIO'])
                ->addColumn($columns['EST_CIVIL'])
                ->addColumn($columns['DT_NASC_VOLUNTARIO'])
                ->addColumn($columns['CD_SEXO'])
                ->addColumn($columns['DS_TAMANHO_LUVA'])
                ->addColumn($columns['NR_BOTA_UTILIZAR'])
                ->addColumn($columns['ST_JA_REALIZOU_ASO'])
                ->addColumn($columns['ST_PARTICIPOU_NR35'])
                ->addColumn($columns['ST_PARTICIPOU_SEG_TRABALHO'])
                ->addColumn($columns['ID_AUX'])
                ->addColumn($columns['foto_voluntario'])
                ->addColumn($columns['foto_carta'])
                ->addColumn($columns['foto_nr35'])
                ->addColumn($columns['foto_tst'])
                ->addColumn($columns['foto_aso'])
                ->addColumn($columns['thumb_voluntario'])
                ->addColumn($columns['thumb_carta'])
                ->addColumn($columns['thumb_nr35'])
                ->addColumn($columns['thumb_tst'])
                ->addColumn($columns['thumb_aso'])
                ->addColumn($columns['CPF_VOLUNTARIO'])
                ->addColumn($columns['DT_ALTERACAO']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('Id_voluntario')
                ->setOptionsFor('Ds_SubSetor')
                ->setOptionsFor('Id_CCB')
                ->setOptionsFor('ID_FUNCAO1')
                ->setOptionsFor('ID_FUNCAO2')
                ->setOptionsFor('ID_FUNCAO3')
                ->setOptionsFor('DT_ALTERACAO');
            
            $columnFilter
                ->setNumberOfValuesToDisplayFor('Id_voluntario', 30);
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new MaskedEdit('id_voluntario_edit', '999.999.999-99');
            
            $text_editor = new TextEdit('Id_voluntario');
            
            $filterBuilder->addColumn(
                $columns['Id_voluntario'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('nm_voluntario_edit');
            
            $filterBuilder->addColumn(
                $columns['NM_VOLUNTARIO'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('ds_subsetor_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_cadvoluntarios_Ds_SubSetor_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('Ds_SubSetor', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_cadvoluntarios_Ds_SubSetor_search');
            
            $text_editor = new TextEdit('Ds_SubSetor');
            
            $filterBuilder->addColumn(
                $columns['Ds_SubSetor'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('id_ccb_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_cadvoluntarios_Id_CCB_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('Id_CCB', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_cadvoluntarios_Id_CCB_search');
            
            $text_editor = new TextEdit('Id_CCB');
            
            $filterBuilder->addColumn(
                $columns['Id_CCB'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('nm_profissao_edit');
            
            $filterBuilder->addColumn(
                $columns['NM_PROFISSAO'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('id_funcao1_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_cadvoluntarios_ID_FUNCAO1_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('ID_FUNCAO1', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_cadvoluntarios_ID_FUNCAO1_search');
            
            $filterBuilder->addColumn(
                $columns['ID_FUNCAO1'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('id_funcao2_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_cadvoluntarios_ID_FUNCAO2_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('ID_FUNCAO2', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_cadvoluntarios_ID_FUNCAO2_search');
            
            $filterBuilder->addColumn(
                $columns['ID_FUNCAO2'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('id_funcao3_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_cadvoluntarios_ID_FUNCAO3_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('ID_FUNCAO3', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_cadvoluntarios_ID_FUNCAO3_search');
            
            $filterBuilder->addColumn(
                $columns['ID_FUNCAO3'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new MaskedEdit('cep_voluntario_edit', '99999-999');
            
            $text_editor = new TextEdit('CEP_VOLUNTARIO');
            
            $filterBuilder->addColumn(
                $columns['CEP_VOLUNTARIO'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('ds_endereco_voluntario_edit');
            
            $filterBuilder->addColumn(
                $columns['DS_ENDERECO_VOLUNTARIO'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new MaskedEdit('tel1_voluntario_edit', '(99) 9999-9999');
            
            $text_editor = new TextEdit('TEL1_VOLUNTARIO');
            
            $filterBuilder->addColumn(
                $columns['TEL1_VOLUNTARIO'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new MaskedEdit('tel2_voluntario_edit', '(99) 9 9999-9999');
            
            $text_editor = new TextEdit('TEL2_VOLUNTARIO');
            
            $filterBuilder->addColumn(
                $columns['TEL2_VOLUNTARIO'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new MaskedEdit('tel3_voluntario_edit', '(99) 9 9999-9999');
            
            $text_editor = new TextEdit('TEL3_VOLUNTARIO');
            
            $filterBuilder->addColumn(
                $columns['TEL3_VOLUNTARIO'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('ds_email_voluntario_edit');
            
            $filterBuilder->addColumn(
                $columns['DS_EMAIL_VOLUNTARIO'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('est_civil_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $main_editor->addChoice('Solteiro', 'Solteiro');
            $main_editor->addChoice('Casado', 'Casado');
            $main_editor->addChoice('Viúvo', 'Viúvo');
            $main_editor->addChoice('Separado judicialmente', 'Separado judicialmente');
            $main_editor->addChoice('Divorciado', 'Divorciado');
            $main_editor->addChoice('Não Informado', 'Não Informado');
            $main_editor->SetAllowNullValue(false);
            
            $multi_value_select_editor = new MultiValueSelect('EST_CIVIL');
            $multi_value_select_editor->setChoices($main_editor->getChoices());
            
            $text_editor = new TextEdit('EST_CIVIL');
            
            $filterBuilder->addColumn(
                $columns['EST_CIVIL'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new MaskedEdit('dt_nasc_voluntario_edit', '99/99/9999');
            
            $text_editor = new TextEdit('DT_NASC_VOLUNTARIO');
            
            $filterBuilder->addColumn(
                $columns['DT_NASC_VOLUNTARIO'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('cd_sexo_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $main_editor->addChoice('Masculino', 'Masculino');
            $main_editor->addChoice('Feminino', 'Feminino');
            $main_editor->SetAllowNullValue(false);
            
            $multi_value_select_editor = new MultiValueSelect('CD_SEXO');
            $multi_value_select_editor->setChoices($main_editor->getChoices());
            
            $text_editor = new TextEdit('CD_SEXO');
            
            $filterBuilder->addColumn(
                $columns['CD_SEXO'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('ds_tamanho_luva_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $main_editor->addChoice('P', 'P');
            $main_editor->addChoice('M', 'M');
            $main_editor->addChoice('G', 'G');
            $main_editor->SetAllowNullValue(false);
            
            $multi_value_select_editor = new MultiValueSelect('DS_TAMANHO_LUVA');
            $multi_value_select_editor->setChoices($main_editor->getChoices());
            
            $text_editor = new TextEdit('DS_TAMANHO_LUVA');
            
            $filterBuilder->addColumn(
                $columns['DS_TAMANHO_LUVA'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('nr_bota_utilizar_edit');
            
            $filterBuilder->addColumn(
                $columns['NR_BOTA_UTILIZAR'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('st_ja_realizou_aso_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $main_editor->addChoice('Sim', 'Sim');
            $main_editor->addChoice('Não', 'Não');
            $main_editor->SetAllowNullValue(false);
            
            $multi_value_select_editor = new MultiValueSelect('ST_JA_REALIZOU_ASO');
            $multi_value_select_editor->setChoices($main_editor->getChoices());
            
            $text_editor = new TextEdit('ST_JA_REALIZOU_ASO');
            
            $filterBuilder->addColumn(
                $columns['ST_JA_REALIZOU_ASO'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('st_participou_nr35_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $main_editor->addChoice('Sim', 'Sim');
            $main_editor->addChoice('Não', 'Não');
            $main_editor->SetAllowNullValue(false);
            
            $multi_value_select_editor = new MultiValueSelect('ST_PARTICIPOU_NR35');
            $multi_value_select_editor->setChoices($main_editor->getChoices());
            
            $text_editor = new TextEdit('ST_PARTICIPOU_NR35');
            
            $filterBuilder->addColumn(
                $columns['ST_PARTICIPOU_NR35'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('st_participou_seg_trabalho_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $main_editor->addChoice('Sim', 'Sim');
            $main_editor->addChoice('Não', 'Não');
            $main_editor->SetAllowNullValue(false);
            
            $multi_value_select_editor = new MultiValueSelect('ST_PARTICIPOU_SEG_TRABALHO');
            $multi_value_select_editor->setChoices($main_editor->getChoices());
            
            $text_editor = new TextEdit('ST_PARTICIPOU_SEG_TRABALHO');
            
            $filterBuilder->addColumn(
                $columns['ST_PARTICIPOU_SEG_TRABALHO'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('id_aux_edit');
            
            $filterBuilder->addColumn(
                $columns['ID_AUX'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('foto_voluntario');
            
            $filterBuilder->addColumn(
                $columns['foto_voluntario'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('foto_carta');
            
            $filterBuilder->addColumn(
                $columns['foto_carta'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('foto_nr35');
            
            $filterBuilder->addColumn(
                $columns['foto_nr35'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('foto_tst');
            
            $filterBuilder->addColumn(
                $columns['foto_tst'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('foto_aso');
            
            $filterBuilder->addColumn(
                $columns['foto_aso'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('thumb_voluntario_edit');
            $main_editor->SetMaxLength(60);
            
            $filterBuilder->addColumn(
                $columns['thumb_voluntario'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('thumb_carta_edit');
            $main_editor->SetMaxLength(60);
            
            $filterBuilder->addColumn(
                $columns['thumb_carta'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('thumb_nr35_edit');
            $main_editor->SetMaxLength(60);
            
            $filterBuilder->addColumn(
                $columns['thumb_nr35'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('thumb_tst_edit');
            $main_editor->SetMaxLength(60);
            
            $filterBuilder->addColumn(
                $columns['thumb_tst'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('thumb_aso_edit');
            $main_editor->SetMaxLength(60);
            
            $filterBuilder->addColumn(
                $columns['thumb_aso'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('cpf_voluntario_edit');
            $main_editor->SetMaxLength(11);
            
            $filterBuilder->addColumn(
                $columns['CPF_VOLUNTARIO'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('dt_alteracao_edit', false, 'Y-m-d H:i:s');
            
            $filterBuilder->addColumn(
                $columns['DT_ALTERACAO'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
        }
    
        protected function AddOperationsColumns(Grid $grid)
        {
            $actions = $grid->getActions();
            $actions->setCaption($this->GetLocalizerCaptions()->GetMessageString('Actions'));
            $actions->setPosition(ActionList::POSITION_LEFT);
            
            if ($this->GetSecurityInfo()->HasViewGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('View'), OPERATION_VIEW, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
            }
            
            if ($this->GetSecurityInfo()->HasEditGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Edit'), OPERATION_EDIT, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
                $operation->OnShow->AddListener('ShowEditButtonHandler', $this);
            }
            
            if ($this->GetSecurityInfo()->HasDeleteGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Delete'), OPERATION_DELETE, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
                $operation->OnShow->AddListener('ShowDeleteButtonHandler', $this);
                $operation->SetAdditionalAttribute('data-modal-operation', 'delete');
                $operation->SetAdditionalAttribute('data-delete-handler-name', $this->GetModalGridDeleteHandler());
            }
            
            if ($this->GetSecurityInfo()->HasAddGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Copy'), OPERATION_COPY, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
            }
        }
    
        protected function AddFieldColumns(Grid $grid, $withDetails = true)
        {
            //
            // View column for Id_voluntario field
            //
            $column = new TextViewColumn('Id_voluntario', 'Id_voluntario', 'CPF', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for NM_VOLUNTARIO field
            //
            $column = new StringTransformViewColumn('NM_VOLUNTARIO', 'NM_VOLUNTARIO', 'Nome', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_NM_VOLUNTARIO_handler_list');
            $column->setStringTransformFunction('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Ds_SubSetor field
            //
            $column = new TextViewColumn('Ds_SubSetor', 'Ds_SubSetor_Ds_SubSetor', 'SubSetor', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_Ds_SubSetor_Ds_SubSetor_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('Id_CCB', 'Id_CCB_Ds_CCB', 'CCB', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for NM_PROFISSAO field
            //
            $column = new TextViewColumn('NM_PROFISSAO', 'NM_PROFISSAO', 'PROFISSAO', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_NM_PROFISSAO_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Ds_Funcao field
            //
            $column = new TextViewColumn('ID_FUNCAO1', 'ID_FUNCAO1_Ds_Funcao', 'Função Principal', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('PRIMEIRA FUNÇÃO SELECIONADA');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Ds_Funcao field
            //
            $column = new TextViewColumn('ID_FUNCAO2', 'ID_FUNCAO2_Ds_Funcao', 'Função Complementar', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('SEGUNDA FUNÇÃO');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Ds_Funcao field
            //
            $column = new TextViewColumn('ID_FUNCAO3', 'ID_FUNCAO3_Ds_Funcao', 'Função Adicional', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('TERCEIRA FUNÇÃO');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for CEP_VOLUNTARIO field
            //
            $column = new TextViewColumn('CEP_VOLUNTARIO', 'CEP_VOLUNTARIO', 'CEP', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_CEP_VOLUNTARIO_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for DS_ENDERECO_VOLUNTARIO field
            //
            $column = new TextViewColumn('DS_ENDERECO_VOLUNTARIO', 'DS_ENDERECO_VOLUNTARIO', 'Endereço', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_DS_ENDERECO_VOLUNTARIO_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for TEL1_VOLUNTARIO field
            //
            $column = new TextViewColumn('TEL1_VOLUNTARIO', 'TEL1_VOLUNTARIO', 'Telefone Fixo', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_TEL1_VOLUNTARIO_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for TEL2_VOLUNTARIO field
            //
            $column = new TextViewColumn('TEL2_VOLUNTARIO', 'TEL2_VOLUNTARIO', 'Telefone Móvel', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_TEL2_VOLUNTARIO_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for TEL3_VOLUNTARIO field
            //
            $column = new TextViewColumn('TEL3_VOLUNTARIO', 'TEL3_VOLUNTARIO', 'Telefone Adicional', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_TEL3_VOLUNTARIO_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for DS_EMAIL_VOLUNTARIO field
            //
            $column = new TextViewColumn('DS_EMAIL_VOLUNTARIO', 'DS_EMAIL_VOLUNTARIO', 'E-mail', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_DS_EMAIL_VOLUNTARIO_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for EST_CIVIL field
            //
            $column = new TextViewColumn('EST_CIVIL', 'EST_CIVIL', 'Estado Civil', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for DT_NASC_VOLUNTARIO field
            //
            $column = new TextViewColumn('DT_NASC_VOLUNTARIO', 'DT_NASC_VOLUNTARIO', 'Data Nascimento', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_DT_NASC_VOLUNTARIO_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for CD_SEXO field
            //
            $column = new TextViewColumn('CD_SEXO', 'CD_SEXO', 'Sexo', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_CD_SEXO_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for DS_TAMANHO_LUVA field
            //
            $column = new TextViewColumn('DS_TAMANHO_LUVA', 'DS_TAMANHO_LUVA', 'Luva', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_DS_TAMANHO_LUVA_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for NR_BOTA_UTILIZAR field
            //
            $column = new TextViewColumn('NR_BOTA_UTILIZAR', 'NR_BOTA_UTILIZAR', 'Nr Bota', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_NR_BOTA_UTILIZAR_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ST_JA_REALIZOU_ASO field
            //
            $column = new TextViewColumn('ST_JA_REALIZOU_ASO', 'ST_JA_REALIZOU_ASO', 'ASO', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_ST_JA_REALIZOU_ASO_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ST_PARTICIPOU_NR35 field
            //
            $column = new TextViewColumn('ST_PARTICIPOU_NR35', 'ST_PARTICIPOU_NR35', 'NR35', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_ST_PARTICIPOU_NR35_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ST_PARTICIPOU_SEG_TRABALHO field
            //
            $column = new TextViewColumn('ST_PARTICIPOU_SEG_TRABALHO', 'ST_PARTICIPOU_SEG_TRABALHO', 'TST', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_ST_PARTICIPOU_SEG_TRABALHO_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ID_AUX field
            //
            $column = new NumberViewColumn('ID_AUX', 'ID_AUX', 'ID AUX', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for thumb_voluntario field
            //
            $column = new ExternalImageViewColumn('thumb_voluntario', 'thumb_voluntario', 'Foto Voluntário', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for thumb_carta field
            //
            $column = new ExternalImageViewColumn('thumb_carta', 'thumb_carta', 'Foto Carta', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for thumb_nr35 field
            //
            $column = new ExternalImageViewColumn('thumb_nr35', 'thumb_nr35', 'Foto Certificado NR35', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for thumb_tst field
            //
            $column = new ExternalImageViewColumn('thumb_tst', 'thumb_tst', 'Foto Certificado TST', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for thumb_aso field
            //
            $column = new ExternalImageViewColumn('thumb_aso', 'thumb_aso', 'Foto Certificado ASO', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for CPF_VOLUNTARIO field
            //
            $column = new TextViewColumn('CPF_VOLUNTARIO', 'CPF_VOLUNTARIO', 'CPF VOLUNTARIO', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for DT_ALTERACAO field
            //
            $column = new DateTimeViewColumn('DT_ALTERACAO', 'DT_ALTERACAO', 'DT ALTERACAO', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for Id_voluntario field
            //
            $column = new TextViewColumn('Id_voluntario', 'Id_voluntario', 'CPF', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for NM_VOLUNTARIO field
            //
            $column = new StringTransformViewColumn('NM_VOLUNTARIO', 'NM_VOLUNTARIO', 'Nome', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_NM_VOLUNTARIO_handler_view');
            $column->setStringTransformFunction('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Ds_SubSetor field
            //
            $column = new TextViewColumn('Ds_SubSetor', 'Ds_SubSetor_Ds_SubSetor', 'SubSetor', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_Ds_SubSetor_Ds_SubSetor_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('Id_CCB', 'Id_CCB_Ds_CCB', 'CCB', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for NM_PROFISSAO field
            //
            $column = new TextViewColumn('NM_PROFISSAO', 'NM_PROFISSAO', 'PROFISSAO', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_NM_PROFISSAO_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Ds_Funcao field
            //
            $column = new TextViewColumn('ID_FUNCAO1', 'ID_FUNCAO1_Ds_Funcao', 'Função Principal', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Ds_Funcao field
            //
            $column = new TextViewColumn('ID_FUNCAO2', 'ID_FUNCAO2_Ds_Funcao', 'Função Complementar', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Ds_Funcao field
            //
            $column = new TextViewColumn('ID_FUNCAO3', 'ID_FUNCAO3_Ds_Funcao', 'Função Adicional', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for CEP_VOLUNTARIO field
            //
            $column = new TextViewColumn('CEP_VOLUNTARIO', 'CEP_VOLUNTARIO', 'CEP', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_CEP_VOLUNTARIO_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for DS_ENDERECO_VOLUNTARIO field
            //
            $column = new TextViewColumn('DS_ENDERECO_VOLUNTARIO', 'DS_ENDERECO_VOLUNTARIO', 'Endereço', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_DS_ENDERECO_VOLUNTARIO_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for TEL1_VOLUNTARIO field
            //
            $column = new TextViewColumn('TEL1_VOLUNTARIO', 'TEL1_VOLUNTARIO', 'Telefone Fixo', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_TEL1_VOLUNTARIO_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for TEL2_VOLUNTARIO field
            //
            $column = new TextViewColumn('TEL2_VOLUNTARIO', 'TEL2_VOLUNTARIO', 'Telefone Móvel', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_TEL2_VOLUNTARIO_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for TEL3_VOLUNTARIO field
            //
            $column = new TextViewColumn('TEL3_VOLUNTARIO', 'TEL3_VOLUNTARIO', 'Telefone Adicional', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_TEL3_VOLUNTARIO_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for DS_EMAIL_VOLUNTARIO field
            //
            $column = new TextViewColumn('DS_EMAIL_VOLUNTARIO', 'DS_EMAIL_VOLUNTARIO', 'E-mail', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_DS_EMAIL_VOLUNTARIO_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for EST_CIVIL field
            //
            $column = new TextViewColumn('EST_CIVIL', 'EST_CIVIL', 'Estado Civil', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for DT_NASC_VOLUNTARIO field
            //
            $column = new TextViewColumn('DT_NASC_VOLUNTARIO', 'DT_NASC_VOLUNTARIO', 'Data Nascimento', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_DT_NASC_VOLUNTARIO_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for CD_SEXO field
            //
            $column = new TextViewColumn('CD_SEXO', 'CD_SEXO', 'Sexo', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_CD_SEXO_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for DS_TAMANHO_LUVA field
            //
            $column = new TextViewColumn('DS_TAMANHO_LUVA', 'DS_TAMANHO_LUVA', 'Luva', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_DS_TAMANHO_LUVA_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for NR_BOTA_UTILIZAR field
            //
            $column = new TextViewColumn('NR_BOTA_UTILIZAR', 'NR_BOTA_UTILIZAR', 'Nr Bota', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_NR_BOTA_UTILIZAR_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ST_JA_REALIZOU_ASO field
            //
            $column = new TextViewColumn('ST_JA_REALIZOU_ASO', 'ST_JA_REALIZOU_ASO', 'ASO', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_ST_JA_REALIZOU_ASO_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ST_PARTICIPOU_NR35 field
            //
            $column = new TextViewColumn('ST_PARTICIPOU_NR35', 'ST_PARTICIPOU_NR35', 'NR35', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_ST_PARTICIPOU_NR35_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ST_PARTICIPOU_SEG_TRABALHO field
            //
            $column = new TextViewColumn('ST_PARTICIPOU_SEG_TRABALHO', 'ST_PARTICIPOU_SEG_TRABALHO', 'TST', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_ST_PARTICIPOU_SEG_TRABALHO_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ID_AUX field
            //
            $column = new NumberViewColumn('ID_AUX', 'ID_AUX', 'ID AUX', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for foto_voluntario field
            //
            $column = new ExternalImageViewColumn('foto_voluntario', 'foto_voluntario', 'Foto Voluntario', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for foto_carta field
            //
            $column = new ExternalImageViewColumn('foto_carta', 'foto_carta', 'Foto Carta', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for foto_nr35 field
            //
            $column = new ExternalImageViewColumn('foto_nr35', 'foto_nr35', 'Foto Nr35', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for foto_tst field
            //
            $column = new ExternalImageViewColumn('foto_tst', 'foto_tst', 'Foto Tst', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for foto_aso field
            //
            $column = new ExternalImageViewColumn('foto_aso', 'foto_aso', 'Foto Aso', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for CPF_VOLUNTARIO field
            //
            $column = new TextViewColumn('CPF_VOLUNTARIO', 'CPF_VOLUNTARIO', 'CPF VOLUNTARIO', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for DT_ALTERACAO field
            //
            $column = new DateTimeViewColumn('DT_ALTERACAO', 'DT_ALTERACAO', 'DT ALTERACAO', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for Id_voluntario field
            //
            $editor = new MaskedEdit('id_voluntario_edit', '999.999.999-99');
            $editColumn = new CustomEditColumn('CPF', 'Id_voluntario', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new CustomRegExpValidator('[0-9]{3}\.?[0-9]{3}\.?[0-9]{3}\-?[0-9]{2}', StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RegExpValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for NM_VOLUNTARIO field
            //
            $editor = new TextEdit('nm_voluntario_edit');
            $editColumn = new CustomEditColumn('Nome', 'NM_VOLUNTARIO', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Id_CCB field
            //
            $editor = new DynamicCombobox('id_ccb_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`cadcongregacoes`');
            $lookupDataset->addFields(
                array(
                    new StringField('Id_CCB', true, true),
                    new StringField('Ds_CCB'),
                    new StringField('Ds_SubSetor'),
                    new StringField('Ds_Endereco_CCB'),
                    new StringField('Cep_CCB'),
                    new StringField('tel_CCB'),
                    new StringField('Dia_Culto_1'),
                    new StringField('Hora_Culto_1'),
                    new StringField('Dia_Culto_2'),
                    new StringField('Hora_Culto_2'),
                    new StringField('Dia_Culto_3'),
                    new StringField('Hora_Culto_3'),
                    new StringField('Dia_Culto_4'),
                    new StringField('Hora_Culto_4'),
                    new StringField('Dia_RJM'),
                    new StringField('Hora_RJM'),
                    new StringField('Dia_Ensaio'),
                    new StringField('Hora_Ensaio'),
                    new StringField('Semana_ensaio')
                )
            );
            $lookupDataset->setOrderByField('Ds_CCB', 'ASC');
            $editColumn = new DynamicLookupEditColumn('CCB', 'Id_CCB', 'Id_CCB_Ds_CCB', 'edit_cadvoluntarios_Id_CCB_search', $editor, $this->dataset, $lookupDataset, 'Id_CCB', 'Ds_CCB', '');
            $editColumn->setNestedInsertFormLink(
                $this->GetHandlerLink(cadvoluntarios_Id_CCBNestedPage::getNestedInsertHandlerName())
            );
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for NM_PROFISSAO field
            //
            $editor = new TextEdit('nm_profissao_edit');
            $editColumn = new CustomEditColumn('PROFISSAO', 'NM_PROFISSAO', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ID_FUNCAO1 field
            //
            $editor = new DynamicCombobox('id_funcao1_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`funcoes`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id_Funcao', true, true, true),
                    new StringField('Ds_Funcao'),
                    new IntegerField('id_tipofuncao')
                )
            );
            $lookupDataset->setOrderByField('Ds_Funcao', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Função Principal', 'ID_FUNCAO1', 'ID_FUNCAO1_Ds_Funcao', '_cadvoluntarios_ID_FUNCAO1_search', $editor, $this->dataset, $lookupDataset, 'Id_Funcao', 'Ds_Funcao', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ID_FUNCAO2 field
            //
            $editor = new DynamicCombobox('id_funcao2_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`funcoes`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id_Funcao', true, true, true),
                    new StringField('Ds_Funcao'),
                    new IntegerField('id_tipofuncao')
                )
            );
            $lookupDataset->setOrderByField('Ds_Funcao', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Função Complementar', 'ID_FUNCAO2', 'ID_FUNCAO2_Ds_Funcao', '_cadvoluntarios_ID_FUNCAO2_search', $editor, $this->dataset, $lookupDataset, 'Id_Funcao', 'Ds_Funcao', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ID_FUNCAO3 field
            //
            $editor = new DynamicCombobox('id_funcao3_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`funcoes`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id_Funcao', true, true, true),
                    new StringField('Ds_Funcao'),
                    new IntegerField('id_tipofuncao')
                )
            );
            $lookupDataset->setOrderByField('Ds_Funcao', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Função Adicional', 'ID_FUNCAO3', 'ID_FUNCAO3_Ds_Funcao', '_cadvoluntarios_ID_FUNCAO3_search', $editor, $this->dataset, $lookupDataset, 'Id_Funcao', 'Ds_Funcao', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for CEP_VOLUNTARIO field
            //
            $editor = new MaskedEdit('cep_voluntario_edit', '99999-999');
            $editColumn = new CustomEditColumn('CEP', 'CEP_VOLUNTARIO', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for DS_ENDERECO_VOLUNTARIO field
            //
            $editor = new TextEdit('ds_endereco_voluntario_edit');
            $editColumn = new CustomEditColumn('Endereço', 'DS_ENDERECO_VOLUNTARIO', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for TEL1_VOLUNTARIO field
            //
            $editor = new MaskedEdit('tel1_voluntario_edit', '(99) 9999-9999');
            $editColumn = new CustomEditColumn('Telefone Fixo', 'TEL1_VOLUNTARIO', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for TEL2_VOLUNTARIO field
            //
            $editor = new MaskedEdit('tel2_voluntario_edit', '(99) 9 9999-9999');
            $editColumn = new CustomEditColumn('Telefone Móvel', 'TEL2_VOLUNTARIO', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for TEL3_VOLUNTARIO field
            //
            $editor = new MaskedEdit('tel3_voluntario_edit', '(99) 9 9999-9999');
            $editColumn = new CustomEditColumn('Telefone Adicional', 'TEL3_VOLUNTARIO', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for DS_EMAIL_VOLUNTARIO field
            //
            $editor = new TextEdit('ds_email_voluntario_edit');
            $editColumn = new CustomEditColumn('E-mail', 'DS_EMAIL_VOLUNTARIO', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new EMailValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('EmailValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for EST_CIVIL field
            //
            $editor = new ComboBox('est_civil_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('Solteiro', 'Solteiro');
            $editor->addChoice('Casado', 'Casado');
            $editor->addChoice('Viúvo', 'Viúvo');
            $editor->addChoice('Separado judicialmente', 'Separado judicialmente');
            $editor->addChoice('Divorciado', 'Divorciado');
            $editor->addChoice('Não Informado', 'Não Informado');
            $editColumn = new CustomEditColumn('Estado Civil', 'EST_CIVIL', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for DT_NASC_VOLUNTARIO field
            //
            $editor = new MaskedEdit('dt_nasc_voluntario_edit', '99/99/9999');
            $editColumn = new CustomEditColumn('Data Nascimento', 'DT_NASC_VOLUNTARIO', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for CD_SEXO field
            //
            $editor = new ComboBox('cd_sexo_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('Masculino', 'Masculino');
            $editor->addChoice('Feminino', 'Feminino');
            $editColumn = new CustomEditColumn('Sexo', 'CD_SEXO', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for DS_TAMANHO_LUVA field
            //
            $editor = new ComboBox('ds_tamanho_luva_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('P', 'P');
            $editor->addChoice('M', 'M');
            $editor->addChoice('G', 'G');
            $editColumn = new CustomEditColumn('Luva', 'DS_TAMANHO_LUVA', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for NR_BOTA_UTILIZAR field
            //
            $editor = new TextEdit('nr_bota_utilizar_edit');
            $editColumn = new CustomEditColumn('Nr Bota', 'NR_BOTA_UTILIZAR', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new NumberValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('NumberValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ST_JA_REALIZOU_ASO field
            //
            $editor = new ComboBox('st_ja_realizou_aso_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('Sim', 'Sim');
            $editor->addChoice('Não', 'Não');
            $editColumn = new CustomEditColumn('ASO', 'ST_JA_REALIZOU_ASO', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ST_PARTICIPOU_NR35 field
            //
            $editor = new ComboBox('st_participou_nr35_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('Sim', 'Sim');
            $editor->addChoice('Não', 'Não');
            $editColumn = new CustomEditColumn('NR35', 'ST_PARTICIPOU_NR35', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ST_PARTICIPOU_SEG_TRABALHO field
            //
            $editor = new ComboBox('st_participou_seg_trabalho_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('Sim', 'Sim');
            $editor->addChoice('Não', 'Não');
            $editColumn = new CustomEditColumn('TST', 'ST_PARTICIPOU_SEG_TRABALHO', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for foto_voluntario field
            //
            $editor = new ImageUploader('foto_voluntario_edit');
            $editor->SetShowImage(true);
            $editor->setAcceptableFileTypes('image/*');
            $editColumn = new UploadFileToFolderColumn('Foto Voluntario', 'foto_voluntario', $editor, $this->dataset, false, false, 'fotovoluntario/', '%random%.%original_file_extension%', $this->OnFileUpload, false);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetGenerationImageThumbnails(
                'thumb_voluntario',
                'fotovoluntario/',
                Delegate::CreateFromMethod($this, 'foto_voluntario_Thumbnail_GenerateFileName_'),
                new ImageFitByHeightResizeFilter(30),
                false
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for foto_carta field
            //
            $editor = new ImageUploader('foto_carta_edit');
            $editor->SetShowImage(true);
            $editor->setAcceptableFileTypes('image/*');
            $editColumn = new UploadFileToFolderColumn('Foto Carta', 'foto_carta', $editor, $this->dataset, false, false, 'fotocarta/', '%random%.%original_file_extension%', $this->OnFileUpload, false);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetGenerationImageThumbnails(
                'thumb_carta',
                'fotocarta/',
                Delegate::CreateFromMethod($this, 'foto_carta_Thumbnail_GenerateFileName_'),
                new ImageFitByHeightResizeFilter(30),
                false
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for foto_nr35 field
            //
            $editor = new ImageUploader('foto_nr35_edit');
            $editor->SetShowImage(true);
            $editor->setAcceptableFileTypes('image/*');
            $editColumn = new UploadFileToFolderColumn('Foto Nr35', 'foto_nr35', $editor, $this->dataset, false, false, 'fotonr35/', '%random%.%original_file_extension%', $this->OnFileUpload, false);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetGenerationImageThumbnails(
                'thumb_nr35',
                'fotonr35/',
                Delegate::CreateFromMethod($this, 'foto_nr35_Thumbnail_GenerateFileName_'),
                new ImageFitByHeightResizeFilter(30),
                false
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for foto_tst field
            //
            $editor = new ImageUploader('foto_tst_edit');
            $editor->SetShowImage(true);
            $editor->setAcceptableFileTypes('image/*');
            $editColumn = new UploadFileToFolderColumn('Foto Tst', 'foto_tst', $editor, $this->dataset, false, false, 'fototst/', '%random%.%original_file_extension%', $this->OnFileUpload, false);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetGenerationImageThumbnails(
                'thumb_tst',
                'fototst/',
                Delegate::CreateFromMethod($this, 'foto_tst_Thumbnail_GenerateFileName_'),
                new ImageFitByHeightResizeFilter(30),
                false
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for foto_aso field
            //
            $editor = new ImageUploader('foto_aso_edit');
            $editor->SetShowImage(true);
            $editor->setAcceptableFileTypes('image/*');
            $editColumn = new UploadFileToFolderColumn('Foto Aso', 'foto_aso', $editor, $this->dataset, false, false, 'fotoaso/', '%random%.%original_file_extension%', $this->OnFileUpload, false);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetGenerationImageThumbnails(
                'thumb_aso',
                'fotoaso/',
                Delegate::CreateFromMethod($this, 'foto_aso_Thumbnail_GenerateFileName_'),
                new ImageFitByHeightResizeFilter(30),
                false
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for CPF_VOLUNTARIO field
            //
            $editor = new TextEdit('cpf_voluntario_edit');
            $editor->SetMaxLength(11);
            $editColumn = new CustomEditColumn('CPF VOLUNTARIO', 'CPF_VOLUNTARIO', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for DT_ALTERACAO field
            //
            $editor = new DateTimeEdit('dt_alteracao_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('DT ALTERACAO', 'DT_ALTERACAO', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
            //
            // Edit column for Id_voluntario field
            //
            $editor = new MaskedEdit('id_voluntario_edit', '999.999.999-99');
            $editColumn = new CustomEditColumn('CPF', 'Id_voluntario', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new CustomRegExpValidator('[0-9]{3}\.?[0-9]{3}\.?[0-9]{3}\-?[0-9]{2}', StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RegExpValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for NM_VOLUNTARIO field
            //
            $editor = new TextEdit('nm_voluntario_edit');
            $editColumn = new CustomEditColumn('Nome', 'NM_VOLUNTARIO', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Id_CCB field
            //
            $editor = new DynamicCombobox('id_ccb_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`cadcongregacoes`');
            $lookupDataset->addFields(
                array(
                    new StringField('Id_CCB', true, true),
                    new StringField('Ds_CCB'),
                    new StringField('Ds_SubSetor'),
                    new StringField('Ds_Endereco_CCB'),
                    new StringField('Cep_CCB'),
                    new StringField('tel_CCB'),
                    new StringField('Dia_Culto_1'),
                    new StringField('Hora_Culto_1'),
                    new StringField('Dia_Culto_2'),
                    new StringField('Hora_Culto_2'),
                    new StringField('Dia_Culto_3'),
                    new StringField('Hora_Culto_3'),
                    new StringField('Dia_Culto_4'),
                    new StringField('Hora_Culto_4'),
                    new StringField('Dia_RJM'),
                    new StringField('Hora_RJM'),
                    new StringField('Dia_Ensaio'),
                    new StringField('Hora_Ensaio'),
                    new StringField('Semana_ensaio')
                )
            );
            $lookupDataset->setOrderByField('Ds_CCB', 'ASC');
            $editColumn = new DynamicLookupEditColumn('CCB', 'Id_CCB', 'Id_CCB_Ds_CCB', 'multi_edit_cadvoluntarios_Id_CCB_search', $editor, $this->dataset, $lookupDataset, 'Id_CCB', 'Ds_CCB', '');
            $editColumn->setNestedInsertFormLink(
                $this->GetHandlerLink(cadvoluntarios_Id_CCBNestedPage::getNestedInsertHandlerName())
            );
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for NM_PROFISSAO field
            //
            $editor = new TextEdit('nm_profissao_edit');
            $editColumn = new CustomEditColumn('PROFISSAO', 'NM_PROFISSAO', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for ID_FUNCAO1 field
            //
            $editor = new DynamicCombobox('id_funcao1_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`funcoes`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id_Funcao', true, true, true),
                    new StringField('Ds_Funcao'),
                    new IntegerField('id_tipofuncao')
                )
            );
            $lookupDataset->setOrderByField('Ds_Funcao', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Função Principal', 'ID_FUNCAO1', 'ID_FUNCAO1_Ds_Funcao', 'multi_edit_cadvoluntarios_ID_FUNCAO1_search', $editor, $this->dataset, $lookupDataset, 'Id_Funcao', 'Ds_Funcao', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for ID_FUNCAO2 field
            //
            $editor = new DynamicCombobox('id_funcao2_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`funcoes`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id_Funcao', true, true, true),
                    new StringField('Ds_Funcao'),
                    new IntegerField('id_tipofuncao')
                )
            );
            $lookupDataset->setOrderByField('Ds_Funcao', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Função Complementar', 'ID_FUNCAO2', 'ID_FUNCAO2_Ds_Funcao', 'multi_edit_cadvoluntarios_ID_FUNCAO2_search', $editor, $this->dataset, $lookupDataset, 'Id_Funcao', 'Ds_Funcao', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for ID_FUNCAO3 field
            //
            $editor = new DynamicCombobox('id_funcao3_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`funcoes`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id_Funcao', true, true, true),
                    new StringField('Ds_Funcao'),
                    new IntegerField('id_tipofuncao')
                )
            );
            $lookupDataset->setOrderByField('Ds_Funcao', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Função Adicional', 'ID_FUNCAO3', 'ID_FUNCAO3_Ds_Funcao', 'multi_edit_cadvoluntarios_ID_FUNCAO3_search', $editor, $this->dataset, $lookupDataset, 'Id_Funcao', 'Ds_Funcao', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for CEP_VOLUNTARIO field
            //
            $editor = new MaskedEdit('cep_voluntario_edit', '99999-999');
            $editColumn = new CustomEditColumn('CEP', 'CEP_VOLUNTARIO', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for DS_ENDERECO_VOLUNTARIO field
            //
            $editor = new TextEdit('ds_endereco_voluntario_edit');
            $editColumn = new CustomEditColumn('Endereço', 'DS_ENDERECO_VOLUNTARIO', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for TEL1_VOLUNTARIO field
            //
            $editor = new MaskedEdit('tel1_voluntario_edit', '(99) 9999-9999');
            $editColumn = new CustomEditColumn('Telefone Fixo', 'TEL1_VOLUNTARIO', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for TEL2_VOLUNTARIO field
            //
            $editor = new MaskedEdit('tel2_voluntario_edit', '(99) 9 9999-9999');
            $editColumn = new CustomEditColumn('Telefone Móvel', 'TEL2_VOLUNTARIO', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for TEL3_VOLUNTARIO field
            //
            $editor = new MaskedEdit('tel3_voluntario_edit', '(99) 9 9999-9999');
            $editColumn = new CustomEditColumn('Telefone Adicional', 'TEL3_VOLUNTARIO', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for DS_EMAIL_VOLUNTARIO field
            //
            $editor = new TextEdit('ds_email_voluntario_edit');
            $editColumn = new CustomEditColumn('E-mail', 'DS_EMAIL_VOLUNTARIO', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new EMailValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('EmailValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for EST_CIVIL field
            //
            $editor = new ComboBox('est_civil_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('Solteiro', 'Solteiro');
            $editor->addChoice('Casado', 'Casado');
            $editor->addChoice('Viúvo', 'Viúvo');
            $editor->addChoice('Separado judicialmente', 'Separado judicialmente');
            $editor->addChoice('Divorciado', 'Divorciado');
            $editor->addChoice('Não Informado', 'Não Informado');
            $editColumn = new CustomEditColumn('Estado Civil', 'EST_CIVIL', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for DT_NASC_VOLUNTARIO field
            //
            $editor = new MaskedEdit('dt_nasc_voluntario_edit', '99/99/9999');
            $editColumn = new CustomEditColumn('Data Nascimento', 'DT_NASC_VOLUNTARIO', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for CD_SEXO field
            //
            $editor = new ComboBox('cd_sexo_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('Masculino', 'Masculino');
            $editor->addChoice('Feminino', 'Feminino');
            $editColumn = new CustomEditColumn('Sexo', 'CD_SEXO', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for DS_TAMANHO_LUVA field
            //
            $editor = new ComboBox('ds_tamanho_luva_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('P', 'P');
            $editor->addChoice('M', 'M');
            $editor->addChoice('G', 'G');
            $editColumn = new CustomEditColumn('Luva', 'DS_TAMANHO_LUVA', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for NR_BOTA_UTILIZAR field
            //
            $editor = new TextEdit('nr_bota_utilizar_edit');
            $editColumn = new CustomEditColumn('Nr Bota', 'NR_BOTA_UTILIZAR', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new NumberValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('NumberValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for ST_JA_REALIZOU_ASO field
            //
            $editor = new ComboBox('st_ja_realizou_aso_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('Sim', 'Sim');
            $editor->addChoice('Não', 'Não');
            $editColumn = new CustomEditColumn('ASO', 'ST_JA_REALIZOU_ASO', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for ST_PARTICIPOU_NR35 field
            //
            $editor = new ComboBox('st_participou_nr35_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('Sim', 'Sim');
            $editor->addChoice('Não', 'Não');
            $editColumn = new CustomEditColumn('NR35', 'ST_PARTICIPOU_NR35', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for ST_PARTICIPOU_SEG_TRABALHO field
            //
            $editor = new ComboBox('st_participou_seg_trabalho_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('Sim', 'Sim');
            $editor->addChoice('Não', 'Não');
            $editColumn = new CustomEditColumn('TST', 'ST_PARTICIPOU_SEG_TRABALHO', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for foto_voluntario field
            //
            $editor = new ImageUploader('foto_voluntario_edit');
            $editor->SetShowImage(true);
            $editor->setAcceptableFileTypes('image/*');
            $editColumn = new UploadFileToFolderColumn('Foto Voluntario', 'foto_voluntario', $editor, $this->dataset, false, false, 'fotovoluntario/', '%random%.%original_file_extension%', $this->OnFileUpload, false);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetGenerationImageThumbnails(
                'thumb_voluntario',
                'fotovoluntario/',
                Delegate::CreateFromMethod($this, 'foto_voluntario_Thumbnail_GenerateFileName_multi_edit'),
                new ImageFitByHeightResizeFilter(30),
                false
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for foto_carta field
            //
            $editor = new ImageUploader('foto_carta_edit');
            $editor->SetShowImage(true);
            $editor->setAcceptableFileTypes('image/*');
            $editColumn = new UploadFileToFolderColumn('Foto Carta', 'foto_carta', $editor, $this->dataset, false, false, 'fotocarta/', '%random%.%original_file_extension%', $this->OnFileUpload, false);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetGenerationImageThumbnails(
                'thumb_carta',
                'fotocarta/',
                Delegate::CreateFromMethod($this, 'foto_carta_Thumbnail_GenerateFileName_multi_edit'),
                new ImageFitByHeightResizeFilter(30),
                false
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for foto_nr35 field
            //
            $editor = new ImageUploader('foto_nr35_edit');
            $editor->SetShowImage(true);
            $editor->setAcceptableFileTypes('image/*');
            $editColumn = new UploadFileToFolderColumn('Foto Nr35', 'foto_nr35', $editor, $this->dataset, false, false, 'fotonr35/', '%random%.%original_file_extension%', $this->OnFileUpload, false);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetGenerationImageThumbnails(
                'thumb_nr35',
                'fotonr35/',
                Delegate::CreateFromMethod($this, 'foto_nr35_Thumbnail_GenerateFileName_multi_edit'),
                new ImageFitByHeightResizeFilter(30),
                false
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for foto_tst field
            //
            $editor = new ImageUploader('foto_tst_edit');
            $editor->SetShowImage(true);
            $editor->setAcceptableFileTypes('image/*');
            $editColumn = new UploadFileToFolderColumn('Foto Tst', 'foto_tst', $editor, $this->dataset, false, false, 'fototst/', '%random%.%original_file_extension%', $this->OnFileUpload, false);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetGenerationImageThumbnails(
                'thumb_tst',
                'fototst/',
                Delegate::CreateFromMethod($this, 'foto_tst_Thumbnail_GenerateFileName_multi_edit'),
                new ImageFitByHeightResizeFilter(30),
                false
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for foto_aso field
            //
            $editor = new ImageUploader('foto_aso_edit');
            $editor->SetShowImage(true);
            $editor->setAcceptableFileTypes('image/*');
            $editColumn = new UploadFileToFolderColumn('Foto Aso', 'foto_aso', $editor, $this->dataset, false, false, 'fotoaso/', '%random%.%original_file_extension%', $this->OnFileUpload, false);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetGenerationImageThumbnails(
                'thumb_aso',
                'fotoaso/',
                Delegate::CreateFromMethod($this, 'foto_aso_Thumbnail_GenerateFileName_multi_edit'),
                new ImageFitByHeightResizeFilter(30),
                false
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for CPF_VOLUNTARIO field
            //
            $editor = new TextEdit('cpf_voluntario_edit');
            $editor->SetMaxLength(11);
            $editColumn = new CustomEditColumn('CPF VOLUNTARIO', 'CPF_VOLUNTARIO', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for DT_ALTERACAO field
            //
            $editor = new DateTimeEdit('dt_alteracao_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('DT ALTERACAO', 'DT_ALTERACAO', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for Id_voluntario field
            //
            $editor = new MaskedEdit('id_voluntario_edit', '999.999.999-99');
            $editColumn = new CustomEditColumn('CPF', 'Id_voluntario', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new CustomRegExpValidator('[0-9]{3}\.?[0-9]{3}\.?[0-9]{3}\-?[0-9]{2}', StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RegExpValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for NM_VOLUNTARIO field
            //
            $editor = new TextEdit('nm_voluntario_edit');
            $editColumn = new CustomEditColumn('Nome', 'NM_VOLUNTARIO', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Id_CCB field
            //
            $editor = new DynamicCombobox('id_ccb_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`cadcongregacoes`');
            $lookupDataset->addFields(
                array(
                    new StringField('Id_CCB', true, true),
                    new StringField('Ds_CCB'),
                    new StringField('Ds_SubSetor'),
                    new StringField('Ds_Endereco_CCB'),
                    new StringField('Cep_CCB'),
                    new StringField('tel_CCB'),
                    new StringField('Dia_Culto_1'),
                    new StringField('Hora_Culto_1'),
                    new StringField('Dia_Culto_2'),
                    new StringField('Hora_Culto_2'),
                    new StringField('Dia_Culto_3'),
                    new StringField('Hora_Culto_3'),
                    new StringField('Dia_Culto_4'),
                    new StringField('Hora_Culto_4'),
                    new StringField('Dia_RJM'),
                    new StringField('Hora_RJM'),
                    new StringField('Dia_Ensaio'),
                    new StringField('Hora_Ensaio'),
                    new StringField('Semana_ensaio')
                )
            );
            $lookupDataset->setOrderByField('Ds_CCB', 'ASC');
            $editColumn = new DynamicLookupEditColumn('CCB', 'Id_CCB', 'Id_CCB_Ds_CCB', 'insert_cadvoluntarios_Id_CCB_search', $editor, $this->dataset, $lookupDataset, 'Id_CCB', 'Ds_CCB', '');
            $editColumn->setNestedInsertFormLink(
                $this->GetHandlerLink(cadvoluntarios_Id_CCBNestedPage::getNestedInsertHandlerName())
            );
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for NM_PROFISSAO field
            //
            $editor = new TextEdit('nm_profissao_edit');
            $editColumn = new CustomEditColumn('PROFISSAO', 'NM_PROFISSAO', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ID_FUNCAO1 field
            //
            $editor = new DynamicCombobox('id_funcao1_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`funcoes`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id_Funcao', true, true, true),
                    new StringField('Ds_Funcao'),
                    new IntegerField('id_tipofuncao')
                )
            );
            $lookupDataset->setOrderByField('Ds_Funcao', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Função Principal', 'ID_FUNCAO1', 'ID_FUNCAO1_Ds_Funcao', 'insert_cadvoluntarios_ID_FUNCAO1_search', $editor, $this->dataset, $lookupDataset, 'Id_Funcao', 'Ds_Funcao', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ID_FUNCAO2 field
            //
            $editor = new DynamicCombobox('id_funcao2_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`funcoes`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id_Funcao', true, true, true),
                    new StringField('Ds_Funcao'),
                    new IntegerField('id_tipofuncao')
                )
            );
            $lookupDataset->setOrderByField('Ds_Funcao', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Função Complementar', 'ID_FUNCAO2', 'ID_FUNCAO2_Ds_Funcao', 'insert_cadvoluntarios_ID_FUNCAO2_search', $editor, $this->dataset, $lookupDataset, 'Id_Funcao', 'Ds_Funcao', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ID_FUNCAO3 field
            //
            $editor = new DynamicCombobox('id_funcao3_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`funcoes`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id_Funcao', true, true, true),
                    new StringField('Ds_Funcao'),
                    new IntegerField('id_tipofuncao')
                )
            );
            $lookupDataset->setOrderByField('Ds_Funcao', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Função Adicional', 'ID_FUNCAO3', 'ID_FUNCAO3_Ds_Funcao', 'insert_cadvoluntarios_ID_FUNCAO3_search', $editor, $this->dataset, $lookupDataset, 'Id_Funcao', 'Ds_Funcao', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for CEP_VOLUNTARIO field
            //
            $editor = new MaskedEdit('cep_voluntario_edit', '99999-999');
            $editColumn = new CustomEditColumn('CEP', 'CEP_VOLUNTARIO', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for DS_ENDERECO_VOLUNTARIO field
            //
            $editor = new TextEdit('ds_endereco_voluntario_edit');
            $editColumn = new CustomEditColumn('Endereço', 'DS_ENDERECO_VOLUNTARIO', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for TEL1_VOLUNTARIO field
            //
            $editor = new MaskedEdit('tel1_voluntario_edit', '(99) 9999-9999');
            $editColumn = new CustomEditColumn('Telefone Fixo', 'TEL1_VOLUNTARIO', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for TEL2_VOLUNTARIO field
            //
            $editor = new MaskedEdit('tel2_voluntario_edit', '(99) 9 9999-9999');
            $editColumn = new CustomEditColumn('Telefone Móvel', 'TEL2_VOLUNTARIO', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for TEL3_VOLUNTARIO field
            //
            $editor = new MaskedEdit('tel3_voluntario_edit', '(99) 9 9999-9999');
            $editColumn = new CustomEditColumn('Telefone Adicional', 'TEL3_VOLUNTARIO', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for DS_EMAIL_VOLUNTARIO field
            //
            $editor = new TextEdit('ds_email_voluntario_edit');
            $editColumn = new CustomEditColumn('E-mail', 'DS_EMAIL_VOLUNTARIO', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new EMailValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('EmailValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for EST_CIVIL field
            //
            $editor = new ComboBox('est_civil_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('Solteiro', 'Solteiro');
            $editor->addChoice('Casado', 'Casado');
            $editor->addChoice('Viúvo', 'Viúvo');
            $editor->addChoice('Separado judicialmente', 'Separado judicialmente');
            $editor->addChoice('Divorciado', 'Divorciado');
            $editor->addChoice('Não Informado', 'Não Informado');
            $editColumn = new CustomEditColumn('Estado Civil', 'EST_CIVIL', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for DT_NASC_VOLUNTARIO field
            //
            $editor = new MaskedEdit('dt_nasc_voluntario_edit', '99/99/9999');
            $editColumn = new CustomEditColumn('Data Nascimento', 'DT_NASC_VOLUNTARIO', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for CD_SEXO field
            //
            $editor = new ComboBox('cd_sexo_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('Masculino', 'Masculino');
            $editor->addChoice('Feminino', 'Feminino');
            $editColumn = new CustomEditColumn('Sexo', 'CD_SEXO', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for DS_TAMANHO_LUVA field
            //
            $editor = new ComboBox('ds_tamanho_luva_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('P', 'P');
            $editor->addChoice('M', 'M');
            $editor->addChoice('G', 'G');
            $editColumn = new CustomEditColumn('Luva', 'DS_TAMANHO_LUVA', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for NR_BOTA_UTILIZAR field
            //
            $editor = new TextEdit('nr_bota_utilizar_edit');
            $editColumn = new CustomEditColumn('Nr Bota', 'NR_BOTA_UTILIZAR', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new NumberValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('NumberValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ST_JA_REALIZOU_ASO field
            //
            $editor = new ComboBox('st_ja_realizou_aso_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('Sim', 'Sim');
            $editor->addChoice('Não', 'Não');
            $editColumn = new CustomEditColumn('ASO', 'ST_JA_REALIZOU_ASO', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ST_PARTICIPOU_NR35 field
            //
            $editor = new ComboBox('st_participou_nr35_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('Sim', 'Sim');
            $editor->addChoice('Não', 'Não');
            $editColumn = new CustomEditColumn('NR35', 'ST_PARTICIPOU_NR35', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ST_PARTICIPOU_SEG_TRABALHO field
            //
            $editor = new ComboBox('st_participou_seg_trabalho_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('Sim', 'Sim');
            $editor->addChoice('Não', 'Não');
            $editColumn = new CustomEditColumn('TST', 'ST_PARTICIPOU_SEG_TRABALHO', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for foto_voluntario field
            //
            $editor = new ImageUploader('foto_voluntario_edit');
            $editor->SetShowImage(true);
            $editor->setAcceptableFileTypes('image/*');
            $editColumn = new UploadFileToFolderColumn('Foto Voluntario', 'foto_voluntario', $editor, $this->dataset, false, false, 'fotovoluntario/', '%random%.%original_file_extension%', $this->OnFileUpload, false);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetGenerationImageThumbnails(
                'thumb_voluntario',
                'fotovoluntario/',
                Delegate::CreateFromMethod($this, 'foto_voluntario_Thumbnail_GenerateFileName_insert'),
                new ImageFitByHeightResizeFilter(30),
                false
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for foto_carta field
            //
            $editor = new ImageUploader('foto_carta_edit');
            $editor->SetShowImage(true);
            $editor->setAcceptableFileTypes('image/*');
            $editColumn = new UploadFileToFolderColumn('Foto Carta', 'foto_carta', $editor, $this->dataset, false, false, 'fotocarta/', '%random%.%original_file_extension%', $this->OnFileUpload, false);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetGenerationImageThumbnails(
                'thumb_carta',
                'fotocarta/',
                Delegate::CreateFromMethod($this, 'foto_carta_Thumbnail_GenerateFileName_insert'),
                new ImageFitByHeightResizeFilter(30),
                false
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for foto_nr35 field
            //
            $editor = new ImageUploader('foto_nr35_edit');
            $editor->SetShowImage(true);
            $editor->setAcceptableFileTypes('image/*');
            $editColumn = new UploadFileToFolderColumn('Foto Nr35', 'foto_nr35', $editor, $this->dataset, false, false, 'fotonr35/', '%random%.%original_file_extension%', $this->OnFileUpload, false);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetGenerationImageThumbnails(
                'thumb_nr35',
                'fotonr35/',
                Delegate::CreateFromMethod($this, 'foto_nr35_Thumbnail_GenerateFileName_insert'),
                new ImageFitByHeightResizeFilter(30),
                false
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for foto_tst field
            //
            $editor = new ImageUploader('foto_tst_edit');
            $editor->SetShowImage(true);
            $editor->setAcceptableFileTypes('image/*');
            $editColumn = new UploadFileToFolderColumn('Foto Tst', 'foto_tst', $editor, $this->dataset, false, false, 'fototst/', '%random%.%original_file_extension%', $this->OnFileUpload, false);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetGenerationImageThumbnails(
                'thumb_tst',
                'fototst/',
                Delegate::CreateFromMethod($this, 'foto_tst_Thumbnail_GenerateFileName_insert'),
                new ImageFitByHeightResizeFilter(30),
                false
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for foto_aso field
            //
            $editor = new ImageUploader('foto_aso_edit');
            $editor->SetShowImage(true);
            $editor->setAcceptableFileTypes('image/*');
            $editColumn = new UploadFileToFolderColumn('Foto Aso', 'foto_aso', $editor, $this->dataset, false, false, 'fotoaso/', '%random%.%original_file_extension%', $this->OnFileUpload, false);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetGenerationImageThumbnails(
                'thumb_aso',
                'fotoaso/',
                Delegate::CreateFromMethod($this, 'foto_aso_Thumbnail_GenerateFileName_insert'),
                new ImageFitByHeightResizeFilter(30),
                false
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for CPF_VOLUNTARIO field
            //
            $editor = new TextEdit('cpf_voluntario_edit');
            $editor->SetMaxLength(11);
            $editColumn = new CustomEditColumn('CPF VOLUNTARIO', 'CPF_VOLUNTARIO', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for DT_ALTERACAO field
            //
            $editor = new DateTimeEdit('dt_alteracao_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('DT ALTERACAO', 'DT_ALTERACAO', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            $grid->SetShowAddButton(true && $this->GetSecurityInfo()->HasAddGrant());
        }
    
        private function AddMultiUploadColumn(Grid $grid)
        {
    
        }
    
        protected function AddPrintColumns(Grid $grid)
        {
            //
            // View column for Id_voluntario field
            //
            $column = new TextViewColumn('Id_voluntario', 'Id_voluntario', 'CPF', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for NM_VOLUNTARIO field
            //
            $column = new StringTransformViewColumn('NM_VOLUNTARIO', 'NM_VOLUNTARIO', 'Nome', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_NM_VOLUNTARIO_handler_print');
            $column->setStringTransformFunction('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Ds_SubSetor field
            //
            $column = new TextViewColumn('Ds_SubSetor', 'Ds_SubSetor_Ds_SubSetor', 'SubSetor', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_Ds_SubSetor_Ds_SubSetor_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('Id_CCB', 'Id_CCB_Ds_CCB', 'CCB', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for NM_PROFISSAO field
            //
            $column = new TextViewColumn('NM_PROFISSAO', 'NM_PROFISSAO', 'PROFISSAO', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_NM_PROFISSAO_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Ds_Funcao field
            //
            $column = new TextViewColumn('ID_FUNCAO1', 'ID_FUNCAO1_Ds_Funcao', 'Função Principal', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Ds_Funcao field
            //
            $column = new TextViewColumn('ID_FUNCAO2', 'ID_FUNCAO2_Ds_Funcao', 'Função Complementar', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Ds_Funcao field
            //
            $column = new TextViewColumn('ID_FUNCAO3', 'ID_FUNCAO3_Ds_Funcao', 'Função Adicional', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for CEP_VOLUNTARIO field
            //
            $column = new TextViewColumn('CEP_VOLUNTARIO', 'CEP_VOLUNTARIO', 'CEP', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_CEP_VOLUNTARIO_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for DS_ENDERECO_VOLUNTARIO field
            //
            $column = new TextViewColumn('DS_ENDERECO_VOLUNTARIO', 'DS_ENDERECO_VOLUNTARIO', 'Endereço', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_DS_ENDERECO_VOLUNTARIO_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for TEL1_VOLUNTARIO field
            //
            $column = new TextViewColumn('TEL1_VOLUNTARIO', 'TEL1_VOLUNTARIO', 'Telefone Fixo', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_TEL1_VOLUNTARIO_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for TEL2_VOLUNTARIO field
            //
            $column = new TextViewColumn('TEL2_VOLUNTARIO', 'TEL2_VOLUNTARIO', 'Telefone Móvel', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_TEL2_VOLUNTARIO_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for TEL3_VOLUNTARIO field
            //
            $column = new TextViewColumn('TEL3_VOLUNTARIO', 'TEL3_VOLUNTARIO', 'Telefone Adicional', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_TEL3_VOLUNTARIO_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for DS_EMAIL_VOLUNTARIO field
            //
            $column = new TextViewColumn('DS_EMAIL_VOLUNTARIO', 'DS_EMAIL_VOLUNTARIO', 'E-mail', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_DS_EMAIL_VOLUNTARIO_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for EST_CIVIL field
            //
            $column = new TextViewColumn('EST_CIVIL', 'EST_CIVIL', 'Estado Civil', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for DT_NASC_VOLUNTARIO field
            //
            $column = new TextViewColumn('DT_NASC_VOLUNTARIO', 'DT_NASC_VOLUNTARIO', 'Data Nascimento', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_DT_NASC_VOLUNTARIO_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for CD_SEXO field
            //
            $column = new TextViewColumn('CD_SEXO', 'CD_SEXO', 'Sexo', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_CD_SEXO_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for DS_TAMANHO_LUVA field
            //
            $column = new TextViewColumn('DS_TAMANHO_LUVA', 'DS_TAMANHO_LUVA', 'Luva', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_DS_TAMANHO_LUVA_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for NR_BOTA_UTILIZAR field
            //
            $column = new TextViewColumn('NR_BOTA_UTILIZAR', 'NR_BOTA_UTILIZAR', 'Nr Bota', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_NR_BOTA_UTILIZAR_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for ST_JA_REALIZOU_ASO field
            //
            $column = new TextViewColumn('ST_JA_REALIZOU_ASO', 'ST_JA_REALIZOU_ASO', 'ASO', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_ST_JA_REALIZOU_ASO_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for ST_PARTICIPOU_NR35 field
            //
            $column = new TextViewColumn('ST_PARTICIPOU_NR35', 'ST_PARTICIPOU_NR35', 'NR35', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_ST_PARTICIPOU_NR35_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for ST_PARTICIPOU_SEG_TRABALHO field
            //
            $column = new TextViewColumn('ST_PARTICIPOU_SEG_TRABALHO', 'ST_PARTICIPOU_SEG_TRABALHO', 'TST', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_ST_PARTICIPOU_SEG_TRABALHO_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for ID_AUX field
            //
            $column = new NumberViewColumn('ID_AUX', 'ID_AUX', 'ID AUX', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for foto_voluntario field
            //
            $column = new ExternalImageViewColumn('foto_voluntario', 'foto_voluntario', 'Foto Voluntario', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for foto_carta field
            //
            $column = new ExternalImageViewColumn('foto_carta', 'foto_carta', 'Foto Carta', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for foto_nr35 field
            //
            $column = new ExternalImageViewColumn('foto_nr35', 'foto_nr35', 'Foto Nr35', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for foto_tst field
            //
            $column = new ExternalImageViewColumn('foto_tst', 'foto_tst', 'Foto Tst', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for foto_aso field
            //
            $column = new ExternalImageViewColumn('foto_aso', 'foto_aso', 'Foto Aso', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for thumb_voluntario field
            //
            $column = new ExternalImageViewColumn('thumb_voluntario', 'thumb_voluntario', 'Foto Voluntário', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for thumb_carta field
            //
            $column = new ExternalImageViewColumn('thumb_carta', 'thumb_carta', 'Foto Carta', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for thumb_nr35 field
            //
            $column = new ExternalImageViewColumn('thumb_nr35', 'thumb_nr35', 'Foto Certificado NR35', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for thumb_tst field
            //
            $column = new ExternalImageViewColumn('thumb_tst', 'thumb_tst', 'Foto Certificado TST', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for thumb_aso field
            //
            $column = new ExternalImageViewColumn('thumb_aso', 'thumb_aso', 'Foto Certificado ASO', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for CPF_VOLUNTARIO field
            //
            $column = new TextViewColumn('CPF_VOLUNTARIO', 'CPF_VOLUNTARIO', 'CPF VOLUNTARIO', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for DT_ALTERACAO field
            //
            $column = new DateTimeViewColumn('DT_ALTERACAO', 'DT_ALTERACAO', 'DT ALTERACAO', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for Id_voluntario field
            //
            $column = new TextViewColumn('Id_voluntario', 'Id_voluntario', 'CPF', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for NM_VOLUNTARIO field
            //
            $column = new StringTransformViewColumn('NM_VOLUNTARIO', 'NM_VOLUNTARIO', 'Nome', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_NM_VOLUNTARIO_handler_export');
            $column->setStringTransformFunction('');
            $grid->AddExportColumn($column);
            
            //
            // View column for Ds_SubSetor field
            //
            $column = new TextViewColumn('Ds_SubSetor', 'Ds_SubSetor_Ds_SubSetor', 'SubSetor', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_Ds_SubSetor_Ds_SubSetor_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('Id_CCB', 'Id_CCB_Ds_CCB', 'CCB', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for NM_PROFISSAO field
            //
            $column = new TextViewColumn('NM_PROFISSAO', 'NM_PROFISSAO', 'PROFISSAO', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_NM_PROFISSAO_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for Ds_Funcao field
            //
            $column = new TextViewColumn('ID_FUNCAO1', 'ID_FUNCAO1_Ds_Funcao', 'Função Principal', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for Ds_Funcao field
            //
            $column = new TextViewColumn('ID_FUNCAO2', 'ID_FUNCAO2_Ds_Funcao', 'Função Complementar', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for Ds_Funcao field
            //
            $column = new TextViewColumn('ID_FUNCAO3', 'ID_FUNCAO3_Ds_Funcao', 'Função Adicional', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for CEP_VOLUNTARIO field
            //
            $column = new TextViewColumn('CEP_VOLUNTARIO', 'CEP_VOLUNTARIO', 'CEP', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_CEP_VOLUNTARIO_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for DS_ENDERECO_VOLUNTARIO field
            //
            $column = new TextViewColumn('DS_ENDERECO_VOLUNTARIO', 'DS_ENDERECO_VOLUNTARIO', 'Endereço', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_DS_ENDERECO_VOLUNTARIO_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for TEL1_VOLUNTARIO field
            //
            $column = new TextViewColumn('TEL1_VOLUNTARIO', 'TEL1_VOLUNTARIO', 'Telefone Fixo', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_TEL1_VOLUNTARIO_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for TEL2_VOLUNTARIO field
            //
            $column = new TextViewColumn('TEL2_VOLUNTARIO', 'TEL2_VOLUNTARIO', 'Telefone Móvel', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_TEL2_VOLUNTARIO_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for TEL3_VOLUNTARIO field
            //
            $column = new TextViewColumn('TEL3_VOLUNTARIO', 'TEL3_VOLUNTARIO', 'Telefone Adicional', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_TEL3_VOLUNTARIO_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for DS_EMAIL_VOLUNTARIO field
            //
            $column = new TextViewColumn('DS_EMAIL_VOLUNTARIO', 'DS_EMAIL_VOLUNTARIO', 'E-mail', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_DS_EMAIL_VOLUNTARIO_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for EST_CIVIL field
            //
            $column = new TextViewColumn('EST_CIVIL', 'EST_CIVIL', 'Estado Civil', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for DT_NASC_VOLUNTARIO field
            //
            $column = new TextViewColumn('DT_NASC_VOLUNTARIO', 'DT_NASC_VOLUNTARIO', 'Data Nascimento', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_DT_NASC_VOLUNTARIO_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for CD_SEXO field
            //
            $column = new TextViewColumn('CD_SEXO', 'CD_SEXO', 'Sexo', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_CD_SEXO_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for DS_TAMANHO_LUVA field
            //
            $column = new TextViewColumn('DS_TAMANHO_LUVA', 'DS_TAMANHO_LUVA', 'Luva', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_DS_TAMANHO_LUVA_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for NR_BOTA_UTILIZAR field
            //
            $column = new TextViewColumn('NR_BOTA_UTILIZAR', 'NR_BOTA_UTILIZAR', 'Nr Bota', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_NR_BOTA_UTILIZAR_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for ST_JA_REALIZOU_ASO field
            //
            $column = new TextViewColumn('ST_JA_REALIZOU_ASO', 'ST_JA_REALIZOU_ASO', 'ASO', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_ST_JA_REALIZOU_ASO_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for ST_PARTICIPOU_NR35 field
            //
            $column = new TextViewColumn('ST_PARTICIPOU_NR35', 'ST_PARTICIPOU_NR35', 'NR35', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_ST_PARTICIPOU_NR35_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for ST_PARTICIPOU_SEG_TRABALHO field
            //
            $column = new TextViewColumn('ST_PARTICIPOU_SEG_TRABALHO', 'ST_PARTICIPOU_SEG_TRABALHO', 'TST', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_ST_PARTICIPOU_SEG_TRABALHO_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for ID_AUX field
            //
            $column = new NumberViewColumn('ID_AUX', 'ID_AUX', 'ID AUX', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for foto_voluntario field
            //
            $column = new ExternalImageViewColumn('foto_voluntario', 'foto_voluntario', 'Foto Voluntario', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for foto_carta field
            //
            $column = new ExternalImageViewColumn('foto_carta', 'foto_carta', 'Foto Carta', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for foto_nr35 field
            //
            $column = new ExternalImageViewColumn('foto_nr35', 'foto_nr35', 'Foto Nr35', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for foto_tst field
            //
            $column = new ExternalImageViewColumn('foto_tst', 'foto_tst', 'Foto Tst', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for foto_aso field
            //
            $column = new ExternalImageViewColumn('foto_aso', 'foto_aso', 'Foto Aso', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for thumb_voluntario field
            //
            $column = new ExternalImageViewColumn('thumb_voluntario', 'thumb_voluntario', 'Foto Voluntário', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for thumb_carta field
            //
            $column = new ExternalImageViewColumn('thumb_carta', 'thumb_carta', 'Foto Carta', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for thumb_nr35 field
            //
            $column = new ExternalImageViewColumn('thumb_nr35', 'thumb_nr35', 'Foto Certificado NR35', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for thumb_tst field
            //
            $column = new ExternalImageViewColumn('thumb_tst', 'thumb_tst', 'Foto Certificado TST', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for thumb_aso field
            //
            $column = new ExternalImageViewColumn('thumb_aso', 'thumb_aso', 'Foto Certificado ASO', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for CPF_VOLUNTARIO field
            //
            $column = new TextViewColumn('CPF_VOLUNTARIO', 'CPF_VOLUNTARIO', 'CPF VOLUNTARIO', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for DT_ALTERACAO field
            //
            $column = new DateTimeViewColumn('DT_ALTERACAO', 'DT_ALTERACAO', 'DT ALTERACAO', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for Id_voluntario field
            //
            $column = new TextViewColumn('Id_voluntario', 'Id_voluntario', 'CPF', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for NM_VOLUNTARIO field
            //
            $column = new StringTransformViewColumn('NM_VOLUNTARIO', 'NM_VOLUNTARIO', 'Nome', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_NM_VOLUNTARIO_handler_compare');
            $column->setStringTransformFunction('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Ds_SubSetor field
            //
            $column = new TextViewColumn('Ds_SubSetor', 'Ds_SubSetor_Ds_SubSetor', 'SubSetor', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_Ds_SubSetor_Ds_SubSetor_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('Id_CCB', 'Id_CCB_Ds_CCB', 'CCB', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for NM_PROFISSAO field
            //
            $column = new TextViewColumn('NM_PROFISSAO', 'NM_PROFISSAO', 'PROFISSAO', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_NM_PROFISSAO_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Ds_Funcao field
            //
            $column = new TextViewColumn('ID_FUNCAO1', 'ID_FUNCAO1_Ds_Funcao', 'Função Principal', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for Ds_Funcao field
            //
            $column = new TextViewColumn('ID_FUNCAO2', 'ID_FUNCAO2_Ds_Funcao', 'Função Complementar', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for Ds_Funcao field
            //
            $column = new TextViewColumn('ID_FUNCAO3', 'ID_FUNCAO3_Ds_Funcao', 'Função Adicional', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for CEP_VOLUNTARIO field
            //
            $column = new TextViewColumn('CEP_VOLUNTARIO', 'CEP_VOLUNTARIO', 'CEP', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_CEP_VOLUNTARIO_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for DS_ENDERECO_VOLUNTARIO field
            //
            $column = new TextViewColumn('DS_ENDERECO_VOLUNTARIO', 'DS_ENDERECO_VOLUNTARIO', 'Endereço', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_DS_ENDERECO_VOLUNTARIO_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for TEL1_VOLUNTARIO field
            //
            $column = new TextViewColumn('TEL1_VOLUNTARIO', 'TEL1_VOLUNTARIO', 'Telefone Fixo', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_TEL1_VOLUNTARIO_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for TEL2_VOLUNTARIO field
            //
            $column = new TextViewColumn('TEL2_VOLUNTARIO', 'TEL2_VOLUNTARIO', 'Telefone Móvel', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_TEL2_VOLUNTARIO_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for TEL3_VOLUNTARIO field
            //
            $column = new TextViewColumn('TEL3_VOLUNTARIO', 'TEL3_VOLUNTARIO', 'Telefone Adicional', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_TEL3_VOLUNTARIO_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for DS_EMAIL_VOLUNTARIO field
            //
            $column = new TextViewColumn('DS_EMAIL_VOLUNTARIO', 'DS_EMAIL_VOLUNTARIO', 'E-mail', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_DS_EMAIL_VOLUNTARIO_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for EST_CIVIL field
            //
            $column = new TextViewColumn('EST_CIVIL', 'EST_CIVIL', 'Estado Civil', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for DT_NASC_VOLUNTARIO field
            //
            $column = new TextViewColumn('DT_NASC_VOLUNTARIO', 'DT_NASC_VOLUNTARIO', 'Data Nascimento', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_DT_NASC_VOLUNTARIO_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for CD_SEXO field
            //
            $column = new TextViewColumn('CD_SEXO', 'CD_SEXO', 'Sexo', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_CD_SEXO_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for DS_TAMANHO_LUVA field
            //
            $column = new TextViewColumn('DS_TAMANHO_LUVA', 'DS_TAMANHO_LUVA', 'Luva', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_DS_TAMANHO_LUVA_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for NR_BOTA_UTILIZAR field
            //
            $column = new TextViewColumn('NR_BOTA_UTILIZAR', 'NR_BOTA_UTILIZAR', 'Nr Bota', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_NR_BOTA_UTILIZAR_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for ST_JA_REALIZOU_ASO field
            //
            $column = new TextViewColumn('ST_JA_REALIZOU_ASO', 'ST_JA_REALIZOU_ASO', 'ASO', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_ST_JA_REALIZOU_ASO_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for ST_PARTICIPOU_NR35 field
            //
            $column = new TextViewColumn('ST_PARTICIPOU_NR35', 'ST_PARTICIPOU_NR35', 'NR35', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_ST_PARTICIPOU_NR35_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for ST_PARTICIPOU_SEG_TRABALHO field
            //
            $column = new TextViewColumn('ST_PARTICIPOU_SEG_TRABALHO', 'ST_PARTICIPOU_SEG_TRABALHO', 'TST', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_ST_PARTICIPOU_SEG_TRABALHO_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for foto_voluntario field
            //
            $column = new ExternalImageViewColumn('foto_voluntario', 'foto_voluntario', 'Foto Voluntario', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for foto_carta field
            //
            $column = new ExternalImageViewColumn('foto_carta', 'foto_carta', 'Foto Carta', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for foto_nr35 field
            //
            $column = new ExternalImageViewColumn('foto_nr35', 'foto_nr35', 'Foto Nr35', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for foto_tst field
            //
            $column = new ExternalImageViewColumn('foto_tst', 'foto_tst', 'Foto Tst', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for foto_aso field
            //
            $column = new ExternalImageViewColumn('foto_aso', 'foto_aso', 'Foto Aso', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for thumb_voluntario field
            //
            $column = new ExternalImageViewColumn('thumb_voluntario', 'thumb_voluntario', 'Foto Voluntário', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for thumb_carta field
            //
            $column = new ExternalImageViewColumn('thumb_carta', 'thumb_carta', 'Foto Carta', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for thumb_nr35 field
            //
            $column = new ExternalImageViewColumn('thumb_nr35', 'thumb_nr35', 'Foto Certificado NR35', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for thumb_tst field
            //
            $column = new ExternalImageViewColumn('thumb_tst', 'thumb_tst', 'Foto Certificado TST', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for thumb_aso field
            //
            $column = new ExternalImageViewColumn('thumb_aso', 'thumb_aso', 'Foto Certificado ASO', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for CPF_VOLUNTARIO field
            //
            $column = new TextViewColumn('CPF_VOLUNTARIO', 'CPF_VOLUNTARIO', 'CPF VOLUNTARIO', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for DT_ALTERACAO field
            //
            $column = new DateTimeViewColumn('DT_ALTERACAO', 'DT_ALTERACAO', 'DT ALTERACAO', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $grid->AddCompareColumn($column);
        }
    
        private function AddCompareHeaderColumns(Grid $grid)
        {
    
        }
    
        public function GetPageDirection()
        {
            return null;
        }
    
        public function isFilterConditionRequired()
        {
            return false;
        }
    
        protected function ApplyCommonColumnEditProperties(CustomEditColumn $column)
        {
            $column->SetDisplaySetToNullCheckBox(false);
            $column->SetDisplaySetToDefaultCheckBox(false);
    		$column->SetVariableContainer($this->GetColumnVariableContainer());
        }
    
        public function foto_voluntario_Thumbnail_GenerateFileName_insert(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), 'fotovoluntario/');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = FileUtils::AppendFileExtension(rand(), $original_file_extension);
        $filepath = Path::Combine($targetFolder, $filename);
        
        while (file_exists($filepath))
        {
            $filename = FileUtils::AppendFileExtension(rand(), $original_file_extension);
            $filepath = Path::Combine($targetFolder, $filename);
        }
        
        $handled = true;
        }
        public function foto_carta_Thumbnail_GenerateFileName_insert(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), 'fotocarta/');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = FileUtils::AppendFileExtension(rand(), $original_file_extension);
        $filepath = Path::Combine($targetFolder, $filename);
        
        while (file_exists($filepath))
        {
            $filename = FileUtils::AppendFileExtension(rand(), $original_file_extension);
            $filepath = Path::Combine($targetFolder, $filename);
        }
        
        $handled = true;
        }
        public function foto_nr35_Thumbnail_GenerateFileName_insert(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), 'fotonr35/');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = FileUtils::AppendFileExtension(rand(), $original_file_extension);
        $filepath = Path::Combine($targetFolder, $filename);
        
        while (file_exists($filepath))
        {
            $filename = FileUtils::AppendFileExtension(rand(), $original_file_extension);
            $filepath = Path::Combine($targetFolder, $filename);
        }
        
        $handled = true;
        }
        public function foto_tst_Thumbnail_GenerateFileName_insert(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), 'fototst/');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = FileUtils::AppendFileExtension(rand(), $original_file_extension);
        $filepath = Path::Combine($targetFolder, $filename);
        
        while (file_exists($filepath))
        {
            $filename = FileUtils::AppendFileExtension(rand(), $original_file_extension);
            $filepath = Path::Combine($targetFolder, $filename);
        }
        
        $handled = true;
        }
        public function foto_aso_Thumbnail_GenerateFileName_insert(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), 'fotoaso/');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = FileUtils::AppendFileExtension(rand(), $original_file_extension);
        $filepath = Path::Combine($targetFolder, $filename);
        
        while (file_exists($filepath))
        {
            $filename = FileUtils::AppendFileExtension(rand(), $original_file_extension);
            $filepath = Path::Combine($targetFolder, $filename);
        }
        
        $handled = true;
        }
        
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
        public function foto_voluntario_Thumbnail_GenerateFileName_(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), 'fotovoluntario/');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = FileUtils::AppendFileExtension(rand(), $original_file_extension);
        $filepath = Path::Combine($targetFolder, $filename);
        
        while (file_exists($filepath))
        {
            $filename = FileUtils::AppendFileExtension(rand(), $original_file_extension);
            $filepath = Path::Combine($targetFolder, $filename);
        }
        
        $handled = true;
        }
        public function foto_carta_Thumbnail_GenerateFileName_(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), 'fotocarta/');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = FileUtils::AppendFileExtension(rand(), $original_file_extension);
        $filepath = Path::Combine($targetFolder, $filename);
        
        while (file_exists($filepath))
        {
            $filename = FileUtils::AppendFileExtension(rand(), $original_file_extension);
            $filepath = Path::Combine($targetFolder, $filename);
        }
        
        $handled = true;
        }
        public function foto_nr35_Thumbnail_GenerateFileName_(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), 'fotonr35/');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = FileUtils::AppendFileExtension(rand(), $original_file_extension);
        $filepath = Path::Combine($targetFolder, $filename);
        
        while (file_exists($filepath))
        {
            $filename = FileUtils::AppendFileExtension(rand(), $original_file_extension);
            $filepath = Path::Combine($targetFolder, $filename);
        }
        
        $handled = true;
        }
        public function foto_tst_Thumbnail_GenerateFileName_(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), 'fototst/');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = FileUtils::AppendFileExtension(rand(), $original_file_extension);
        $filepath = Path::Combine($targetFolder, $filename);
        
        while (file_exists($filepath))
        {
            $filename = FileUtils::AppendFileExtension(rand(), $original_file_extension);
            $filepath = Path::Combine($targetFolder, $filename);
        }
        
        $handled = true;
        }
        public function foto_aso_Thumbnail_GenerateFileName_(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), 'fotoaso/');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = FileUtils::AppendFileExtension(rand(), $original_file_extension);
        $filepath = Path::Combine($targetFolder, $filename);
        
        while (file_exists($filepath))
        {
            $filename = FileUtils::AppendFileExtension(rand(), $original_file_extension);
            $filepath = Path::Combine($targetFolder, $filename);
        }
        
        $handled = true;
        }
        public function foto_voluntario_Thumbnail_GenerateFileName_multi_edit(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), 'fotovoluntario/');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = FileUtils::AppendFileExtension(rand(), $original_file_extension);
        $filepath = Path::Combine($targetFolder, $filename);
        
        while (file_exists($filepath))
        {
            $filename = FileUtils::AppendFileExtension(rand(), $original_file_extension);
            $filepath = Path::Combine($targetFolder, $filename);
        }
        
        $handled = true;
        }
        public function foto_carta_Thumbnail_GenerateFileName_multi_edit(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), 'fotocarta/');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = FileUtils::AppendFileExtension(rand(), $original_file_extension);
        $filepath = Path::Combine($targetFolder, $filename);
        
        while (file_exists($filepath))
        {
            $filename = FileUtils::AppendFileExtension(rand(), $original_file_extension);
            $filepath = Path::Combine($targetFolder, $filename);
        }
        
        $handled = true;
        }
        public function foto_nr35_Thumbnail_GenerateFileName_multi_edit(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), 'fotonr35/');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = FileUtils::AppendFileExtension(rand(), $original_file_extension);
        $filepath = Path::Combine($targetFolder, $filename);
        
        while (file_exists($filepath))
        {
            $filename = FileUtils::AppendFileExtension(rand(), $original_file_extension);
            $filepath = Path::Combine($targetFolder, $filename);
        }
        
        $handled = true;
        }
        public function foto_tst_Thumbnail_GenerateFileName_multi_edit(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), 'fototst/');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = FileUtils::AppendFileExtension(rand(), $original_file_extension);
        $filepath = Path::Combine($targetFolder, $filename);
        
        while (file_exists($filepath))
        {
            $filename = FileUtils::AppendFileExtension(rand(), $original_file_extension);
            $filepath = Path::Combine($targetFolder, $filename);
        }
        
        $handled = true;
        }
        public function foto_aso_Thumbnail_GenerateFileName_multi_edit(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), 'fotoaso/');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = FileUtils::AppendFileExtension(rand(), $original_file_extension);
        $filepath = Path::Combine($targetFolder, $filename);
        
        while (file_exists($filepath))
        {
            $filename = FileUtils::AppendFileExtension(rand(), $original_file_extension);
            $filepath = Path::Combine($targetFolder, $filename);
        }
        
        $handled = true;
        }
        
        protected function GetEnableModalGridDelete() { return true; }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset);
            if ($this->GetSecurityInfo()->HasDeleteGrant())
               $result->SetAllowDeleteSelected(true);
            else
               $result->SetAllowDeleteSelected(false);   
            
            ApplyCommonPageSettings($this, $result);
            
            $result->SetUseImagesForActions(true);
            $result->SetUseFixedHeader(false);
            $result->SetShowLineNumbers(false);
            $result->SetShowKeyColumnsImagesInHeader(false);
            $result->SetViewMode(ViewMode::TABLE);
            $result->setEnableRuntimeCustomization(true);
            $result->setAllowCompare(true);
            $this->AddCompareHeaderColumns($result);
            $this->AddCompareColumns($result);
            $result->setMultiEditAllowed($this->GetSecurityInfo()->HasEditGrant() && true);
            $result->setTableBordered(false);
            $result->setTableCondensed(false);
            
            $result->SetHighlightRowAtHover(false);
            $result->SetWidth('');
            $this->AddOperationsColumns($result);
            $this->AddFieldColumns($result);
            $this->AddSingleRecordViewColumns($result);
            $this->AddEditColumns($result);
            $this->AddMultiEditColumns($result);
            $this->AddInsertColumns($result);
            $this->AddPrintColumns($result);
            $this->AddExportColumns($result);
            $this->AddMultiUploadColumn($result);
    
    
            $this->SetShowPageList(true);
            $this->SetShowTopPageNavigator(true);
            $this->SetShowBottomPageNavigator(true);
            $this->setPrintListAvailable(true);
            $this->setPrintListRecordAvailable(false);
            $this->setPrintOneRecordAvailable(true);
            $this->setAllowPrintSelectedRecords(true);
            $this->setExportListAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
            $this->setExportSelectedRecordsAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
            $this->setExportListRecordAvailable(array());
            $this->setExportOneRecordAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
    
            return $result;
        }
     
        protected function setClientSideEvents(Grid $grid) {
    
        }
    
        protected function doRegisterHandlers() {
            //
            // View column for NM_VOLUNTARIO field
            //
            $column = new StringTransformViewColumn('NM_VOLUNTARIO', 'NM_VOLUNTARIO', 'Nome', $this->dataset);
            $column->SetOrderable(true);
            $column->setStringTransformFunction('');
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_NM_VOLUNTARIO_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Ds_SubSetor field
            //
            $column = new TextViewColumn('Ds_SubSetor', 'Ds_SubSetor_Ds_SubSetor', 'SubSetor', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_Ds_SubSetor_Ds_SubSetor_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for NM_PROFISSAO field
            //
            $column = new TextViewColumn('NM_PROFISSAO', 'NM_PROFISSAO', 'PROFISSAO', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_NM_PROFISSAO_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for CEP_VOLUNTARIO field
            //
            $column = new TextViewColumn('CEP_VOLUNTARIO', 'CEP_VOLUNTARIO', 'CEP', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_CEP_VOLUNTARIO_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for DS_ENDERECO_VOLUNTARIO field
            //
            $column = new TextViewColumn('DS_ENDERECO_VOLUNTARIO', 'DS_ENDERECO_VOLUNTARIO', 'Endereço', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_DS_ENDERECO_VOLUNTARIO_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for TEL1_VOLUNTARIO field
            //
            $column = new TextViewColumn('TEL1_VOLUNTARIO', 'TEL1_VOLUNTARIO', 'Telefone Fixo', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_TEL1_VOLUNTARIO_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for TEL2_VOLUNTARIO field
            //
            $column = new TextViewColumn('TEL2_VOLUNTARIO', 'TEL2_VOLUNTARIO', 'Telefone Móvel', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_TEL2_VOLUNTARIO_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for TEL3_VOLUNTARIO field
            //
            $column = new TextViewColumn('TEL3_VOLUNTARIO', 'TEL3_VOLUNTARIO', 'Telefone Adicional', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_TEL3_VOLUNTARIO_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for DS_EMAIL_VOLUNTARIO field
            //
            $column = new TextViewColumn('DS_EMAIL_VOLUNTARIO', 'DS_EMAIL_VOLUNTARIO', 'E-mail', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_DS_EMAIL_VOLUNTARIO_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for DT_NASC_VOLUNTARIO field
            //
            $column = new TextViewColumn('DT_NASC_VOLUNTARIO', 'DT_NASC_VOLUNTARIO', 'Data Nascimento', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_DT_NASC_VOLUNTARIO_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for CD_SEXO field
            //
            $column = new TextViewColumn('CD_SEXO', 'CD_SEXO', 'Sexo', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_CD_SEXO_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for DS_TAMANHO_LUVA field
            //
            $column = new TextViewColumn('DS_TAMANHO_LUVA', 'DS_TAMANHO_LUVA', 'Luva', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_DS_TAMANHO_LUVA_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for NR_BOTA_UTILIZAR field
            //
            $column = new TextViewColumn('NR_BOTA_UTILIZAR', 'NR_BOTA_UTILIZAR', 'Nr Bota', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_NR_BOTA_UTILIZAR_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for ST_JA_REALIZOU_ASO field
            //
            $column = new TextViewColumn('ST_JA_REALIZOU_ASO', 'ST_JA_REALIZOU_ASO', 'ASO', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_ST_JA_REALIZOU_ASO_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for ST_PARTICIPOU_NR35 field
            //
            $column = new TextViewColumn('ST_PARTICIPOU_NR35', 'ST_PARTICIPOU_NR35', 'NR35', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_ST_PARTICIPOU_NR35_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for ST_PARTICIPOU_SEG_TRABALHO field
            //
            $column = new TextViewColumn('ST_PARTICIPOU_SEG_TRABALHO', 'ST_PARTICIPOU_SEG_TRABALHO', 'TST', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_ST_PARTICIPOU_SEG_TRABALHO_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for NM_VOLUNTARIO field
            //
            $column = new StringTransformViewColumn('NM_VOLUNTARIO', 'NM_VOLUNTARIO', 'Nome', $this->dataset);
            $column->SetOrderable(true);
            $column->setStringTransformFunction('');
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_NM_VOLUNTARIO_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Ds_SubSetor field
            //
            $column = new TextViewColumn('Ds_SubSetor', 'Ds_SubSetor_Ds_SubSetor', 'SubSetor', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_Ds_SubSetor_Ds_SubSetor_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for NM_PROFISSAO field
            //
            $column = new TextViewColumn('NM_PROFISSAO', 'NM_PROFISSAO', 'PROFISSAO', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_NM_PROFISSAO_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for CEP_VOLUNTARIO field
            //
            $column = new TextViewColumn('CEP_VOLUNTARIO', 'CEP_VOLUNTARIO', 'CEP', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_CEP_VOLUNTARIO_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for DS_ENDERECO_VOLUNTARIO field
            //
            $column = new TextViewColumn('DS_ENDERECO_VOLUNTARIO', 'DS_ENDERECO_VOLUNTARIO', 'Endereço', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_DS_ENDERECO_VOLUNTARIO_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for TEL1_VOLUNTARIO field
            //
            $column = new TextViewColumn('TEL1_VOLUNTARIO', 'TEL1_VOLUNTARIO', 'Telefone Fixo', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_TEL1_VOLUNTARIO_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for TEL2_VOLUNTARIO field
            //
            $column = new TextViewColumn('TEL2_VOLUNTARIO', 'TEL2_VOLUNTARIO', 'Telefone Móvel', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_TEL2_VOLUNTARIO_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for TEL3_VOLUNTARIO field
            //
            $column = new TextViewColumn('TEL3_VOLUNTARIO', 'TEL3_VOLUNTARIO', 'Telefone Adicional', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_TEL3_VOLUNTARIO_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for DS_EMAIL_VOLUNTARIO field
            //
            $column = new TextViewColumn('DS_EMAIL_VOLUNTARIO', 'DS_EMAIL_VOLUNTARIO', 'E-mail', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_DS_EMAIL_VOLUNTARIO_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for DT_NASC_VOLUNTARIO field
            //
            $column = new TextViewColumn('DT_NASC_VOLUNTARIO', 'DT_NASC_VOLUNTARIO', 'Data Nascimento', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_DT_NASC_VOLUNTARIO_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for CD_SEXO field
            //
            $column = new TextViewColumn('CD_SEXO', 'CD_SEXO', 'Sexo', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_CD_SEXO_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for DS_TAMANHO_LUVA field
            //
            $column = new TextViewColumn('DS_TAMANHO_LUVA', 'DS_TAMANHO_LUVA', 'Luva', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_DS_TAMANHO_LUVA_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for NR_BOTA_UTILIZAR field
            //
            $column = new TextViewColumn('NR_BOTA_UTILIZAR', 'NR_BOTA_UTILIZAR', 'Nr Bota', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_NR_BOTA_UTILIZAR_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for ST_JA_REALIZOU_ASO field
            //
            $column = new TextViewColumn('ST_JA_REALIZOU_ASO', 'ST_JA_REALIZOU_ASO', 'ASO', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_ST_JA_REALIZOU_ASO_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for ST_PARTICIPOU_NR35 field
            //
            $column = new TextViewColumn('ST_PARTICIPOU_NR35', 'ST_PARTICIPOU_NR35', 'NR35', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_ST_PARTICIPOU_NR35_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for ST_PARTICIPOU_SEG_TRABALHO field
            //
            $column = new TextViewColumn('ST_PARTICIPOU_SEG_TRABALHO', 'ST_PARTICIPOU_SEG_TRABALHO', 'TST', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_ST_PARTICIPOU_SEG_TRABALHO_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for NM_VOLUNTARIO field
            //
            $column = new StringTransformViewColumn('NM_VOLUNTARIO', 'NM_VOLUNTARIO', 'Nome', $this->dataset);
            $column->SetOrderable(true);
            $column->setStringTransformFunction('');
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_NM_VOLUNTARIO_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Ds_SubSetor field
            //
            $column = new TextViewColumn('Ds_SubSetor', 'Ds_SubSetor_Ds_SubSetor', 'SubSetor', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_Ds_SubSetor_Ds_SubSetor_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for NM_PROFISSAO field
            //
            $column = new TextViewColumn('NM_PROFISSAO', 'NM_PROFISSAO', 'PROFISSAO', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_NM_PROFISSAO_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for CEP_VOLUNTARIO field
            //
            $column = new TextViewColumn('CEP_VOLUNTARIO', 'CEP_VOLUNTARIO', 'CEP', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_CEP_VOLUNTARIO_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for DS_ENDERECO_VOLUNTARIO field
            //
            $column = new TextViewColumn('DS_ENDERECO_VOLUNTARIO', 'DS_ENDERECO_VOLUNTARIO', 'Endereço', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_DS_ENDERECO_VOLUNTARIO_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for TEL1_VOLUNTARIO field
            //
            $column = new TextViewColumn('TEL1_VOLUNTARIO', 'TEL1_VOLUNTARIO', 'Telefone Fixo', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_TEL1_VOLUNTARIO_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for TEL2_VOLUNTARIO field
            //
            $column = new TextViewColumn('TEL2_VOLUNTARIO', 'TEL2_VOLUNTARIO', 'Telefone Móvel', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_TEL2_VOLUNTARIO_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for TEL3_VOLUNTARIO field
            //
            $column = new TextViewColumn('TEL3_VOLUNTARIO', 'TEL3_VOLUNTARIO', 'Telefone Adicional', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_TEL3_VOLUNTARIO_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for DS_EMAIL_VOLUNTARIO field
            //
            $column = new TextViewColumn('DS_EMAIL_VOLUNTARIO', 'DS_EMAIL_VOLUNTARIO', 'E-mail', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_DS_EMAIL_VOLUNTARIO_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for DT_NASC_VOLUNTARIO field
            //
            $column = new TextViewColumn('DT_NASC_VOLUNTARIO', 'DT_NASC_VOLUNTARIO', 'Data Nascimento', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_DT_NASC_VOLUNTARIO_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for CD_SEXO field
            //
            $column = new TextViewColumn('CD_SEXO', 'CD_SEXO', 'Sexo', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_CD_SEXO_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for DS_TAMANHO_LUVA field
            //
            $column = new TextViewColumn('DS_TAMANHO_LUVA', 'DS_TAMANHO_LUVA', 'Luva', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_DS_TAMANHO_LUVA_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for NR_BOTA_UTILIZAR field
            //
            $column = new TextViewColumn('NR_BOTA_UTILIZAR', 'NR_BOTA_UTILIZAR', 'Nr Bota', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_NR_BOTA_UTILIZAR_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for ST_JA_REALIZOU_ASO field
            //
            $column = new TextViewColumn('ST_JA_REALIZOU_ASO', 'ST_JA_REALIZOU_ASO', 'ASO', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_ST_JA_REALIZOU_ASO_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for ST_PARTICIPOU_NR35 field
            //
            $column = new TextViewColumn('ST_PARTICIPOU_NR35', 'ST_PARTICIPOU_NR35', 'NR35', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_ST_PARTICIPOU_NR35_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for ST_PARTICIPOU_SEG_TRABALHO field
            //
            $column = new TextViewColumn('ST_PARTICIPOU_SEG_TRABALHO', 'ST_PARTICIPOU_SEG_TRABALHO', 'TST', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_ST_PARTICIPOU_SEG_TRABALHO_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`cadcongregacoes`');
            $lookupDataset->addFields(
                array(
                    new StringField('Id_CCB', true, true),
                    new StringField('Ds_CCB'),
                    new StringField('Ds_SubSetor'),
                    new StringField('Ds_Endereco_CCB'),
                    new StringField('Cep_CCB'),
                    new StringField('tel_CCB'),
                    new StringField('Dia_Culto_1'),
                    new StringField('Hora_Culto_1'),
                    new StringField('Dia_Culto_2'),
                    new StringField('Hora_Culto_2'),
                    new StringField('Dia_Culto_3'),
                    new StringField('Hora_Culto_3'),
                    new StringField('Dia_Culto_4'),
                    new StringField('Hora_Culto_4'),
                    new StringField('Dia_RJM'),
                    new StringField('Hora_RJM'),
                    new StringField('Dia_Ensaio'),
                    new StringField('Hora_Ensaio'),
                    new StringField('Semana_ensaio')
                )
            );
            $lookupDataset->setOrderByField('Ds_CCB', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_cadvoluntarios_Id_CCB_search', 'Id_CCB', 'Ds_CCB', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`funcoes`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id_Funcao', true, true, true),
                    new StringField('Ds_Funcao'),
                    new IntegerField('id_tipofuncao')
                )
            );
            $lookupDataset->setOrderByField('Ds_Funcao', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_cadvoluntarios_ID_FUNCAO1_search', 'Id_Funcao', 'Ds_Funcao', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`funcoes`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id_Funcao', true, true, true),
                    new StringField('Ds_Funcao'),
                    new IntegerField('id_tipofuncao')
                )
            );
            $lookupDataset->setOrderByField('Ds_Funcao', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_cadvoluntarios_ID_FUNCAO2_search', 'Id_Funcao', 'Ds_Funcao', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`funcoes`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id_Funcao', true, true, true),
                    new StringField('Ds_Funcao'),
                    new IntegerField('id_tipofuncao')
                )
            );
            $lookupDataset->setOrderByField('Ds_Funcao', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_cadvoluntarios_ID_FUNCAO3_search', 'Id_Funcao', 'Ds_Funcao', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`cadcongregacoes`');
            $lookupDataset->addFields(
                array(
                    new StringField('Id_CCB', true, true),
                    new StringField('Ds_CCB'),
                    new StringField('Ds_SubSetor'),
                    new StringField('Ds_Endereco_CCB'),
                    new StringField('Cep_CCB'),
                    new StringField('tel_CCB'),
                    new StringField('Dia_Culto_1'),
                    new StringField('Hora_Culto_1'),
                    new StringField('Dia_Culto_2'),
                    new StringField('Hora_Culto_2'),
                    new StringField('Dia_Culto_3'),
                    new StringField('Hora_Culto_3'),
                    new StringField('Dia_Culto_4'),
                    new StringField('Hora_Culto_4'),
                    new StringField('Dia_RJM'),
                    new StringField('Hora_RJM'),
                    new StringField('Dia_Ensaio'),
                    new StringField('Hora_Ensaio'),
                    new StringField('Semana_ensaio')
                )
            );
            $lookupDataset->setOrderByField('Ds_SubSetor', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_cadvoluntarios_Ds_SubSetor_search', 'Id_CCB', 'Ds_SubSetor', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`cadcongregacoes`');
            $lookupDataset->addFields(
                array(
                    new StringField('Id_CCB', true, true),
                    new StringField('Ds_CCB'),
                    new StringField('Ds_SubSetor'),
                    new StringField('Ds_Endereco_CCB'),
                    new StringField('Cep_CCB'),
                    new StringField('tel_CCB'),
                    new StringField('Dia_Culto_1'),
                    new StringField('Hora_Culto_1'),
                    new StringField('Dia_Culto_2'),
                    new StringField('Hora_Culto_2'),
                    new StringField('Dia_Culto_3'),
                    new StringField('Hora_Culto_3'),
                    new StringField('Dia_Culto_4'),
                    new StringField('Hora_Culto_4'),
                    new StringField('Dia_RJM'),
                    new StringField('Hora_RJM'),
                    new StringField('Dia_Ensaio'),
                    new StringField('Hora_Ensaio'),
                    new StringField('Semana_ensaio')
                )
            );
            $lookupDataset->setOrderByField('Ds_CCB', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_cadvoluntarios_Id_CCB_search', 'Id_CCB', 'Ds_CCB', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`funcoes`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id_Funcao', true, true, true),
                    new StringField('Ds_Funcao'),
                    new IntegerField('id_tipofuncao')
                )
            );
            $lookupDataset->setOrderByField('Ds_Funcao', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_cadvoluntarios_ID_FUNCAO1_search', 'Id_Funcao', 'Ds_Funcao', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`funcoes`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id_Funcao', true, true, true),
                    new StringField('Ds_Funcao'),
                    new IntegerField('id_tipofuncao')
                )
            );
            $lookupDataset->setOrderByField('Ds_Funcao', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_cadvoluntarios_ID_FUNCAO2_search', 'Id_Funcao', 'Ds_Funcao', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`funcoes`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id_Funcao', true, true, true),
                    new StringField('Ds_Funcao'),
                    new IntegerField('id_tipofuncao')
                )
            );
            $lookupDataset->setOrderByField('Ds_Funcao', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_cadvoluntarios_ID_FUNCAO3_search', 'Id_Funcao', 'Ds_Funcao', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for NM_VOLUNTARIO field
            //
            $column = new StringTransformViewColumn('NM_VOLUNTARIO', 'NM_VOLUNTARIO', 'Nome', $this->dataset);
            $column->SetOrderable(true);
            $column->setStringTransformFunction('');
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_NM_VOLUNTARIO_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Ds_SubSetor field
            //
            $column = new TextViewColumn('Ds_SubSetor', 'Ds_SubSetor_Ds_SubSetor', 'SubSetor', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_Ds_SubSetor_Ds_SubSetor_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for NM_PROFISSAO field
            //
            $column = new TextViewColumn('NM_PROFISSAO', 'NM_PROFISSAO', 'PROFISSAO', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_NM_PROFISSAO_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for CEP_VOLUNTARIO field
            //
            $column = new TextViewColumn('CEP_VOLUNTARIO', 'CEP_VOLUNTARIO', 'CEP', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_CEP_VOLUNTARIO_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for DS_ENDERECO_VOLUNTARIO field
            //
            $column = new TextViewColumn('DS_ENDERECO_VOLUNTARIO', 'DS_ENDERECO_VOLUNTARIO', 'Endereço', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_DS_ENDERECO_VOLUNTARIO_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for TEL1_VOLUNTARIO field
            //
            $column = new TextViewColumn('TEL1_VOLUNTARIO', 'TEL1_VOLUNTARIO', 'Telefone Fixo', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_TEL1_VOLUNTARIO_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for TEL2_VOLUNTARIO field
            //
            $column = new TextViewColumn('TEL2_VOLUNTARIO', 'TEL2_VOLUNTARIO', 'Telefone Móvel', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_TEL2_VOLUNTARIO_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for TEL3_VOLUNTARIO field
            //
            $column = new TextViewColumn('TEL3_VOLUNTARIO', 'TEL3_VOLUNTARIO', 'Telefone Adicional', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_TEL3_VOLUNTARIO_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for DS_EMAIL_VOLUNTARIO field
            //
            $column = new TextViewColumn('DS_EMAIL_VOLUNTARIO', 'DS_EMAIL_VOLUNTARIO', 'E-mail', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_DS_EMAIL_VOLUNTARIO_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for DT_NASC_VOLUNTARIO field
            //
            $column = new TextViewColumn('DT_NASC_VOLUNTARIO', 'DT_NASC_VOLUNTARIO', 'Data Nascimento', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_DT_NASC_VOLUNTARIO_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for CD_SEXO field
            //
            $column = new TextViewColumn('CD_SEXO', 'CD_SEXO', 'Sexo', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_CD_SEXO_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for DS_TAMANHO_LUVA field
            //
            $column = new TextViewColumn('DS_TAMANHO_LUVA', 'DS_TAMANHO_LUVA', 'Luva', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_DS_TAMANHO_LUVA_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for NR_BOTA_UTILIZAR field
            //
            $column = new TextViewColumn('NR_BOTA_UTILIZAR', 'NR_BOTA_UTILIZAR', 'Nr Bota', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_NR_BOTA_UTILIZAR_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for ST_JA_REALIZOU_ASO field
            //
            $column = new TextViewColumn('ST_JA_REALIZOU_ASO', 'ST_JA_REALIZOU_ASO', 'ASO', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_ST_JA_REALIZOU_ASO_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for ST_PARTICIPOU_NR35 field
            //
            $column = new TextViewColumn('ST_PARTICIPOU_NR35', 'ST_PARTICIPOU_NR35', 'NR35', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_ST_PARTICIPOU_NR35_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for ST_PARTICIPOU_SEG_TRABALHO field
            //
            $column = new TextViewColumn('ST_PARTICIPOU_SEG_TRABALHO', 'ST_PARTICIPOU_SEG_TRABALHO', 'TST', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_ST_PARTICIPOU_SEG_TRABALHO_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`cadcongregacoes`');
            $lookupDataset->addFields(
                array(
                    new StringField('Id_CCB', true, true),
                    new StringField('Ds_CCB'),
                    new StringField('Ds_SubSetor'),
                    new StringField('Ds_Endereco_CCB'),
                    new StringField('Cep_CCB'),
                    new StringField('tel_CCB'),
                    new StringField('Dia_Culto_1'),
                    new StringField('Hora_Culto_1'),
                    new StringField('Dia_Culto_2'),
                    new StringField('Hora_Culto_2'),
                    new StringField('Dia_Culto_3'),
                    new StringField('Hora_Culto_3'),
                    new StringField('Dia_Culto_4'),
                    new StringField('Hora_Culto_4'),
                    new StringField('Dia_RJM'),
                    new StringField('Hora_RJM'),
                    new StringField('Dia_Ensaio'),
                    new StringField('Hora_Ensaio'),
                    new StringField('Semana_ensaio')
                )
            );
            $lookupDataset->setOrderByField('Ds_CCB', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_cadvoluntarios_Id_CCB_search', 'Id_CCB', 'Ds_CCB', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`funcoes`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id_Funcao', true, true, true),
                    new StringField('Ds_Funcao'),
                    new IntegerField('id_tipofuncao')
                )
            );
            $lookupDataset->setOrderByField('Ds_Funcao', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, '_cadvoluntarios_ID_FUNCAO1_search', 'Id_Funcao', 'Ds_Funcao', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`funcoes`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id_Funcao', true, true, true),
                    new StringField('Ds_Funcao'),
                    new IntegerField('id_tipofuncao')
                )
            );
            $lookupDataset->setOrderByField('Ds_Funcao', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, '_cadvoluntarios_ID_FUNCAO2_search', 'Id_Funcao', 'Ds_Funcao', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`funcoes`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id_Funcao', true, true, true),
                    new StringField('Ds_Funcao'),
                    new IntegerField('id_tipofuncao')
                )
            );
            $lookupDataset->setOrderByField('Ds_Funcao', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, '_cadvoluntarios_ID_FUNCAO3_search', 'Id_Funcao', 'Ds_Funcao', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`cadcongregacoes`');
            $lookupDataset->addFields(
                array(
                    new StringField('Id_CCB', true, true),
                    new StringField('Ds_CCB'),
                    new StringField('Ds_SubSetor'),
                    new StringField('Ds_Endereco_CCB'),
                    new StringField('Cep_CCB'),
                    new StringField('tel_CCB'),
                    new StringField('Dia_Culto_1'),
                    new StringField('Hora_Culto_1'),
                    new StringField('Dia_Culto_2'),
                    new StringField('Hora_Culto_2'),
                    new StringField('Dia_Culto_3'),
                    new StringField('Hora_Culto_3'),
                    new StringField('Dia_Culto_4'),
                    new StringField('Hora_Culto_4'),
                    new StringField('Dia_RJM'),
                    new StringField('Hora_RJM'),
                    new StringField('Dia_Ensaio'),
                    new StringField('Hora_Ensaio'),
                    new StringField('Semana_ensaio')
                )
            );
            $lookupDataset->setOrderByField('Ds_CCB', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_cadvoluntarios_Id_CCB_search', 'Id_CCB', 'Ds_CCB', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`funcoes`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id_Funcao', true, true, true),
                    new StringField('Ds_Funcao'),
                    new IntegerField('id_tipofuncao')
                )
            );
            $lookupDataset->setOrderByField('Ds_Funcao', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_cadvoluntarios_ID_FUNCAO1_search', 'Id_Funcao', 'Ds_Funcao', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`funcoes`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id_Funcao', true, true, true),
                    new StringField('Ds_Funcao'),
                    new IntegerField('id_tipofuncao')
                )
            );
            $lookupDataset->setOrderByField('Ds_Funcao', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_cadvoluntarios_ID_FUNCAO2_search', 'Id_Funcao', 'Ds_Funcao', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`funcoes`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id_Funcao', true, true, true),
                    new StringField('Ds_Funcao'),
                    new IntegerField('id_tipofuncao')
                )
            );
            $lookupDataset->setOrderByField('Ds_Funcao', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_cadvoluntarios_ID_FUNCAO3_search', 'Id_Funcao', 'Ds_Funcao', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            
            
            new cadvoluntarios_Id_CCBNestedPage($this, GetCurrentUserPermissionSetForDataSource('cadvoluntarios.Id_CCB'));
        }
       
        protected function doCustomRenderColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomRenderPrintColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomRenderExportColumn($exportType, $fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomDrawRow($rowData, &$cellFontColor, &$cellFontSize, &$cellBgColor, &$cellItalicAttr, &$cellBoldAttr)
        {
    
        }
    
        protected function doExtendedCustomDrawRow($rowData, &$rowCellStyles, &$rowStyles, &$rowClasses, &$cellClasses)
        {
    
        }
    
        protected function doCustomRenderTotal($totalValue, $aggregate, $columnName, &$customText, &$handled)
        {
    
        }
    
        protected function doCustomDefaultValues(&$values, &$handled) 
        {
    
        }
    
        protected function doCustomCompareColumn($columnName, $valueA, $valueB, &$result)
        {
    
        }
    
        protected function doBeforeInsertRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doBeforeUpdateRecord($page, $oldRowData, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doBeforeDeleteRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterInsertRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterUpdateRecord($page, $oldRowData, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterDeleteRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doCustomHTMLHeader($page, &$customHtmlHeaderText)
        { 
    
        }
    
        protected function doGetCustomTemplate($type, $part, $mode, &$result, &$params)
        {
    
        }
    
        protected function doGetCustomExportOptions(Page $page, $exportType, $rowData, &$options)
        {
    
        }
    
        protected function doFileUpload($fieldName, $rowData, &$result, &$accept, $originalFileName, $originalFileExtension, $fileSize, $tempFileName)
        {
    
        }
    
        protected function doPrepareChart(Chart $chart)
        {
    
        }
    
        protected function doPrepareColumnFilter(ColumnFilter $columnFilter)
        {
    
        }
    
        protected function doPrepareFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
    
        }
    
        protected function doGetSelectionFilters(FixedKeysArray $columns, &$result)
        {
    
        }
    
        protected function doGetCustomFormLayout($mode, FixedKeysArray $columns, FormLayout $layout)
        {
    
        }
    
        protected function doGetCustomColumnGroup(FixedKeysArray $columns, ViewColumnGroup $columnGroup)
        {
    
        }
    
        protected function doPageLoaded()
        {
    
        }
    
        protected function doCalculateFields($rowData, $fieldName, &$value)
        {
    
        }
    
        protected function doGetCustomPagePermissions(Page $page, PermissionSet &$permissions, &$handled)
        {
    
        }
    
        protected function doGetCustomRecordPermissions(Page $page, &$usingCondition, $rowData, &$allowEdit, &$allowDelete, &$mergeWithDefault, &$handled)
        {
            // não aplique essas regras para administradores de sites
            
            if (GetApplication()->IsLoggedInAsAdmin()) {
            
                return;
            
            } 
            
             
            
            // recuperando o ID do usuário atual
            
            $userId = $page->GetCurrentUserId();
            
                
            
            // recuperando o ID do departamento de vendas e o status do usuário atual
            
            $sql = "SELECT ID_CCB sales_department_id, Id_User is_head_manager " . 
            
                   "FROM sl3.permissao_ccb WHERE Id_User = $userId";
            
            $result = $page->GetConnection()->fetchAll($sql);
            
             
            
            if (empty($result))
            
                return;
            
              
            
            $salesDepartmentId = $result[0]['sales_department_id']; 
            
            $isHeadManager = (boolean) $result[0]['is_head_manager'];
            
             
            
            // Concedendo permissões de acordo com o cenário
            
            $allowEdit = $isHeadManager || !$rowData['completed'];
            
            $allowDelete = $isHeadManager || !$rowData['completed'];
            
             
            
            // Especificando a condição para mostrar apenas os registros necessários 
            
            if ($isHeadManager) {
            
                $sql = 'Id_CCB IN '.
            
                       '(SELECT Id_User FROM sl3.permissao_ccb WHERE ID_CCB = %d)';
            
                $usingCondition = sprintf($sql, $salesDepartmentId);
            
            } else {
            
                $usingCondition = sprintf('Id_CCB = %d', $userId);
            
            }
            
             
            
            // aplica permissões concedidas
            
            $handled = true;
            
              
            
            // Não mescle as novas permissões de registro com as padrão (true por padrão).
            
            // Temos que adicionar esta linha, caso contrário, os gerentes principais não poderão ver
            
            // vendas realizadas por outros gerentes do departamento. 
            
            $mergeWithDefault = false;
        }
    
    }

    SetUpUserAuthorization();

    try
    {
        $Page = new cadvoluntariosPage("cadvoluntarios", "cadvoluntarios.php", GetCurrentUserPermissionSetForDataSource("cadvoluntarios"), 'UTF-8');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("cadvoluntarios"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
