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
    
    
    
    class assistenciaministerioPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Assistência Ministério');
            $this->SetMenuLabel('Assistência Ministério');
            $this->SetHeader(GetPagesHeader());
            $this->SetFooter(GetPagesFooter());
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`assistenciaministerio`');
            $this->dataset->addFields(
                array(
                    new IntegerField('Id_irmaoministerio', false, true),
                    new StringField('NomeIrmao'),
                    new StringField('Id_CCB'),
                    new StringField('CongracacaoAssistida')
                )
            );
            $this->dataset->AddLookupField('Id_irmaoministerio', 'cadministerio', new IntegerField('Id_irmaoministerio'), new StringField('NomeCompleto', false, false, false, false, 'Id_irmaoministerio_NomeCompleto', 'Id_irmaoministerio_NomeCompleto_cadministerio'), 'Id_irmaoministerio_NomeCompleto_cadministerio');
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
                new FilterColumn($this->dataset, 'Id_irmaoministerio', 'Id_irmaoministerio_NomeCompleto', 'Irmão Ministério'),
                new FilterColumn($this->dataset, 'NomeIrmao', 'NomeIrmao', 'Nome Irmao'),
                new FilterColumn($this->dataset, 'Id_CCB', 'Id_CCB_Ds_CCB', 'CCB Comum'),
                new FilterColumn($this->dataset, 'CongracacaoAssistida', 'CongracacaoAssistida', 'CCB Assistência')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['Id_irmaoministerio'])
                ->addColumn($columns['Id_CCB']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('Id_irmaoministerio')
                ->setOptionsFor('Id_CCB');
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new DynamicCombobox('id_irmaoministerio_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_assistenciaministerio_Id_irmaoministerio_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('Id_irmaoministerio', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_assistenciaministerio_Id_irmaoministerio_search');
            
            $filterBuilder->addColumn(
                $columns['Id_irmaoministerio'],
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
            
            $main_editor = new DynamicCombobox('id_ccb_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_assistenciaministerio_Id_CCB_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('Id_CCB', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_assistenciaministerio_Id_CCB_search');
            
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
    
        }
    
        protected function AddFieldColumns(Grid $grid, $withDetails = true)
        {
            //
            // View column for NomeCompleto field
            //
            $column = new TextViewColumn('Id_irmaoministerio', 'Id_irmaoministerio_NomeCompleto', 'Irmão Ministério', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('Id_CCB', 'Id_CCB_Ds_CCB', 'CCB Comum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('assistenciaministerio_Id_CCB_Ds_CCB_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for NomeCompleto field
            //
            $column = new TextViewColumn('Id_irmaoministerio', 'Id_irmaoministerio_NomeCompleto', 'Irmão Ministério', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('Id_CCB', 'Id_CCB_Ds_CCB', 'CCB Comum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('assistenciaministerio_Id_CCB_Ds_CCB_handler_view');
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for Id_irmaoministerio field
            //
            $editor = new DynamicCombobox('id_irmaoministerio_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`cadministerio`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id_irmaoministerio', true, true),
                    new StringField('NomeCompleto'),
                    new StringField('Ministerio'),
                    new StringField('TelefoneFixo'),
                    new StringField('TelefoneCelular'),
                    new StringField('email'),
                    new StringField('SubSetor'),
                    new StringField('ID_CCB'),
                    new StringField('ComumCongregacao')
                )
            );
            $lookupDataset->setOrderByField('NomeCompleto', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Irmão Ministério', 'Id_irmaoministerio', 'Id_irmaoministerio_NomeCompleto', 'edit_assistenciaministerio_Id_irmaoministerio_search', $editor, $this->dataset, $lookupDataset, 'Id_irmaoministerio', 'NomeCompleto', '');
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
            $editColumn = new DynamicLookupEditColumn('CCB Comum', 'Id_CCB', 'Id_CCB_Ds_CCB', 'edit_assistenciaministerio_Id_CCB_search', $editor, $this->dataset, $lookupDataset, 'Id_CCB', 'Ds_CCB', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
            //
            // Edit column for Id_irmaoministerio field
            //
            $editor = new DynamicCombobox('id_irmaoministerio_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`cadministerio`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id_irmaoministerio', true, true),
                    new StringField('NomeCompleto'),
                    new StringField('Ministerio'),
                    new StringField('TelefoneFixo'),
                    new StringField('TelefoneCelular'),
                    new StringField('email'),
                    new StringField('SubSetor'),
                    new StringField('ID_CCB'),
                    new StringField('ComumCongregacao')
                )
            );
            $lookupDataset->setOrderByField('NomeCompleto', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Irmão Ministério', 'Id_irmaoministerio', 'Id_irmaoministerio_NomeCompleto', 'multi_edit_assistenciaministerio_Id_irmaoministerio_search', $editor, $this->dataset, $lookupDataset, 'Id_irmaoministerio', 'NomeCompleto', '');
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
            $editColumn = new DynamicLookupEditColumn('CCB Comum', 'Id_CCB', 'Id_CCB_Ds_CCB', 'multi_edit_assistenciaministerio_Id_CCB_search', $editor, $this->dataset, $lookupDataset, 'Id_CCB', 'Ds_CCB', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for Id_irmaoministerio field
            //
            $editor = new DynamicCombobox('id_irmaoministerio_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`cadministerio`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id_irmaoministerio', true, true),
                    new StringField('NomeCompleto'),
                    new StringField('Ministerio'),
                    new StringField('TelefoneFixo'),
                    new StringField('TelefoneCelular'),
                    new StringField('email'),
                    new StringField('SubSetor'),
                    new StringField('ID_CCB'),
                    new StringField('ComumCongregacao')
                )
            );
            $lookupDataset->setOrderByField('NomeCompleto', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Irmão Ministério', 'Id_irmaoministerio', 'Id_irmaoministerio_NomeCompleto', 'insert_assistenciaministerio_Id_irmaoministerio_search', $editor, $this->dataset, $lookupDataset, 'Id_irmaoministerio', 'NomeCompleto', '');
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
            $editColumn = new DynamicLookupEditColumn('CCB Comum', 'Id_CCB', 'Id_CCB_Ds_CCB', 'insert_assistenciaministerio_Id_CCB_search', $editor, $this->dataset, $lookupDataset, 'Id_CCB', 'Ds_CCB', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            $grid->SetShowAddButton(false && $this->GetSecurityInfo()->HasAddGrant());
        }
    
        private function AddMultiUploadColumn(Grid $grid)
        {
    
        }
    
        protected function AddPrintColumns(Grid $grid)
        {
            //
            // View column for NomeCompleto field
            //
            $column = new TextViewColumn('Id_irmaoministerio', 'Id_irmaoministerio_NomeCompleto', 'Irmão Ministério', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('Id_CCB', 'Id_CCB_Ds_CCB', 'CCB Comum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('assistenciaministerio_Id_CCB_Ds_CCB_handler_print');
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for NomeCompleto field
            //
            $column = new TextViewColumn('Id_irmaoministerio', 'Id_irmaoministerio_NomeCompleto', 'Irmão Ministério', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('Id_CCB', 'Id_CCB_Ds_CCB', 'CCB Comum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('assistenciaministerio_Id_CCB_Ds_CCB_handler_export');
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for NomeCompleto field
            //
            $column = new TextViewColumn('Id_irmaoministerio', 'Id_irmaoministerio_NomeCompleto', 'Irmão Ministério', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('Id_CCB', 'Id_CCB_Ds_CCB', 'CCB Comum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('assistenciaministerio_Id_CCB_Ds_CCB_handler_compare');
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
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset);
            if ($this->GetSecurityInfo()->HasDeleteGrant())
               $result->SetAllowDeleteSelected(false);
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
            $result->setMultiEditAllowed($this->GetSecurityInfo()->HasEditGrant() && false);
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
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('Id_CCB', 'Id_CCB_Ds_CCB', 'CCB Comum', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'assistenciaministerio_Id_CCB_Ds_CCB_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('Id_CCB', 'Id_CCB_Ds_CCB', 'CCB Comum', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'assistenciaministerio_Id_CCB_Ds_CCB_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('Id_CCB', 'Id_CCB_Ds_CCB', 'CCB Comum', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'assistenciaministerio_Id_CCB_Ds_CCB_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`cadministerio`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id_irmaoministerio', true, true),
                    new StringField('NomeCompleto'),
                    new StringField('Ministerio'),
                    new StringField('TelefoneFixo'),
                    new StringField('TelefoneCelular'),
                    new StringField('email'),
                    new StringField('SubSetor'),
                    new StringField('ID_CCB'),
                    new StringField('ComumCongregacao')
                )
            );
            $lookupDataset->setOrderByField('NomeCompleto', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_assistenciaministerio_Id_irmaoministerio_search', 'Id_irmaoministerio', 'NomeCompleto', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_assistenciaministerio_Id_CCB_search', 'Id_CCB', 'Ds_CCB', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`cadministerio`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id_irmaoministerio', true, true),
                    new StringField('NomeCompleto'),
                    new StringField('Ministerio'),
                    new StringField('TelefoneFixo'),
                    new StringField('TelefoneCelular'),
                    new StringField('email'),
                    new StringField('SubSetor'),
                    new StringField('ID_CCB'),
                    new StringField('ComumCongregacao')
                )
            );
            $lookupDataset->setOrderByField('NomeCompleto', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_assistenciaministerio_Id_irmaoministerio_search', 'Id_irmaoministerio', 'NomeCompleto', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_assistenciaministerio_Id_CCB_search', 'Id_CCB', 'Ds_CCB', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('Id_CCB', 'Id_CCB_Ds_CCB', 'CCB Comum', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'assistenciaministerio_Id_CCB_Ds_CCB_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`cadministerio`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id_irmaoministerio', true, true),
                    new StringField('NomeCompleto'),
                    new StringField('Ministerio'),
                    new StringField('TelefoneFixo'),
                    new StringField('TelefoneCelular'),
                    new StringField('email'),
                    new StringField('SubSetor'),
                    new StringField('ID_CCB'),
                    new StringField('ComumCongregacao')
                )
            );
            $lookupDataset->setOrderByField('NomeCompleto', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_assistenciaministerio_Id_irmaoministerio_search', 'Id_irmaoministerio', 'NomeCompleto', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_assistenciaministerio_Id_CCB_search', 'Id_CCB', 'Ds_CCB', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`cadministerio`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id_irmaoministerio', true, true),
                    new StringField('NomeCompleto'),
                    new StringField('Ministerio'),
                    new StringField('TelefoneFixo'),
                    new StringField('TelefoneCelular'),
                    new StringField('email'),
                    new StringField('SubSetor'),
                    new StringField('ID_CCB'),
                    new StringField('ComumCongregacao')
                )
            );
            $lookupDataset->setOrderByField('NomeCompleto', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_assistenciaministerio_Id_irmaoministerio_search', 'Id_irmaoministerio', 'NomeCompleto', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_assistenciaministerio_Id_CCB_search', 'Id_CCB', 'Ds_CCB', null, 20);
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
        $Page = new assistenciaministerioPage("assistenciaministerio", "assistenciaministerio.php", GetCurrentUserPermissionSetForDataSource("assistenciaministerio"), 'UTF-8');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("assistenciaministerio"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
