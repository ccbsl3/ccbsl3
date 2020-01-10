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

    
    
    
    
    // OnBeforePageExecute event handler
    
    
    
    class grupoccb_grupovoluntariosPage extends DetailPage
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Grupo Volutários');
            $this->SetMenuLabel('Grupo Volutários');
            $this->SetHeader(GetPagesHeader());
            $this->SetFooter(GetPagesFooter());
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`grupovoluntarios`');
            $this->dataset->addFields(
                array(
                    new IntegerField('Id_grupo', true, true),
                    new StringField('Id_Voluntario', true, true)
                )
            );
            $this->dataset->AddLookupField('Id_Voluntario', 'cadvoluntarios', new StringField('Id_voluntario'), new StringField('NM_VOLUNTARIO', false, false, false, false, 'Id_Voluntario_NM_VOLUNTARIO', 'Id_Voluntario_NM_VOLUNTARIO_cadvoluntarios'), 'Id_Voluntario_NM_VOLUNTARIO_cadvoluntarios');
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
                new FilterColumn($this->dataset, 'Id_grupo', 'Id_grupo', 'Id Grupo'),
                new FilterColumn($this->dataset, 'Id_Voluntario', 'Id_Voluntario_NM_VOLUNTARIO', 'Voluntário')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['Id_grupo'])
                ->addColumn($columns['Id_Voluntario']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('Id_Voluntario');
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new TextEdit('id_grupo_edit');
            
            $filterBuilder->addColumn(
                $columns['Id_grupo'],
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
            
            $main_editor = new DynamicCombobox('id_voluntario_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_grupoccb_grupovoluntarios_Id_Voluntario_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('Id_Voluntario', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_grupoccb_grupovoluntarios_Id_Voluntario_search');
            
            $text_editor = new TextEdit('Id_Voluntario');
            
            $filterBuilder->addColumn(
                $columns['Id_Voluntario'],
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
            // View column for Id_grupo field
            //
            $column = new NumberViewColumn('Id_grupo', 'Id_grupo', 'Id Grupo', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for NM_VOLUNTARIO field
            //
            $column = new TextViewColumn('Id_Voluntario', 'Id_Voluntario_NM_VOLUNTARIO', 'Voluntário', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for Id_grupo field
            //
            $column = new NumberViewColumn('Id_grupo', 'Id_grupo', 'Id Grupo', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for NM_VOLUNTARIO field
            //
            $column = new TextViewColumn('Id_Voluntario', 'Id_Voluntario_NM_VOLUNTARIO', 'Voluntário', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for Id_grupo field
            //
            $editor = new TextEdit('id_grupo_edit');
            $editColumn = new CustomEditColumn('Id Grupo', 'Id_grupo', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Id_Voluntario field
            //
            $editor = new DynamicCombobox('id_voluntario_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`cadvoluntarios`');
            $lookupDataset->addFields(
                array(
                    new StringField('Id_voluntario'),
                    new StringField('NM_VOLUNTARIO'),
                    new StringField('CD_RG_VOLUNTARIO'),
                    new StringField('NM_PROFISSAO'),
                    new StringField('Id_CCB'),
                    new StringField('NM_COMUM_CCB'),
                    new StringField('DS_ENDERECO_VOLUNTARIO'),
                    new StringField('NM_BAIRRO_CEP_CIDADE_VOLUNTARIO'),
                    new StringField('CD_TEL_COM_VOLUNTARIO'),
                    new StringField('CD_TEL_RES_VOLUNTARIO'),
                    new StringField('CD_CELULAR'),
                    new StringField('CD_SEXO'),
                    new StringField('DS_DISPONIBILIDADE_VOLUNTARIO'),
                    new StringField('DS_EMAIL_VOLUNTARIO'),
                    new StringField('DS_FUNCAO_NA_COMUM'),
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
                    new StringField('thumb_aso')
                )
            );
            $lookupDataset->setOrderByField('NM_VOLUNTARIO', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Voluntário', 'Id_Voluntario', 'Id_Voluntario_NM_VOLUNTARIO', 'edit_grupoccb_grupovoluntarios_Id_Voluntario_search', $editor, $this->dataset, $lookupDataset, 'Id_voluntario', 'NM_VOLUNTARIO', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
    
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for Id_grupo field
            //
            $editor = new TextEdit('id_grupo_edit');
            $editColumn = new CustomEditColumn('Id Grupo', 'Id_grupo', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Id_Voluntario field
            //
            $editor = new DynamicCombobox('id_voluntario_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`cadvoluntarios`');
            $lookupDataset->addFields(
                array(
                    new StringField('Id_voluntario'),
                    new StringField('NM_VOLUNTARIO'),
                    new StringField('CD_RG_VOLUNTARIO'),
                    new StringField('NM_PROFISSAO'),
                    new StringField('Id_CCB'),
                    new StringField('NM_COMUM_CCB'),
                    new StringField('DS_ENDERECO_VOLUNTARIO'),
                    new StringField('NM_BAIRRO_CEP_CIDADE_VOLUNTARIO'),
                    new StringField('CD_TEL_COM_VOLUNTARIO'),
                    new StringField('CD_TEL_RES_VOLUNTARIO'),
                    new StringField('CD_CELULAR'),
                    new StringField('CD_SEXO'),
                    new StringField('DS_DISPONIBILIDADE_VOLUNTARIO'),
                    new StringField('DS_EMAIL_VOLUNTARIO'),
                    new StringField('DS_FUNCAO_NA_COMUM'),
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
                    new StringField('thumb_aso')
                )
            );
            $lookupDataset->setOrderByField('NM_VOLUNTARIO', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Voluntário', 'Id_Voluntario', 'Id_Voluntario_NM_VOLUNTARIO', 'insert_grupoccb_grupovoluntarios_Id_Voluntario_search', $editor, $this->dataset, $lookupDataset, 'Id_voluntario', 'NM_VOLUNTARIO', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
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
            // View column for Id_grupo field
            //
            $column = new NumberViewColumn('Id_grupo', 'Id_grupo', 'Id Grupo', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for NM_VOLUNTARIO field
            //
            $column = new TextViewColumn('Id_Voluntario', 'Id_Voluntario_NM_VOLUNTARIO', 'Voluntário', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for Id_grupo field
            //
            $column = new NumberViewColumn('Id_grupo', 'Id_grupo', 'Id Grupo', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for NM_VOLUNTARIO field
            //
            $column = new TextViewColumn('Id_Voluntario', 'Id_Voluntario_NM_VOLUNTARIO', 'Voluntário', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for Id_grupo field
            //
            $column = new NumberViewColumn('Id_grupo', 'Id_grupo', 'Id Grupo', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for NM_VOLUNTARIO field
            //
            $column = new TextViewColumn('Id_Voluntario', 'Id_Voluntario_NM_VOLUNTARIO', 'Voluntário', $this->dataset);
            $column->SetOrderable(true);
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
    
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
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
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`cadvoluntarios`');
            $lookupDataset->addFields(
                array(
                    new StringField('Id_voluntario'),
                    new StringField('NM_VOLUNTARIO'),
                    new StringField('CD_RG_VOLUNTARIO'),
                    new StringField('NM_PROFISSAO'),
                    new StringField('Id_CCB'),
                    new StringField('NM_COMUM_CCB'),
                    new StringField('DS_ENDERECO_VOLUNTARIO'),
                    new StringField('NM_BAIRRO_CEP_CIDADE_VOLUNTARIO'),
                    new StringField('CD_TEL_COM_VOLUNTARIO'),
                    new StringField('CD_TEL_RES_VOLUNTARIO'),
                    new StringField('CD_CELULAR'),
                    new StringField('CD_SEXO'),
                    new StringField('DS_DISPONIBILIDADE_VOLUNTARIO'),
                    new StringField('DS_EMAIL_VOLUNTARIO'),
                    new StringField('DS_FUNCAO_NA_COMUM'),
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
                    new StringField('thumb_aso')
                )
            );
            $lookupDataset->setOrderByField('NM_VOLUNTARIO', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_grupoccb_grupovoluntarios_Id_Voluntario_search', 'Id_voluntario', 'NM_VOLUNTARIO', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`cadvoluntarios`');
            $lookupDataset->addFields(
                array(
                    new StringField('Id_voluntario'),
                    new StringField('NM_VOLUNTARIO'),
                    new StringField('CD_RG_VOLUNTARIO'),
                    new StringField('NM_PROFISSAO'),
                    new StringField('Id_CCB'),
                    new StringField('NM_COMUM_CCB'),
                    new StringField('DS_ENDERECO_VOLUNTARIO'),
                    new StringField('NM_BAIRRO_CEP_CIDADE_VOLUNTARIO'),
                    new StringField('CD_TEL_COM_VOLUNTARIO'),
                    new StringField('CD_TEL_RES_VOLUNTARIO'),
                    new StringField('CD_CELULAR'),
                    new StringField('CD_SEXO'),
                    new StringField('DS_DISPONIBILIDADE_VOLUNTARIO'),
                    new StringField('DS_EMAIL_VOLUNTARIO'),
                    new StringField('DS_FUNCAO_NA_COMUM'),
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
                    new StringField('thumb_aso')
                )
            );
            $lookupDataset->setOrderByField('NM_VOLUNTARIO', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_grupoccb_grupovoluntarios_Id_Voluntario_search', 'Id_voluntario', 'NM_VOLUNTARIO', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`cadvoluntarios`');
            $lookupDataset->addFields(
                array(
                    new StringField('Id_voluntario'),
                    new StringField('NM_VOLUNTARIO'),
                    new StringField('CD_RG_VOLUNTARIO'),
                    new StringField('NM_PROFISSAO'),
                    new StringField('Id_CCB'),
                    new StringField('NM_COMUM_CCB'),
                    new StringField('DS_ENDERECO_VOLUNTARIO'),
                    new StringField('NM_BAIRRO_CEP_CIDADE_VOLUNTARIO'),
                    new StringField('CD_TEL_COM_VOLUNTARIO'),
                    new StringField('CD_TEL_RES_VOLUNTARIO'),
                    new StringField('CD_CELULAR'),
                    new StringField('CD_SEXO'),
                    new StringField('DS_DISPONIBILIDADE_VOLUNTARIO'),
                    new StringField('DS_EMAIL_VOLUNTARIO'),
                    new StringField('DS_FUNCAO_NA_COMUM'),
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
                    new StringField('thumb_aso')
                )
            );
            $lookupDataset->setOrderByField('NM_VOLUNTARIO', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_grupoccb_grupovoluntarios_Id_Voluntario_search', 'Id_voluntario', 'NM_VOLUNTARIO', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
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
    
        }
    
    }
    
    // OnBeforePageExecute event handler
    
    
    
    class grupoccbPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Grupo CCB');
            $this->SetMenuLabel('Grupo CCB');
            $this->SetHeader(GetPagesHeader());
            $this->SetFooter(GetPagesFooter());
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`grupoccb`');
            $this->dataset->addFields(
                array(
                    new IntegerField('Id_grupo', true, true, true),
                    new StringField('Ds_grupo'),
                    new StringField('Id_CCB')
                )
            );
            $this->dataset->AddLookupField('Id_CCB', 'cadcongregacoes', new StringField('Id_CCB'), new StringField('Ds_CCB', false, false, false, false, 'Id_CCB_Ds_CCB', 'Id_CCB_Ds_CCB_cadcongregacoes'), 'Id_CCB_Ds_CCB_cadcongregacoes');
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
                new FilterColumn($this->dataset, 'Id_grupo', 'Id_grupo', 'Id Grupo'),
                new FilterColumn($this->dataset, 'Ds_grupo', 'Ds_grupo', 'Ds Grupo'),
                new FilterColumn($this->dataset, 'Id_CCB', 'Id_CCB_Ds_CCB', 'Id CCB')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['Id_grupo'])
                ->addColumn($columns['Ds_grupo'])
                ->addColumn($columns['Id_CCB']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('Id_CCB');
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new TextEdit('id_grupo_edit');
            
            $filterBuilder->addColumn(
                $columns['Id_grupo'],
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
            
            $main_editor = new TextEdit('ds_grupo_edit');
            $main_editor->SetMaxLength(45);
            
            $filterBuilder->addColumn(
                $columns['Ds_grupo'],
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
            
            $main_editor = new DynamicCombobox('id_ccb_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_grupoccb_Id_CCB_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('Id_CCB', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_grupoccb_Id_CCB_search');
            
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
            if (GetCurrentUserPermissionSetForDataSource('grupoccb.grupovoluntarios')->HasViewGrant() && $withDetails)
            {
            //
            // View column for grupoccb_grupovoluntarios detail
            //
            $column = new DetailColumn(array('Id_grupo'), 'grupoccb.grupovoluntarios', 'grupoccb_grupovoluntarios_handler', $this->dataset, 'Grupo Volutários');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            }
            
            //
            // View column for Id_grupo field
            //
            $column = new NumberViewColumn('Id_grupo', 'Id_grupo', 'Id Grupo', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Ds_grupo field
            //
            $column = new TextViewColumn('Ds_grupo', 'Ds_grupo', 'Ds Grupo', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('Id_CCB', 'Id_CCB_Ds_CCB', 'Id CCB', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('grupoccb_Id_CCB_Ds_CCB_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for Id_grupo field
            //
            $column = new NumberViewColumn('Id_grupo', 'Id_grupo', 'Id Grupo', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Ds_grupo field
            //
            $column = new TextViewColumn('Ds_grupo', 'Ds_grupo', 'Ds Grupo', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('Id_CCB', 'Id_CCB_Ds_CCB', 'Id CCB', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('grupoccb_Id_CCB_Ds_CCB_handler_view');
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for Ds_grupo field
            //
            $editor = new TextEdit('ds_grupo_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Ds Grupo', 'Ds_grupo', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
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
                    new StringField('Ds_SubSetor')
                )
            );
            $lookupDataset->setOrderByField('Ds_CCB', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id CCB', 'Id_CCB', 'Id_CCB_Ds_CCB', 'edit_grupoccb_Id_CCB_search', $editor, $this->dataset, $lookupDataset, 'Id_CCB', 'Ds_CCB', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
            //
            // Edit column for Ds_grupo field
            //
            $editor = new TextEdit('ds_grupo_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Ds Grupo', 'Ds_grupo', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
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
                    new StringField('Ds_SubSetor')
                )
            );
            $lookupDataset->setOrderByField('Ds_CCB', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id CCB', 'Id_CCB', 'Id_CCB_Ds_CCB', 'multi_edit_grupoccb_Id_CCB_search', $editor, $this->dataset, $lookupDataset, 'Id_CCB', 'Ds_CCB', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for Ds_grupo field
            //
            $editor = new TextEdit('ds_grupo_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Ds Grupo', 'Ds_grupo', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
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
                    new StringField('Ds_SubSetor')
                )
            );
            $lookupDataset->setOrderByField('Ds_CCB', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id CCB', 'Id_CCB', 'Id_CCB_Ds_CCB', 'insert_grupoccb_Id_CCB_search', $editor, $this->dataset, $lookupDataset, 'Id_CCB', 'Ds_CCB', '');
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
            // View column for Id_grupo field
            //
            $column = new NumberViewColumn('Id_grupo', 'Id_grupo', 'Id Grupo', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Ds_grupo field
            //
            $column = new TextViewColumn('Ds_grupo', 'Ds_grupo', 'Ds Grupo', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('Id_CCB', 'Id_CCB_Ds_CCB', 'Id CCB', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('grupoccb_Id_CCB_Ds_CCB_handler_print');
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for Id_grupo field
            //
            $column = new NumberViewColumn('Id_grupo', 'Id_grupo', 'Id Grupo', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for Ds_grupo field
            //
            $column = new TextViewColumn('Ds_grupo', 'Ds_grupo', 'Ds Grupo', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('Id_CCB', 'Id_CCB_Ds_CCB', 'Id CCB', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('grupoccb_Id_CCB_Ds_CCB_handler_export');
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for Ds_grupo field
            //
            $column = new TextViewColumn('Ds_grupo', 'Ds_grupo', 'Ds Grupo', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('Id_CCB', 'Id_CCB_Ds_CCB', 'Id CCB', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('grupoccb_Id_CCB_Ds_CCB_handler_compare');
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
    
        function CreateMasterDetailRecordGrid()
        {
            $result = new Grid($this, $this->dataset);
            
            $this->AddFieldColumns($result, false);
            $this->AddPrintColumns($result);
            $this->AddExportColumns($result);
            
            $result->SetAllowDeleteSelected(false);
            $result->SetShowUpdateLink(false);
            $result->SetShowKeyColumnsImagesInHeader(false);
            $result->SetViewMode(ViewMode::TABLE);
            $result->setEnableRuntimeCustomization(false);
            $result->setTableBordered(false);
            $result->setTableCondensed(false);
            
            $this->setupGridColumnGroup($result);
            $this->attachGridEventHandlers($result);
            
            return $result;
        }
        
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
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
            $detailPage = new grupoccb_grupovoluntariosPage('grupoccb_grupovoluntarios', $this, array('Id_grupo'), array('Id_grupo'), $this->GetForeignKeyFields(), $this->CreateMasterDetailRecordGrid(), $this->dataset, GetCurrentUserPermissionSetForDataSource('grupoccb.grupovoluntarios'), 'UTF-8');
            $detailPage->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource('grupoccb.grupovoluntarios'));
            $detailPage->SetHttpHandlerName('grupoccb_grupovoluntarios_handler');
            $handler = new PageHTTPHandler('grupoccb_grupovoluntarios_handler', $detailPage);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('Id_CCB', 'Id_CCB_Ds_CCB', 'Id CCB', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'grupoccb_Id_CCB_Ds_CCB_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('Id_CCB', 'Id_CCB_Ds_CCB', 'Id CCB', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'grupoccb_Id_CCB_Ds_CCB_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('Id_CCB', 'Id_CCB_Ds_CCB', 'Id CCB', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'grupoccb_Id_CCB_Ds_CCB_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`cadcongregacoes`');
            $lookupDataset->addFields(
                array(
                    new StringField('Id_CCB', true, true),
                    new StringField('Ds_CCB'),
                    new StringField('Ds_SubSetor')
                )
            );
            $lookupDataset->setOrderByField('Ds_CCB', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_grupoccb_Id_CCB_search', 'Id_CCB', 'Ds_CCB', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`cadcongregacoes`');
            $lookupDataset->addFields(
                array(
                    new StringField('Id_CCB', true, true),
                    new StringField('Ds_CCB'),
                    new StringField('Ds_SubSetor')
                )
            );
            $lookupDataset->setOrderByField('Ds_CCB', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_grupoccb_Id_CCB_search', 'Id_CCB', 'Ds_CCB', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('Id_CCB', 'Id_CCB_Ds_CCB', 'Id CCB', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'grupoccb_Id_CCB_Ds_CCB_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`cadcongregacoes`');
            $lookupDataset->addFields(
                array(
                    new StringField('Id_CCB', true, true),
                    new StringField('Ds_CCB'),
                    new StringField('Ds_SubSetor')
                )
            );
            $lookupDataset->setOrderByField('Ds_CCB', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_grupoccb_Id_CCB_search', 'Id_CCB', 'Ds_CCB', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`cadcongregacoes`');
            $lookupDataset->addFields(
                array(
                    new StringField('Id_CCB', true, true),
                    new StringField('Ds_CCB'),
                    new StringField('Ds_SubSetor')
                )
            );
            $lookupDataset->setOrderByField('Ds_CCB', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_grupoccb_Id_CCB_search', 'Id_CCB', 'Ds_CCB', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
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
    
        }
    
    }

    SetUpUserAuthorization();

    try
    {
        $Page = new grupoccbPage("grupoccb", "grupoccb.php", GetCurrentUserPermissionSetForDataSource("grupoccb"), 'UTF-8');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("grupoccb"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
