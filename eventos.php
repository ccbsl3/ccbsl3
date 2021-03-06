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
    
    
    
    class eventosPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Eventos');
            $this->SetMenuLabel('Eventos');
            $this->SetHeader(GetPagesHeader());
            $this->SetFooter(GetPagesFooter());
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`eventos`');
            $this->dataset->addFields(
                array(
                    new IntegerField('id_Evento', true, true),
                    new StringField('Id_CCB'),
                    new StringField('Ds_Evento'),
                    new DateTimeField('Dt_Evento'),
                    new TimeField('Hr_Inicio'),
                    new TimeField('Hr_Termino'),
                    new StringField('Ds_AtaEvento'),
                    new StringField('anexo_evento')
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
                new FilterColumn($this->dataset, 'id_Evento', 'id_Evento', 'Id Evento'),
                new FilterColumn($this->dataset, 'Ds_Evento', 'Ds_Evento', 'Descrição'),
                new FilterColumn($this->dataset, 'Id_CCB', 'Id_CCB_Ds_CCB', 'CCB'),
                new FilterColumn($this->dataset, 'Dt_Evento', 'Dt_Evento', 'Data Evento'),
                new FilterColumn($this->dataset, 'Hr_Inicio', 'Hr_Inicio', 'Hora Início'),
                new FilterColumn($this->dataset, 'Hr_Termino', 'Hr_Termino', 'Hora Fim'),
                new FilterColumn($this->dataset, 'Ds_AtaEvento', 'Ds_AtaEvento', 'Ds Ata Evento'),
                new FilterColumn($this->dataset, 'anexo_evento', 'anexo_evento', 'ATA')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['id_Evento'])
                ->addColumn($columns['Ds_Evento'])
                ->addColumn($columns['Id_CCB'])
                ->addColumn($columns['Dt_Evento'])
                ->addColumn($columns['Hr_Inicio'])
                ->addColumn($columns['Hr_Termino'])
                ->addColumn($columns['Ds_AtaEvento'])
                ->addColumn($columns['anexo_evento']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('Id_CCB')
                ->setOptionsFor('Dt_Evento')
                ->setOptionsFor('Hr_Inicio')
                ->setOptionsFor('Hr_Termino');
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new TextEdit('id_evento_edit');
            
            $filterBuilder->addColumn(
                $columns['id_Evento'],
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
            
            $main_editor = new TextEdit('ds_evento_edit');
            $main_editor->SetMaxLength(45);
            
            $filterBuilder->addColumn(
                $columns['Ds_Evento'],
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
            $main_editor->SetHandlerName('filter_builder_eventos_Id_CCB_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('Id_CCB', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_eventos_Id_CCB_search');
            
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
            
            $main_editor = new DateTimeEdit('dt_evento_edit', false, 'd.m.Y H:i:s');
            
            $filterBuilder->addColumn(
                $columns['Dt_Evento'],
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
            
            $main_editor = new TimeEdit('hr_inicio_edit', 'H:i:s');
            
            $filterBuilder->addColumn(
                $columns['Hr_Inicio'],
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
            
            $main_editor = new TimeEdit('hr_termino_edit', 'H:i:s');
            
            $filterBuilder->addColumn(
                $columns['Hr_Termino'],
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
            
            $main_editor = new TextEdit('Ds_AtaEvento');
            
            $filterBuilder->addColumn(
                $columns['Ds_AtaEvento'],
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
            
            $main_editor = new TextEdit('anexo_evento');
            
            $filterBuilder->addColumn(
                $columns['anexo_evento'],
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
            // View column for id_Evento field
            //
            $column = new NumberViewColumn('id_Evento', 'id_Evento', 'Id Evento', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Ds_Evento field
            //
            $column = new TextViewColumn('Ds_Evento', 'Ds_Evento', 'Descrição', $this->dataset);
            $column->SetOrderable(true);
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
            // View column for Dt_Evento field
            //
            $column = new DateTimeViewColumn('Dt_Evento', 'Dt_Evento', 'Data Evento', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Hr_Inicio field
            //
            $column = new DateTimeViewColumn('Hr_Inicio', 'Hr_Inicio', 'Hora Início', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('H:i:s');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Hr_Termino field
            //
            $column = new DateTimeViewColumn('Hr_Termino', 'Hr_Termino', 'Hora Fim', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('H:i:s');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for anexo_evento field
            //
            $column = new DownloadExternalDataColumn('anexo_evento', 'anexo_evento', 'ATA', $this->dataset, '');
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for id_Evento field
            //
            $column = new NumberViewColumn('id_Evento', 'id_Evento', 'Id Evento', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Ds_Evento field
            //
            $column = new TextViewColumn('Ds_Evento', 'Ds_Evento', 'Descrição', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('Id_CCB', 'Id_CCB_Ds_CCB', 'CCB', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Dt_Evento field
            //
            $column = new DateTimeViewColumn('Dt_Evento', 'Dt_Evento', 'Data Evento', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Hr_Inicio field
            //
            $column = new DateTimeViewColumn('Hr_Inicio', 'Hr_Inicio', 'Hora Início', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('H:i:s');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Hr_Termino field
            //
            $column = new DateTimeViewColumn('Hr_Termino', 'Hr_Termino', 'Hora Fim', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('H:i:s');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for anexo_evento field
            //
            $column = new DownloadExternalDataColumn('anexo_evento', 'anexo_evento', 'ATA', $this->dataset, '');
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for Ds_Evento field
            //
            $editor = new TextEdit('ds_evento_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Descrição', 'Ds_Evento', $editor, $this->dataset);
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
            $editColumn = new DynamicLookupEditColumn('CCB', 'Id_CCB', 'Id_CCB_Ds_CCB', 'edit_eventos_Id_CCB_search', $editor, $this->dataset, $lookupDataset, 'Id_CCB', 'Ds_CCB', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Dt_Evento field
            //
            $editor = new DateTimeEdit('dt_evento_edit', false, 'd.m.Y H:i:s');
            $editColumn = new CustomEditColumn('Data Evento', 'Dt_Evento', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Hr_Inicio field
            //
            $editor = new TimeEdit('hr_inicio_edit', 'H:i:s');
            $editColumn = new CustomEditColumn('Hora Início', 'Hr_Inicio', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Hr_Termino field
            //
            $editor = new TimeEdit('hr_termino_edit', 'H:i:s');
            $editColumn = new CustomEditColumn('Hora Fim', 'Hr_Termino', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for anexo_evento field
            //
            $editor = new ImageUploader('anexo_evento_edit');
            $editor->SetShowImage(false);
            $editColumn = new UploadFileToFolderColumn('ATA', 'anexo_evento', $editor, $this->dataset, false, false, 'ataevento/', '%random%.%original_file_extension%', $this->OnFileUpload, false);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
            //
            // Edit column for Ds_Evento field
            //
            $editor = new TextEdit('ds_evento_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Descrição', 'Ds_Evento', $editor, $this->dataset);
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
            $editColumn = new DynamicLookupEditColumn('CCB', 'Id_CCB', 'Id_CCB_Ds_CCB', 'multi_edit_eventos_Id_CCB_search', $editor, $this->dataset, $lookupDataset, 'Id_CCB', 'Ds_CCB', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Dt_Evento field
            //
            $editor = new DateTimeEdit('dt_evento_edit', false, 'd.m.Y H:i:s');
            $editColumn = new CustomEditColumn('Data Evento', 'Dt_Evento', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Hr_Inicio field
            //
            $editor = new TimeEdit('hr_inicio_edit', 'H:i:s');
            $editColumn = new CustomEditColumn('Hora Início', 'Hr_Inicio', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Hr_Termino field
            //
            $editor = new TimeEdit('hr_termino_edit', 'H:i:s');
            $editColumn = new CustomEditColumn('Hora Fim', 'Hr_Termino', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for anexo_evento field
            //
            $editor = new ImageUploader('anexo_evento_edit');
            $editor->SetShowImage(false);
            $editColumn = new UploadFileToFolderColumn('ATA', 'anexo_evento', $editor, $this->dataset, false, false, 'ataevento/', '%random%.%original_file_extension%', $this->OnFileUpload, false);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for Ds_Evento field
            //
            $editor = new TextEdit('ds_evento_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Descrição', 'Ds_Evento', $editor, $this->dataset);
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
            $editColumn = new DynamicLookupEditColumn('CCB', 'Id_CCB', 'Id_CCB_Ds_CCB', 'insert_eventos_Id_CCB_search', $editor, $this->dataset, $lookupDataset, 'Id_CCB', 'Ds_CCB', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Dt_Evento field
            //
            $editor = new DateTimeEdit('dt_evento_edit', false, 'd.m.Y H:i:s');
            $editColumn = new CustomEditColumn('Data Evento', 'Dt_Evento', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Hr_Inicio field
            //
            $editor = new TimeEdit('hr_inicio_edit', 'H:i:s');
            $editColumn = new CustomEditColumn('Hora Início', 'Hr_Inicio', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Hr_Termino field
            //
            $editor = new TimeEdit('hr_termino_edit', 'H:i:s');
            $editColumn = new CustomEditColumn('Hora Fim', 'Hr_Termino', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for anexo_evento field
            //
            $editor = new ImageUploader('anexo_evento_edit');
            $editor->SetShowImage(false);
            $editColumn = new UploadFileToFolderColumn('ATA', 'anexo_evento', $editor, $this->dataset, false, false, 'ataevento/', '%random%.%original_file_extension%', $this->OnFileUpload, false);
            $editColumn->SetReplaceUploadedFileIfExist(true);
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
            // View column for id_Evento field
            //
            $column = new NumberViewColumn('id_Evento', 'id_Evento', 'Id Evento', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Ds_Evento field
            //
            $column = new TextViewColumn('Ds_Evento', 'Ds_Evento', 'Descrição', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('Id_CCB', 'Id_CCB_Ds_CCB', 'CCB', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Dt_Evento field
            //
            $column = new DateTimeViewColumn('Dt_Evento', 'Dt_Evento', 'Data Evento', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Hr_Inicio field
            //
            $column = new DateTimeViewColumn('Hr_Inicio', 'Hr_Inicio', 'Hora Início', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('H:i:s');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Hr_Termino field
            //
            $column = new DateTimeViewColumn('Hr_Termino', 'Hr_Termino', 'Hora Fim', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('H:i:s');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Ds_AtaEvento field
            //
            $column = new TextViewColumn('Ds_AtaEvento', 'Ds_AtaEvento', 'Ds Ata Evento', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('eventos_Ds_AtaEvento_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for anexo_evento field
            //
            $column = new DownloadExternalDataColumn('anexo_evento', 'anexo_evento', 'ATA', $this->dataset, '');
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for id_Evento field
            //
            $column = new NumberViewColumn('id_Evento', 'id_Evento', 'Id Evento', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for Ds_Evento field
            //
            $column = new TextViewColumn('Ds_Evento', 'Ds_Evento', 'Descrição', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('Id_CCB', 'Id_CCB_Ds_CCB', 'CCB', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for Dt_Evento field
            //
            $column = new DateTimeViewColumn('Dt_Evento', 'Dt_Evento', 'Data Evento', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddExportColumn($column);
            
            //
            // View column for Hr_Inicio field
            //
            $column = new DateTimeViewColumn('Hr_Inicio', 'Hr_Inicio', 'Hora Início', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('H:i:s');
            $grid->AddExportColumn($column);
            
            //
            // View column for Hr_Termino field
            //
            $column = new DateTimeViewColumn('Hr_Termino', 'Hr_Termino', 'Hora Fim', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('H:i:s');
            $grid->AddExportColumn($column);
            
            //
            // View column for Ds_AtaEvento field
            //
            $column = new TextViewColumn('Ds_AtaEvento', 'Ds_AtaEvento', 'Ds Ata Evento', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('eventos_Ds_AtaEvento_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for anexo_evento field
            //
            $column = new DownloadExternalDataColumn('anexo_evento', 'anexo_evento', 'ATA', $this->dataset, '');
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for id_Evento field
            //
            $column = new NumberViewColumn('id_Evento', 'id_Evento', 'Id Evento', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Ds_Evento field
            //
            $column = new TextViewColumn('Ds_Evento', 'Ds_Evento', 'Descrição', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('Id_CCB', 'Id_CCB_Ds_CCB', 'CCB', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for Dt_Evento field
            //
            $column = new DateTimeViewColumn('Dt_Evento', 'Dt_Evento', 'Data Evento', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Hr_Inicio field
            //
            $column = new DateTimeViewColumn('Hr_Inicio', 'Hr_Inicio', 'Hora Início', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('H:i:s');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Hr_Termino field
            //
            $column = new DateTimeViewColumn('Hr_Termino', 'Hr_Termino', 'Hora Fim', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('H:i:s');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Ds_AtaEvento field
            //
            $column = new TextViewColumn('Ds_AtaEvento', 'Ds_AtaEvento', 'Ds Ata Evento', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('eventos_Ds_AtaEvento_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for anexo_evento field
            //
            $column = new DownloadExternalDataColumn('anexo_evento', 'anexo_evento', 'ATA', $this->dataset, '');
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
            //
            // View column for Ds_AtaEvento field
            //
            $column = new TextViewColumn('Ds_AtaEvento', 'Ds_AtaEvento', 'Ds Ata Evento', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'eventos_Ds_AtaEvento_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Ds_AtaEvento field
            //
            $column = new TextViewColumn('Ds_AtaEvento', 'Ds_AtaEvento', 'Ds Ata Evento', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'eventos_Ds_AtaEvento_handler_compare', $column);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_eventos_Id_CCB_search', 'Id_CCB', 'Ds_CCB', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_eventos_Id_CCB_search', 'Id_CCB', 'Ds_CCB', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_eventos_Id_CCB_search', 'Id_CCB', 'Ds_CCB', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_eventos_Id_CCB_search', 'Id_CCB', 'Ds_CCB', null, 20);
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
        $Page = new eventosPage("eventos", "eventos.php", GetCurrentUserPermissionSetForDataSource("eventos"), 'UTF-8');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("eventos"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
