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
    
    
    
    class grupovoluntariosPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Grupo Voluntários CCB');
            $this->SetMenuLabel('Grupo Voluntários CCB');
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
            $this->dataset->AddLookupField('Id_grupo', 'grupoccb', new IntegerField('Id_grupo'), new StringField('Ds_grupo', false, false, false, false, 'Id_grupo_Ds_grupo', 'Id_grupo_Ds_grupo_grupoccb'), 'Id_grupo_Ds_grupo_grupoccb');
            $this->dataset->AddLookupField('Id_Voluntario', 'cadvoluntarios', new IntegerField('ID_AUX'), new StringField('NM_VOLUNTARIO', false, false, false, false, 'Id_Voluntario_NM_VOLUNTARIO', 'Id_Voluntario_NM_VOLUNTARIO_cadvoluntarios'), 'Id_Voluntario_NM_VOLUNTARIO_cadvoluntarios');
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
                new FilterColumn($this->dataset, 'Id_grupo', 'Id_grupo_Ds_grupo', 'Id Grupo'),
                new FilterColumn($this->dataset, 'Id_Voluntario', 'Id_Voluntario_NM_VOLUNTARIO', 'Id Voluntario')
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
                ->setOptionsFor('Id_grupo')
                ->setOptionsFor('Id_Voluntario');
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new DynamicCombobox('id_grupo_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_grupovoluntarios_Id_grupo_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('Id_grupo', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_grupovoluntarios_Id_grupo_search');
            
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
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('id_voluntario_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_grupovoluntarios_Id_Voluntario_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('Id_Voluntario', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_grupovoluntarios_Id_Voluntario_search');
            
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
            // View column for Ds_grupo field
            //
            $column = new TextViewColumn('Id_grupo', 'Id_grupo_Ds_grupo', 'Id Grupo', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for NM_VOLUNTARIO field
            //
            $column = new TextViewColumn('Id_Voluntario', 'Id_Voluntario_NM_VOLUNTARIO', 'Id Voluntario', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for Ds_grupo field
            //
            $column = new TextViewColumn('Id_grupo', 'Id_grupo_Ds_grupo', 'Id Grupo', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for NM_VOLUNTARIO field
            //
            $column = new TextViewColumn('Id_Voluntario', 'Id_Voluntario_NM_VOLUNTARIO', 'Id Voluntario', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for Id_grupo field
            //
            $editor = new DynamicCombobox('id_grupo_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`grupoccb`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id_grupo', true, true, true),
                    new StringField('Ds_grupo'),
                    new StringField('Id_CCB'),
                    new StringField('Tipo'),
                    new StringField('Status'),
                    new DateField('Dt_Inicio'),
                    new DateField('Ft_Fim')
                )
            );
            $lookupDataset->setOrderByField('Ds_grupo', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id Grupo', 'Id_grupo', 'Id_grupo_Ds_grupo', 'edit_grupovoluntarios_Id_grupo_search', $editor, $this->dataset, $lookupDataset, 'Id_grupo', 'Ds_grupo', '');
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
            $lookupDataset->setOrderByField('NM_VOLUNTARIO', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id Voluntario', 'Id_Voluntario', 'Id_Voluntario_NM_VOLUNTARIO', 'edit_grupovoluntarios_Id_Voluntario_search', $editor, $this->dataset, $lookupDataset, 'ID_AUX', 'NM_VOLUNTARIO', '');
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
            $editor = new DynamicCombobox('id_grupo_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`grupoccb`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id_grupo', true, true, true),
                    new StringField('Ds_grupo'),
                    new StringField('Id_CCB'),
                    new StringField('Tipo'),
                    new StringField('Status'),
                    new DateField('Dt_Inicio'),
                    new DateField('Ft_Fim')
                )
            );
            $lookupDataset->setOrderByField('Ds_grupo', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id Grupo', 'Id_grupo', 'Id_grupo_Ds_grupo', 'insert_grupovoluntarios_Id_grupo_search', $editor, $this->dataset, $lookupDataset, 'Id_grupo', 'Ds_grupo', '');
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
            $lookupDataset->setOrderByField('NM_VOLUNTARIO', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Id Voluntario', 'Id_Voluntario', 'Id_Voluntario_NM_VOLUNTARIO', 'insert_grupovoluntarios_Id_Voluntario_search', $editor, $this->dataset, $lookupDataset, 'ID_AUX', 'NM_VOLUNTARIO', '');
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
            // View column for Ds_grupo field
            //
            $column = new TextViewColumn('Id_grupo', 'Id_grupo_Ds_grupo', 'Id Grupo', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for NM_VOLUNTARIO field
            //
            $column = new TextViewColumn('Id_Voluntario', 'Id_Voluntario_NM_VOLUNTARIO', 'Id Voluntario', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for Ds_grupo field
            //
            $column = new TextViewColumn('Id_grupo', 'Id_grupo_Ds_grupo', 'Id Grupo', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for NM_VOLUNTARIO field
            //
            $column = new TextViewColumn('Id_Voluntario', 'Id_Voluntario_NM_VOLUNTARIO', 'Id Voluntario', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for Ds_grupo field
            //
            $column = new TextViewColumn('Id_grupo', 'Id_grupo_Ds_grupo', 'Id Grupo', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for NM_VOLUNTARIO field
            //
            $column = new TextViewColumn('Id_Voluntario', 'Id_Voluntario_NM_VOLUNTARIO', 'Id Voluntario', $this->dataset);
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
                '`grupoccb`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id_grupo', true, true, true),
                    new StringField('Ds_grupo'),
                    new StringField('Id_CCB'),
                    new StringField('Tipo'),
                    new StringField('Status'),
                    new DateField('Dt_Inicio'),
                    new DateField('Ft_Fim')
                )
            );
            $lookupDataset->setOrderByField('Ds_grupo', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_grupovoluntarios_Id_grupo_search', 'Id_grupo', 'Ds_grupo', null, 20);
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
            $lookupDataset->setOrderByField('NM_VOLUNTARIO', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_grupovoluntarios_Id_Voluntario_search', 'ID_AUX', 'NM_VOLUNTARIO', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`grupoccb`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id_grupo', true, true, true),
                    new StringField('Ds_grupo'),
                    new StringField('Id_CCB'),
                    new StringField('Tipo'),
                    new StringField('Status'),
                    new DateField('Dt_Inicio'),
                    new DateField('Ft_Fim')
                )
            );
            $lookupDataset->setOrderByField('Ds_grupo', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_grupovoluntarios_Id_grupo_search', 'Id_grupo', 'Ds_grupo', null, 20);
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
            $lookupDataset->setOrderByField('NM_VOLUNTARIO', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_grupovoluntarios_Id_Voluntario_search', 'ID_AUX', 'NM_VOLUNTARIO', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`grupoccb`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id_grupo', true, true, true),
                    new StringField('Ds_grupo'),
                    new StringField('Id_CCB'),
                    new StringField('Tipo'),
                    new StringField('Status'),
                    new DateField('Dt_Inicio'),
                    new DateField('Ft_Fim')
                )
            );
            $lookupDataset->setOrderByField('Ds_grupo', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_grupovoluntarios_Id_grupo_search', 'Id_grupo', 'Ds_grupo', null, 20);
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
            $lookupDataset->setOrderByField('NM_VOLUNTARIO', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_grupovoluntarios_Id_Voluntario_search', 'ID_AUX', 'NM_VOLUNTARIO', null, 20);
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
        $Page = new grupovoluntariosPage("grupovoluntarios", "grupovoluntarios.php", GetCurrentUserPermissionSetForDataSource("grupovoluntarios"), 'UTF-8');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("grupovoluntarios"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
