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
    
    
    
    class cadministerioPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Minitério');
            $this->SetMenuLabel('Minitério');
            $this->SetHeader(GetPagesHeader());
            $this->SetFooter(GetPagesFooter());
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`cadministerio`');
            $this->dataset->addFields(
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
            $this->dataset->AddLookupField('ID_CCB', 'cadcongregacoes', new StringField('Id_CCB'), new StringField('Ds_CCB', false, false, false, false, 'ID_CCB_Ds_CCB', 'ID_CCB_Ds_CCB_cadcongregacoes'), 'ID_CCB_Ds_CCB_cadcongregacoes');
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
                new FilterColumn($this->dataset, 'Id_irmaoministerio', 'Id_irmaoministerio', 'Id Irmaoministerio'),
                new FilterColumn($this->dataset, 'NomeCompleto', 'NomeCompleto', 'Nome'),
                new FilterColumn($this->dataset, 'Ministerio', 'Ministerio', 'Ministério'),
                new FilterColumn($this->dataset, 'TelefoneFixo', 'TelefoneFixo', 'Telefone Fixo'),
                new FilterColumn($this->dataset, 'TelefoneCelular', 'TelefoneCelular', 'Telefone Celular'),
                new FilterColumn($this->dataset, 'email', 'email', 'E-mail'),
                new FilterColumn($this->dataset, 'SubSetor', 'SubSetor', 'Sub Setor'),
                new FilterColumn($this->dataset, 'ID_CCB', 'ID_CCB_Ds_CCB', 'CCB'),
                new FilterColumn($this->dataset, 'ComumCongregacao', 'ComumCongregacao', 'Comum Congregacao')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['Id_irmaoministerio'])
                ->addColumn($columns['NomeCompleto'])
                ->addColumn($columns['Ministerio'])
                ->addColumn($columns['TelefoneFixo'])
                ->addColumn($columns['TelefoneCelular'])
                ->addColumn($columns['email'])
                ->addColumn($columns['SubSetor'])
                ->addColumn($columns['ID_CCB'])
                ->addColumn($columns['ComumCongregacao']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('ID_CCB')
                ->setOptionsFor('ComumCongregacao');
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new TextEdit('id_irmaoministerio_edit');
            
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
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('nomecompleto_edit');
            
            $filterBuilder->addColumn(
                $columns['NomeCompleto'],
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
            
            $main_editor = new ComboBox('ministerio_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $main_editor->addChoice('Ancião', 'Ancião');
            $main_editor->addChoice('Cooperador Jovens e Menores', 'Cooperador Jovens e Menores');
            $main_editor->addChoice('Cooperador Ofício', 'Cooperador Ofício');
            $main_editor->addChoice('Diácono', 'Diácono');
            $main_editor->addChoice('Encarregado Regional', 'Encarregado Regional');
            $main_editor->addChoice('Encarregado Local', 'Encarregado Local');
            $main_editor->addChoice('Examinadora', 'Examinadora');
            $main_editor->addChoice('Piedade', 'Piedade');
            $main_editor->SetAllowNullValue(false);
            
            $multi_value_select_editor = new MultiValueSelect('Ministerio');
            $multi_value_select_editor->setChoices($main_editor->getChoices());
            
            $text_editor = new TextEdit('Ministerio');
            
            $filterBuilder->addColumn(
                $columns['Ministerio'],
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
            
            $main_editor = new MaskedEdit('telefonefixo_edit', '(99) 9999-9999');
            
            $text_editor = new TextEdit('TelefoneFixo');
            
            $filterBuilder->addColumn(
                $columns['TelefoneFixo'],
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
            
            $main_editor = new MaskedEdit('telefonecelular_edit', '(99) 99999-9999');
            
            $text_editor = new TextEdit('TelefoneCelular');
            
            $filterBuilder->addColumn(
                $columns['TelefoneCelular'],
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
            
            $main_editor = new TextEdit('email_edit');
            
            $filterBuilder->addColumn(
                $columns['email'],
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
            
            $main_editor = new ComboBox('subsetor_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $main_editor->addChoice('GUAIANAZES', 'GUAIANAZES');
            $main_editor->addChoice('ITAQUERA', 'ITAQUERA');
            $main_editor->addChoice('SALETE', 'SALETE');
            $main_editor->addChoice('SAO MIGUEL', 'SAO MIGUEL');
            $main_editor->addChoice('TIRADENTES', 'TIRADENTES');
            $main_editor->SetAllowNullValue(false);
            
            $multi_value_select_editor = new MultiValueSelect('SubSetor');
            $multi_value_select_editor->setChoices($main_editor->getChoices());
            
            $text_editor = new TextEdit('SubSetor');
            
            $filterBuilder->addColumn(
                $columns['SubSetor'],
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
            $main_editor->SetHandlerName('filter_builder_cadministerio_ID_CCB_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('ID_CCB', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_cadministerio_ID_CCB_search');
            
            $text_editor = new TextEdit('ID_CCB');
            
            $filterBuilder->addColumn(
                $columns['ID_CCB'],
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
            
            $main_editor = new TextEdit('comumcongregacao_edit');
            
            $filterBuilder->addColumn(
                $columns['ComumCongregacao'],
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
            // View column for Id_irmaoministerio field
            //
            $column = new NumberViewColumn('Id_irmaoministerio', 'Id_irmaoministerio', 'Id Irmaoministerio', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for NomeCompleto field
            //
            $column = new TextViewColumn('NomeCompleto', 'NomeCompleto', 'Nome', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadministerio_NomeCompleto_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Ministerio field
            //
            $column = new TextViewColumn('Ministerio', 'Ministerio', 'Ministério', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadministerio_Ministerio_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for TelefoneFixo field
            //
            $column = new TextViewColumn('TelefoneFixo', 'TelefoneFixo', 'Telefone Fixo', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadministerio_TelefoneFixo_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for TelefoneCelular field
            //
            $column = new TextViewColumn('TelefoneCelular', 'TelefoneCelular', 'Telefone Celular', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadministerio_TelefoneCelular_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for email field
            //
            $column = new TextViewColumn('email', 'email', 'E-mail', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadministerio_email_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for SubSetor field
            //
            $column = new TextViewColumn('SubSetor', 'SubSetor', 'Sub Setor', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadministerio_SubSetor_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('ID_CCB', 'ID_CCB_Ds_CCB', 'CCB', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadministerio_ID_CCB_Ds_CCB_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ComumCongregacao field
            //
            $column = new TextViewColumn('ComumCongregacao', 'ComumCongregacao', 'Comum Congregacao', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadministerio_ComumCongregacao_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for Id_irmaoministerio field
            //
            $column = new NumberViewColumn('Id_irmaoministerio', 'Id_irmaoministerio', 'Id Irmaoministerio', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for NomeCompleto field
            //
            $column = new TextViewColumn('NomeCompleto', 'NomeCompleto', 'Nome', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadministerio_NomeCompleto_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Ministerio field
            //
            $column = new TextViewColumn('Ministerio', 'Ministerio', 'Ministério', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadministerio_Ministerio_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for TelefoneFixo field
            //
            $column = new TextViewColumn('TelefoneFixo', 'TelefoneFixo', 'Telefone Fixo', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadministerio_TelefoneFixo_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for TelefoneCelular field
            //
            $column = new TextViewColumn('TelefoneCelular', 'TelefoneCelular', 'Telefone Celular', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadministerio_TelefoneCelular_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for email field
            //
            $column = new TextViewColumn('email', 'email', 'E-mail', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadministerio_email_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for SubSetor field
            //
            $column = new TextViewColumn('SubSetor', 'SubSetor', 'Sub Setor', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadministerio_SubSetor_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('ID_CCB', 'ID_CCB_Ds_CCB', 'CCB', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadministerio_ID_CCB_Ds_CCB_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ComumCongregacao field
            //
            $column = new TextViewColumn('ComumCongregacao', 'ComumCongregacao', 'Comum Congregacao', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadministerio_ComumCongregacao_handler_view');
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for Id_irmaoministerio field
            //
            $editor = new TextEdit('id_irmaoministerio_edit');
            $editColumn = new CustomEditColumn('Id Irmaoministerio', 'Id_irmaoministerio', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for NomeCompleto field
            //
            $editor = new TextEdit('nomecompleto_edit');
            $editColumn = new CustomEditColumn('Nome', 'NomeCompleto', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Ministerio field
            //
            $editor = new ComboBox('ministerio_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('Ancião', 'Ancião');
            $editor->addChoice('Cooperador Jovens e Menores', 'Cooperador Jovens e Menores');
            $editor->addChoice('Cooperador Ofício', 'Cooperador Ofício');
            $editor->addChoice('Diácono', 'Diácono');
            $editor->addChoice('Encarregado Regional', 'Encarregado Regional');
            $editor->addChoice('Encarregado Local', 'Encarregado Local');
            $editor->addChoice('Examinadora', 'Examinadora');
            $editor->addChoice('Piedade', 'Piedade');
            $editColumn = new CustomEditColumn('Ministério', 'Ministerio', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for TelefoneFixo field
            //
            $editor = new MaskedEdit('telefonefixo_edit', '(99) 9999-9999');
            $editColumn = new CustomEditColumn('Telefone Fixo', 'TelefoneFixo', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for TelefoneCelular field
            //
            $editor = new MaskedEdit('telefonecelular_edit', '(99) 99999-9999');
            $editColumn = new CustomEditColumn('Telefone Celular', 'TelefoneCelular', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for email field
            //
            $editor = new TextEdit('email_edit');
            $editColumn = new CustomEditColumn('E-mail', 'email', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new EMailValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('EmailValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for SubSetor field
            //
            $editor = new ComboBox('subsetor_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('GUAIANAZES', 'GUAIANAZES');
            $editor->addChoice('ITAQUERA', 'ITAQUERA');
            $editor->addChoice('SALETE', 'SALETE');
            $editor->addChoice('SAO MIGUEL', 'SAO MIGUEL');
            $editor->addChoice('TIRADENTES', 'TIRADENTES');
            $editColumn = new CustomEditColumn('Sub Setor', 'SubSetor', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ID_CCB field
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
            $editColumn = new DynamicLookupEditColumn('CCB', 'ID_CCB', 'ID_CCB_Ds_CCB', 'edit_cadministerio_ID_CCB_search', $editor, $this->dataset, $lookupDataset, 'Id_CCB', 'Ds_CCB', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ComumCongregacao field
            //
            $editor = new TextEdit('comumcongregacao_edit');
            $editColumn = new CustomEditColumn('Comum Congregacao', 'ComumCongregacao', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
            //
            // Edit column for NomeCompleto field
            //
            $editor = new TextEdit('nomecompleto_edit');
            $editColumn = new CustomEditColumn('Nome', 'NomeCompleto', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Ministerio field
            //
            $editor = new ComboBox('ministerio_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('Ancião', 'Ancião');
            $editor->addChoice('Cooperador Jovens e Menores', 'Cooperador Jovens e Menores');
            $editor->addChoice('Cooperador Ofício', 'Cooperador Ofício');
            $editor->addChoice('Diácono', 'Diácono');
            $editor->addChoice('Encarregado Regional', 'Encarregado Regional');
            $editor->addChoice('Encarregado Local', 'Encarregado Local');
            $editor->addChoice('Examinadora', 'Examinadora');
            $editor->addChoice('Piedade', 'Piedade');
            $editColumn = new CustomEditColumn('Ministério', 'Ministerio', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for TelefoneFixo field
            //
            $editor = new MaskedEdit('telefonefixo_edit', '(99) 9999-9999');
            $editColumn = new CustomEditColumn('Telefone Fixo', 'TelefoneFixo', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for TelefoneCelular field
            //
            $editor = new MaskedEdit('telefonecelular_edit', '(99) 99999-9999');
            $editColumn = new CustomEditColumn('Telefone Celular', 'TelefoneCelular', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for email field
            //
            $editor = new TextEdit('email_edit');
            $editColumn = new CustomEditColumn('E-mail', 'email', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new EMailValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('EmailValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for SubSetor field
            //
            $editor = new ComboBox('subsetor_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('GUAIANAZES', 'GUAIANAZES');
            $editor->addChoice('ITAQUERA', 'ITAQUERA');
            $editor->addChoice('SALETE', 'SALETE');
            $editor->addChoice('SAO MIGUEL', 'SAO MIGUEL');
            $editor->addChoice('TIRADENTES', 'TIRADENTES');
            $editColumn = new CustomEditColumn('Sub Setor', 'SubSetor', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for ID_CCB field
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
            $editColumn = new DynamicLookupEditColumn('CCB', 'ID_CCB', 'ID_CCB_Ds_CCB', 'multi_edit_cadministerio_ID_CCB_search', $editor, $this->dataset, $lookupDataset, 'Id_CCB', 'Ds_CCB', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for ComumCongregacao field
            //
            $editor = new TextEdit('comumcongregacao_edit');
            $editColumn = new CustomEditColumn('Comum Congregacao', 'ComumCongregacao', $editor, $this->dataset);
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
            $editor = new TextEdit('id_irmaoministerio_edit');
            $editColumn = new CustomEditColumn('Id Irmaoministerio', 'Id_irmaoministerio', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for NomeCompleto field
            //
            $editor = new TextEdit('nomecompleto_edit');
            $editColumn = new CustomEditColumn('Nome', 'NomeCompleto', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Ministerio field
            //
            $editor = new ComboBox('ministerio_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('Ancião', 'Ancião');
            $editor->addChoice('Cooperador Jovens e Menores', 'Cooperador Jovens e Menores');
            $editor->addChoice('Cooperador Ofício', 'Cooperador Ofício');
            $editor->addChoice('Diácono', 'Diácono');
            $editor->addChoice('Encarregado Regional', 'Encarregado Regional');
            $editor->addChoice('Encarregado Local', 'Encarregado Local');
            $editor->addChoice('Examinadora', 'Examinadora');
            $editor->addChoice('Piedade', 'Piedade');
            $editColumn = new CustomEditColumn('Ministério', 'Ministerio', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for TelefoneFixo field
            //
            $editor = new MaskedEdit('telefonefixo_edit', '(99) 9999-9999');
            $editColumn = new CustomEditColumn('Telefone Fixo', 'TelefoneFixo', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for TelefoneCelular field
            //
            $editor = new MaskedEdit('telefonecelular_edit', '(99) 99999-9999');
            $editColumn = new CustomEditColumn('Telefone Celular', 'TelefoneCelular', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for email field
            //
            $editor = new TextEdit('email_edit');
            $editColumn = new CustomEditColumn('E-mail', 'email', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new EMailValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('EmailValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for SubSetor field
            //
            $editor = new ComboBox('subsetor_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('GUAIANAZES', 'GUAIANAZES');
            $editor->addChoice('ITAQUERA', 'ITAQUERA');
            $editor->addChoice('SALETE', 'SALETE');
            $editor->addChoice('SAO MIGUEL', 'SAO MIGUEL');
            $editor->addChoice('TIRADENTES', 'TIRADENTES');
            $editColumn = new CustomEditColumn('Sub Setor', 'SubSetor', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ID_CCB field
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
            $editColumn = new DynamicLookupEditColumn('CCB', 'ID_CCB', 'ID_CCB_Ds_CCB', 'insert_cadministerio_ID_CCB_search', $editor, $this->dataset, $lookupDataset, 'Id_CCB', 'Ds_CCB', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ComumCongregacao field
            //
            $editor = new TextEdit('comumcongregacao_edit');
            $editColumn = new CustomEditColumn('Comum Congregacao', 'ComumCongregacao', $editor, $this->dataset);
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
            // View column for Id_irmaoministerio field
            //
            $column = new NumberViewColumn('Id_irmaoministerio', 'Id_irmaoministerio', 'Id Irmaoministerio', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for NomeCompleto field
            //
            $column = new TextViewColumn('NomeCompleto', 'NomeCompleto', 'Nome', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadministerio_NomeCompleto_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Ministerio field
            //
            $column = new TextViewColumn('Ministerio', 'Ministerio', 'Ministério', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadministerio_Ministerio_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for TelefoneFixo field
            //
            $column = new TextViewColumn('TelefoneFixo', 'TelefoneFixo', 'Telefone Fixo', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadministerio_TelefoneFixo_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for TelefoneCelular field
            //
            $column = new TextViewColumn('TelefoneCelular', 'TelefoneCelular', 'Telefone Celular', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadministerio_TelefoneCelular_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for email field
            //
            $column = new TextViewColumn('email', 'email', 'E-mail', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadministerio_email_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for SubSetor field
            //
            $column = new TextViewColumn('SubSetor', 'SubSetor', 'Sub Setor', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadministerio_SubSetor_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('ID_CCB', 'ID_CCB_Ds_CCB', 'CCB', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadministerio_ID_CCB_Ds_CCB_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for ComumCongregacao field
            //
            $column = new TextViewColumn('ComumCongregacao', 'ComumCongregacao', 'Comum Congregacao', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadministerio_ComumCongregacao_handler_print');
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for Id_irmaoministerio field
            //
            $column = new NumberViewColumn('Id_irmaoministerio', 'Id_irmaoministerio', 'Id Irmaoministerio', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for NomeCompleto field
            //
            $column = new TextViewColumn('NomeCompleto', 'NomeCompleto', 'Nome', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadministerio_NomeCompleto_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for Ministerio field
            //
            $column = new TextViewColumn('Ministerio', 'Ministerio', 'Ministério', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadministerio_Ministerio_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for TelefoneFixo field
            //
            $column = new TextViewColumn('TelefoneFixo', 'TelefoneFixo', 'Telefone Fixo', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadministerio_TelefoneFixo_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for TelefoneCelular field
            //
            $column = new TextViewColumn('TelefoneCelular', 'TelefoneCelular', 'Telefone Celular', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadministerio_TelefoneCelular_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for email field
            //
            $column = new TextViewColumn('email', 'email', 'E-mail', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadministerio_email_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for SubSetor field
            //
            $column = new TextViewColumn('SubSetor', 'SubSetor', 'Sub Setor', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadministerio_SubSetor_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('ID_CCB', 'ID_CCB_Ds_CCB', 'CCB', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadministerio_ID_CCB_Ds_CCB_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for ComumCongregacao field
            //
            $column = new TextViewColumn('ComumCongregacao', 'ComumCongregacao', 'Comum Congregacao', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadministerio_ComumCongregacao_handler_export');
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for Id_irmaoministerio field
            //
            $column = new NumberViewColumn('Id_irmaoministerio', 'Id_irmaoministerio', 'Id Irmaoministerio', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for NomeCompleto field
            //
            $column = new TextViewColumn('NomeCompleto', 'NomeCompleto', 'Nome', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadministerio_NomeCompleto_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Ministerio field
            //
            $column = new TextViewColumn('Ministerio', 'Ministerio', 'Ministério', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadministerio_Ministerio_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for TelefoneFixo field
            //
            $column = new TextViewColumn('TelefoneFixo', 'TelefoneFixo', 'Telefone Fixo', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadministerio_TelefoneFixo_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for TelefoneCelular field
            //
            $column = new TextViewColumn('TelefoneCelular', 'TelefoneCelular', 'Telefone Celular', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadministerio_TelefoneCelular_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for email field
            //
            $column = new TextViewColumn('email', 'email', 'E-mail', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadministerio_email_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for SubSetor field
            //
            $column = new TextViewColumn('SubSetor', 'SubSetor', 'Sub Setor', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadministerio_SubSetor_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('ID_CCB', 'ID_CCB_Ds_CCB', 'CCB', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadministerio_ID_CCB_Ds_CCB_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for ComumCongregacao field
            //
            $column = new TextViewColumn('ComumCongregacao', 'ComumCongregacao', 'Comum Congregacao', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadministerio_ComumCongregacao_handler_compare');
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
            // View column for NomeCompleto field
            //
            $column = new TextViewColumn('NomeCompleto', 'NomeCompleto', 'Nome', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadministerio_NomeCompleto_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Ministerio field
            //
            $column = new TextViewColumn('Ministerio', 'Ministerio', 'Ministério', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadministerio_Ministerio_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for TelefoneFixo field
            //
            $column = new TextViewColumn('TelefoneFixo', 'TelefoneFixo', 'Telefone Fixo', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadministerio_TelefoneFixo_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for TelefoneCelular field
            //
            $column = new TextViewColumn('TelefoneCelular', 'TelefoneCelular', 'Telefone Celular', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadministerio_TelefoneCelular_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for email field
            //
            $column = new TextViewColumn('email', 'email', 'E-mail', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadministerio_email_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for SubSetor field
            //
            $column = new TextViewColumn('SubSetor', 'SubSetor', 'Sub Setor', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadministerio_SubSetor_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('ID_CCB', 'ID_CCB_Ds_CCB', 'CCB', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadministerio_ID_CCB_Ds_CCB_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for ComumCongregacao field
            //
            $column = new TextViewColumn('ComumCongregacao', 'ComumCongregacao', 'Comum Congregacao', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadministerio_ComumCongregacao_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for NomeCompleto field
            //
            $column = new TextViewColumn('NomeCompleto', 'NomeCompleto', 'Nome', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadministerio_NomeCompleto_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Ministerio field
            //
            $column = new TextViewColumn('Ministerio', 'Ministerio', 'Ministério', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadministerio_Ministerio_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for TelefoneFixo field
            //
            $column = new TextViewColumn('TelefoneFixo', 'TelefoneFixo', 'Telefone Fixo', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadministerio_TelefoneFixo_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for TelefoneCelular field
            //
            $column = new TextViewColumn('TelefoneCelular', 'TelefoneCelular', 'Telefone Celular', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadministerio_TelefoneCelular_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for email field
            //
            $column = new TextViewColumn('email', 'email', 'E-mail', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadministerio_email_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for SubSetor field
            //
            $column = new TextViewColumn('SubSetor', 'SubSetor', 'Sub Setor', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadministerio_SubSetor_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('ID_CCB', 'ID_CCB_Ds_CCB', 'CCB', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadministerio_ID_CCB_Ds_CCB_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for ComumCongregacao field
            //
            $column = new TextViewColumn('ComumCongregacao', 'ComumCongregacao', 'Comum Congregacao', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadministerio_ComumCongregacao_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for NomeCompleto field
            //
            $column = new TextViewColumn('NomeCompleto', 'NomeCompleto', 'Nome', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadministerio_NomeCompleto_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Ministerio field
            //
            $column = new TextViewColumn('Ministerio', 'Ministerio', 'Ministério', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadministerio_Ministerio_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for TelefoneFixo field
            //
            $column = new TextViewColumn('TelefoneFixo', 'TelefoneFixo', 'Telefone Fixo', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadministerio_TelefoneFixo_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for TelefoneCelular field
            //
            $column = new TextViewColumn('TelefoneCelular', 'TelefoneCelular', 'Telefone Celular', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadministerio_TelefoneCelular_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for email field
            //
            $column = new TextViewColumn('email', 'email', 'E-mail', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadministerio_email_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for SubSetor field
            //
            $column = new TextViewColumn('SubSetor', 'SubSetor', 'Sub Setor', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadministerio_SubSetor_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('ID_CCB', 'ID_CCB_Ds_CCB', 'CCB', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadministerio_ID_CCB_Ds_CCB_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for ComumCongregacao field
            //
            $column = new TextViewColumn('ComumCongregacao', 'ComumCongregacao', 'Comum Congregacao', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadministerio_ComumCongregacao_handler_compare', $column);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_cadministerio_ID_CCB_search', 'Id_CCB', 'Ds_CCB', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_cadministerio_ID_CCB_search', 'Id_CCB', 'Ds_CCB', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for NomeCompleto field
            //
            $column = new TextViewColumn('NomeCompleto', 'NomeCompleto', 'Nome', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadministerio_NomeCompleto_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Ministerio field
            //
            $column = new TextViewColumn('Ministerio', 'Ministerio', 'Ministério', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadministerio_Ministerio_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for TelefoneFixo field
            //
            $column = new TextViewColumn('TelefoneFixo', 'TelefoneFixo', 'Telefone Fixo', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadministerio_TelefoneFixo_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for TelefoneCelular field
            //
            $column = new TextViewColumn('TelefoneCelular', 'TelefoneCelular', 'Telefone Celular', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadministerio_TelefoneCelular_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for email field
            //
            $column = new TextViewColumn('email', 'email', 'E-mail', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadministerio_email_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for SubSetor field
            //
            $column = new TextViewColumn('SubSetor', 'SubSetor', 'Sub Setor', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadministerio_SubSetor_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('ID_CCB', 'ID_CCB_Ds_CCB', 'CCB', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadministerio_ID_CCB_Ds_CCB_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for ComumCongregacao field
            //
            $column = new TextViewColumn('ComumCongregacao', 'ComumCongregacao', 'Comum Congregacao', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadministerio_ComumCongregacao_handler_view', $column);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_cadministerio_ID_CCB_search', 'Id_CCB', 'Ds_CCB', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_cadministerio_ID_CCB_search', 'Id_CCB', 'Ds_CCB', null, 20);
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
        $Page = new cadministerioPage("cadministerio", "cadministerio.php", GetCurrentUserPermissionSetForDataSource("cadministerio"), 'UTF-8');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("cadministerio"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
