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
    
    
    
    class cadcongregacoes_CCB_MINISTERIOPage extends DetailPage
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('CCB MINISTERIO');
            $this->SetMenuLabel('CCB MINISTERIO');
            $this->SetHeader(GetPagesHeader());
            $this->SetFooter(GetPagesFooter());
    
            $selectQuery = 'SELECT CM.Id_irmaoministerio,CM.NomeCompleto,CM.Ministerio,CM.TelefoneFixo,CM.TelefoneCelular,AM.Id_CCB
            FROM cadministerio CM
            JOIN assistenciaministerio AM ON CM.Id_irmaoministerio = AM.Id_irmaoministerio
            UNION
            SELECT C2.Id_irmaoministerio,C2.NomeCompleto,C2.Ministerio,C2.TelefoneFixo,C2.TelefoneCelular,C2.Id_CCB
            FROM cadministerio C2 WHERE C2.MINISTERIO IN (\'Cooperador Jovens e Menores\',\'Cooperador Ofício\',\'Encarregado Local\')';
            $insertQuery = array();
            $updateQuery = array();
            $deleteQuery = array();
            $this->dataset = new QueryDataset(
              MySqlIConnectionFactory::getInstance(), 
              GetConnectionOptions(),
              $selectQuery, $insertQuery, $updateQuery, $deleteQuery, 'CCB_MINISTERIO');
            $this->dataset->addFields(
                array(
                    new IntegerField('Id_irmaoministerio', false, true),
                    new StringField('NomeCompleto'),
                    new StringField('Ministerio'),
                    new StringField('TelefoneFixo'),
                    new StringField('TelefoneCelular'),
                    new StringField('Id_CCB')
                )
            );
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
                new FilterColumn($this->dataset, 'NomeCompleto', 'NomeCompleto', 'Nome Completo'),
                new FilterColumn($this->dataset, 'Ministerio', 'Ministerio', 'Ministerio'),
                new FilterColumn($this->dataset, 'TelefoneFixo', 'TelefoneFixo', 'Telefone Fixo'),
                new FilterColumn($this->dataset, 'TelefoneCelular', 'TelefoneCelular', 'Telefone Celular'),
                new FilterColumn($this->dataset, 'Id_CCB', 'Id_CCB', 'Id CCB')
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
                ->addColumn($columns['Id_CCB']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
    
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new SpinEdit('id_irmaoministerio_edit');
            
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
            
            $main_editor = new TextEdit('ministerio_edit');
            
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
            
            $main_editor = new TextEdit('telefonefixo_edit');
            
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
            
            $main_editor = new TextEdit('telefonecelular_edit');
            
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
            
            $main_editor = new TextEdit('id_ccb_edit');
            
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
            $column = new TextViewColumn('NomeCompleto', 'NomeCompleto', 'Nome Completo', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Ministerio field
            //
            $column = new TextViewColumn('Ministerio', 'Ministerio', 'Ministerio', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for TelefoneFixo field
            //
            $column = new TextViewColumn('TelefoneFixo', 'TelefoneFixo', 'Telefone Fixo', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for TelefoneCelular field
            //
            $column = new TextViewColumn('TelefoneCelular', 'TelefoneCelular', 'Telefone Celular', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Id_CCB field
            //
            $column = new TextViewColumn('Id_CCB', 'Id_CCB', 'Id CCB', $this->dataset);
            $column->SetOrderable(true);
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
            $column = new TextViewColumn('NomeCompleto', 'NomeCompleto', 'Nome Completo', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Ministerio field
            //
            $column = new TextViewColumn('Ministerio', 'Ministerio', 'Ministerio', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for TelefoneFixo field
            //
            $column = new TextViewColumn('TelefoneFixo', 'TelefoneFixo', 'Telefone Fixo', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for TelefoneCelular field
            //
            $column = new TextViewColumn('TelefoneCelular', 'TelefoneCelular', 'Telefone Celular', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Id_CCB field
            //
            $column = new TextViewColumn('Id_CCB', 'Id_CCB', 'Id CCB', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for Id_irmaoministerio field
            //
            $editor = new SpinEdit('id_irmaoministerio_edit');
            $editColumn = new CustomEditColumn('Id Irmaoministerio', 'Id_irmaoministerio', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for NomeCompleto field
            //
            $editor = new TextEdit('nomecompleto_edit');
            $editColumn = new CustomEditColumn('Nome Completo', 'NomeCompleto', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Ministerio field
            //
            $editor = new TextEdit('ministerio_edit');
            $editColumn = new CustomEditColumn('Ministerio', 'Ministerio', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for TelefoneFixo field
            //
            $editor = new TextEdit('telefonefixo_edit');
            $editColumn = new CustomEditColumn('Telefone Fixo', 'TelefoneFixo', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for TelefoneCelular field
            //
            $editor = new TextEdit('telefonecelular_edit');
            $editColumn = new CustomEditColumn('Telefone Celular', 'TelefoneCelular', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Id_CCB field
            //
            $editor = new TextEdit('id_ccb_edit');
            $editColumn = new CustomEditColumn('Id CCB', 'Id_CCB', $editor, $this->dataset);
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
            $editor = new SpinEdit('id_irmaoministerio_edit');
            $editColumn = new CustomEditColumn('Id Irmaoministerio', 'Id_irmaoministerio', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for NomeCompleto field
            //
            $editor = new TextEdit('nomecompleto_edit');
            $editColumn = new CustomEditColumn('Nome Completo', 'NomeCompleto', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Ministerio field
            //
            $editor = new TextEdit('ministerio_edit');
            $editColumn = new CustomEditColumn('Ministerio', 'Ministerio', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for TelefoneFixo field
            //
            $editor = new TextEdit('telefonefixo_edit');
            $editColumn = new CustomEditColumn('Telefone Fixo', 'TelefoneFixo', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for TelefoneCelular field
            //
            $editor = new TextEdit('telefonecelular_edit');
            $editColumn = new CustomEditColumn('Telefone Celular', 'TelefoneCelular', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Id_CCB field
            //
            $editor = new TextEdit('id_ccb_edit');
            $editColumn = new CustomEditColumn('Id CCB', 'Id_CCB', $editor, $this->dataset);
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
            $editor = new SpinEdit('id_irmaoministerio_edit');
            $editColumn = new CustomEditColumn('Id Irmaoministerio', 'Id_irmaoministerio', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for NomeCompleto field
            //
            $editor = new TextEdit('nomecompleto_edit');
            $editColumn = new CustomEditColumn('Nome Completo', 'NomeCompleto', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Ministerio field
            //
            $editor = new TextEdit('ministerio_edit');
            $editColumn = new CustomEditColumn('Ministerio', 'Ministerio', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for TelefoneFixo field
            //
            $editor = new TextEdit('telefonefixo_edit');
            $editColumn = new CustomEditColumn('Telefone Fixo', 'TelefoneFixo', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for TelefoneCelular field
            //
            $editor = new TextEdit('telefonecelular_edit');
            $editColumn = new CustomEditColumn('Telefone Celular', 'TelefoneCelular', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Id_CCB field
            //
            $editor = new TextEdit('id_ccb_edit');
            $editColumn = new CustomEditColumn('Id CCB', 'Id_CCB', $editor, $this->dataset);
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
            $column = new TextViewColumn('NomeCompleto', 'NomeCompleto', 'Nome Completo', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Ministerio field
            //
            $column = new TextViewColumn('Ministerio', 'Ministerio', 'Ministerio', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for TelefoneFixo field
            //
            $column = new TextViewColumn('TelefoneFixo', 'TelefoneFixo', 'Telefone Fixo', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for TelefoneCelular field
            //
            $column = new TextViewColumn('TelefoneCelular', 'TelefoneCelular', 'Telefone Celular', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Id_CCB field
            //
            $column = new TextViewColumn('Id_CCB', 'Id_CCB', 'Id CCB', $this->dataset);
            $column->SetOrderable(true);
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
            $column = new TextViewColumn('NomeCompleto', 'NomeCompleto', 'Nome Completo', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for Ministerio field
            //
            $column = new TextViewColumn('Ministerio', 'Ministerio', 'Ministerio', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for TelefoneFixo field
            //
            $column = new TextViewColumn('TelefoneFixo', 'TelefoneFixo', 'Telefone Fixo', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for TelefoneCelular field
            //
            $column = new TextViewColumn('TelefoneCelular', 'TelefoneCelular', 'Telefone Celular', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for Id_CCB field
            //
            $column = new TextViewColumn('Id_CCB', 'Id_CCB', 'Id CCB', $this->dataset);
            $column->SetOrderable(true);
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
            $column = new TextViewColumn('NomeCompleto', 'NomeCompleto', 'Nome Completo', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for Ministerio field
            //
            $column = new TextViewColumn('Ministerio', 'Ministerio', 'Ministerio', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for TelefoneFixo field
            //
            $column = new TextViewColumn('TelefoneFixo', 'TelefoneFixo', 'Telefone Fixo', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for TelefoneCelular field
            //
            $column = new TextViewColumn('TelefoneCelular', 'TelefoneCelular', 'Telefone Celular', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for Id_CCB field
            //
            $column = new TextViewColumn('Id_CCB', 'Id_CCB', 'Id CCB', $this->dataset);
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
    
    
    
    class cadcongregacoesPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Congregações');
            $this->SetMenuLabel('Congregações');
            $this->SetHeader(GetPagesHeader());
            $this->SetFooter(GetPagesFooter());
    
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
                new FilterColumn($this->dataset, 'Id_CCB', 'Id_CCB', 'Id CCB'),
                new FilterColumn($this->dataset, 'Ds_CCB', 'Ds_CCB', 'CCB'),
                new FilterColumn($this->dataset, 'Ds_SubSetor', 'Ds_SubSetor', 'Sub Setor'),
                new FilterColumn($this->dataset, 'Ds_Endereco_CCB', 'Ds_Endereco_CCB', 'Ds Endereco CCB'),
                new FilterColumn($this->dataset, 'Cep_CCB', 'Cep_CCB', 'Cep CCB'),
                new FilterColumn($this->dataset, 'tel_CCB', 'tel_CCB', 'Tel CCB'),
                new FilterColumn($this->dataset, 'Dia_Culto_1', 'Dia_Culto_1', 'Dia Culto 1'),
                new FilterColumn($this->dataset, 'Hora_Culto_1', 'Hora_Culto_1', 'Hora Culto 1'),
                new FilterColumn($this->dataset, 'Dia_Culto_2', 'Dia_Culto_2', 'Dia Culto 2'),
                new FilterColumn($this->dataset, 'Hora_Culto_2', 'Hora_Culto_2', 'Hora Culto 2'),
                new FilterColumn($this->dataset, 'Dia_Culto_3', 'Dia_Culto_3', 'Dia Culto 3'),
                new FilterColumn($this->dataset, 'Hora_Culto_3', 'Hora_Culto_3', 'Hora Culto 3'),
                new FilterColumn($this->dataset, 'Dia_Culto_4', 'Dia_Culto_4', 'Dia Culto 4'),
                new FilterColumn($this->dataset, 'Hora_Culto_4', 'Hora_Culto_4', 'Hora Culto 4'),
                new FilterColumn($this->dataset, 'Dia_RJM', 'Dia_RJM', 'Dia RJM'),
                new FilterColumn($this->dataset, 'Hora_RJM', 'Hora_RJM', 'Hora RJM'),
                new FilterColumn($this->dataset, 'Dia_Ensaio', 'Dia_Ensaio', 'Dia Ensaio'),
                new FilterColumn($this->dataset, 'Hora_Ensaio', 'Hora_Ensaio', 'Hora Ensaio'),
                new FilterColumn($this->dataset, 'Semana_ensaio', 'Semana_ensaio', 'Semana Ensaio')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['Id_CCB'])
                ->addColumn($columns['Ds_CCB'])
                ->addColumn($columns['Ds_SubSetor'])
                ->addColumn($columns['Ds_Endereco_CCB'])
                ->addColumn($columns['Cep_CCB'])
                ->addColumn($columns['tel_CCB'])
                ->addColumn($columns['Dia_Culto_1'])
                ->addColumn($columns['Hora_Culto_1'])
                ->addColumn($columns['Dia_Culto_2'])
                ->addColumn($columns['Hora_Culto_2'])
                ->addColumn($columns['Dia_Culto_3'])
                ->addColumn($columns['Hora_Culto_3'])
                ->addColumn($columns['Dia_Culto_4'])
                ->addColumn($columns['Hora_Culto_4'])
                ->addColumn($columns['Dia_RJM'])
                ->addColumn($columns['Hora_RJM'])
                ->addColumn($columns['Dia_Ensaio'])
                ->addColumn($columns['Hora_Ensaio'])
                ->addColumn($columns['Semana_ensaio']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
    
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new MaskedEdit('id_ccb_edit', '99-9999');
            
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
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('ds_ccb_edit');
            
            $filterBuilder->addColumn(
                $columns['Ds_CCB'],
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
            
            $main_editor = new ComboBox('ds_subsetor_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $main_editor->addChoice('GUAIANAZES', 'GUAIANAZES');
            $main_editor->addChoice('ITAQUERA', 'ITAQUERA');
            $main_editor->addChoice('SALETE', 'SALETE');
            $main_editor->addChoice('SAO MIGUEL', 'SAO MIGUEL');
            $main_editor->addChoice('TIRADENTES', 'TIRADENTES');
            $main_editor->addChoice('OUTROS', 'OUTROS');
            $main_editor->SetAllowNullValue(false);
            
            $multi_value_select_editor = new MultiValueSelect('Ds_SubSetor');
            $multi_value_select_editor->setChoices($main_editor->getChoices());
            
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
            
            $main_editor = new TextEdit('ds_endereco_ccb_edit');
            $main_editor->SetMaxLength(50);
            
            $filterBuilder->addColumn(
                $columns['Ds_Endereco_CCB'],
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
            
            $main_editor = new MaskedEdit('cep_ccb_edit', '99999-999');
            
            $text_editor = new TextEdit('Cep_CCB');
            
            $filterBuilder->addColumn(
                $columns['Cep_CCB'],
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
            
            $main_editor = new TextEdit('tel_ccb_edit');
            $main_editor->SetMaxLength(21);
            
            $filterBuilder->addColumn(
                $columns['tel_CCB'],
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
            
            $main_editor = new TextEdit('dia_culto_1_edit');
            $main_editor->SetMaxLength(3);
            
            $filterBuilder->addColumn(
                $columns['Dia_Culto_1'],
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
            
            $main_editor = new TextEdit('hora_culto_1_edit');
            $main_editor->SetMaxLength(5);
            
            $filterBuilder->addColumn(
                $columns['Hora_Culto_1'],
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
            
            $main_editor = new TextEdit('dia_culto_2_edit');
            $main_editor->SetMaxLength(3);
            
            $filterBuilder->addColumn(
                $columns['Dia_Culto_2'],
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
            
            $main_editor = new TextEdit('hora_culto_2_edit');
            $main_editor->SetMaxLength(5);
            
            $filterBuilder->addColumn(
                $columns['Hora_Culto_2'],
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
            
            $main_editor = new TextEdit('dia_culto_3_edit');
            $main_editor->SetMaxLength(3);
            
            $filterBuilder->addColumn(
                $columns['Dia_Culto_3'],
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
            
            $main_editor = new TextEdit('hora_culto_3_edit');
            $main_editor->SetMaxLength(5);
            
            $filterBuilder->addColumn(
                $columns['Hora_Culto_3'],
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
            
            $main_editor = new TextEdit('dia_culto_4_edit');
            $main_editor->SetMaxLength(3);
            
            $filterBuilder->addColumn(
                $columns['Dia_Culto_4'],
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
            
            $main_editor = new TextEdit('hora_culto_4_edit');
            $main_editor->SetMaxLength(5);
            
            $filterBuilder->addColumn(
                $columns['Hora_Culto_4'],
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
            
            $main_editor = new TextEdit('dia_rjm_edit');
            $main_editor->SetMaxLength(3);
            
            $filterBuilder->addColumn(
                $columns['Dia_RJM'],
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
            
            $main_editor = new TextEdit('hora_rjm_edit');
            $main_editor->SetMaxLength(5);
            
            $filterBuilder->addColumn(
                $columns['Hora_RJM'],
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
            
            $main_editor = new TextEdit('dia_ensaio_edit');
            $main_editor->SetMaxLength(3);
            
            $filterBuilder->addColumn(
                $columns['Dia_Ensaio'],
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
            
            $main_editor = new TextEdit('hora_ensaio_edit');
            $main_editor->SetMaxLength(5);
            
            $filterBuilder->addColumn(
                $columns['Hora_Ensaio'],
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
            
            $main_editor = new TextEdit('semana_ensaio_edit');
            $main_editor->SetMaxLength(20);
            
            $filterBuilder->addColumn(
                $columns['Semana_ensaio'],
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
            if (GetCurrentUserPermissionSetForDataSource('cadcongregacoes.CCB_MINISTERIO')->HasViewGrant() && $withDetails)
            {
            //
            // View column for cadcongregacoes_CCB_MINISTERIO detail
            //
            $column = new DetailColumn(array('Id_CCB'), 'cadcongregacoes.CCB_MINISTERIO', 'cadcongregacoes_CCB_MINISTERIO_handler', $this->dataset, 'CCB MINISTERIO');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            }
            
            //
            // View column for Id_CCB field
            //
            $column = new TextViewColumn('Id_CCB', 'Id_CCB', 'Id CCB', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('Ds_CCB', 'Ds_CCB', 'CCB', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadcongregacoes_Ds_CCB_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Ds_SubSetor field
            //
            $column = new TextViewColumn('Ds_SubSetor', 'Ds_SubSetor', 'Sub Setor', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadcongregacoes_Ds_SubSetor_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Ds_Endereco_CCB field
            //
            $column = new TextViewColumn('Ds_Endereco_CCB', 'Ds_Endereco_CCB', 'Ds Endereco CCB', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Cep_CCB field
            //
            $column = new TextViewColumn('Cep_CCB', 'Cep_CCB', 'Cep CCB', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for tel_CCB field
            //
            $column = new TextViewColumn('tel_CCB', 'tel_CCB', 'Tel CCB', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Dia_Culto_1 field
            //
            $column = new TextViewColumn('Dia_Culto_1', 'Dia_Culto_1', 'Dia Culto 1', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Hora_Culto_1 field
            //
            $column = new TextViewColumn('Hora_Culto_1', 'Hora_Culto_1', 'Hora Culto 1', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Dia_Culto_2 field
            //
            $column = new TextViewColumn('Dia_Culto_2', 'Dia_Culto_2', 'Dia Culto 2', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Hora_Culto_2 field
            //
            $column = new TextViewColumn('Hora_Culto_2', 'Hora_Culto_2', 'Hora Culto 2', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Dia_Culto_3 field
            //
            $column = new TextViewColumn('Dia_Culto_3', 'Dia_Culto_3', 'Dia Culto 3', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Hora_Culto_3 field
            //
            $column = new TextViewColumn('Hora_Culto_3', 'Hora_Culto_3', 'Hora Culto 3', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Dia_Culto_4 field
            //
            $column = new TextViewColumn('Dia_Culto_4', 'Dia_Culto_4', 'Dia Culto 4', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Hora_Culto_4 field
            //
            $column = new TextViewColumn('Hora_Culto_4', 'Hora_Culto_4', 'Hora Culto 4', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Dia_RJM field
            //
            $column = new TextViewColumn('Dia_RJM', 'Dia_RJM', 'Dia RJM', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Hora_RJM field
            //
            $column = new TextViewColumn('Hora_RJM', 'Hora_RJM', 'Hora RJM', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Dia_Ensaio field
            //
            $column = new TextViewColumn('Dia_Ensaio', 'Dia_Ensaio', 'Dia Ensaio', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Hora_Ensaio field
            //
            $column = new TextViewColumn('Hora_Ensaio', 'Hora_Ensaio', 'Hora Ensaio', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Semana_ensaio field
            //
            $column = new TextViewColumn('Semana_ensaio', 'Semana_ensaio', 'Semana Ensaio', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for Id_CCB field
            //
            $column = new TextViewColumn('Id_CCB', 'Id_CCB', 'Id CCB', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('Ds_CCB', 'Ds_CCB', 'CCB', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadcongregacoes_Ds_CCB_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Ds_SubSetor field
            //
            $column = new TextViewColumn('Ds_SubSetor', 'Ds_SubSetor', 'Sub Setor', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadcongregacoes_Ds_SubSetor_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Ds_Endereco_CCB field
            //
            $column = new TextViewColumn('Ds_Endereco_CCB', 'Ds_Endereco_CCB', 'Ds Endereco CCB', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Cep_CCB field
            //
            $column = new TextViewColumn('Cep_CCB', 'Cep_CCB', 'Cep CCB', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for tel_CCB field
            //
            $column = new TextViewColumn('tel_CCB', 'tel_CCB', 'Tel CCB', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Dia_Culto_1 field
            //
            $column = new TextViewColumn('Dia_Culto_1', 'Dia_Culto_1', 'Dia Culto 1', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Hora_Culto_1 field
            //
            $column = new TextViewColumn('Hora_Culto_1', 'Hora_Culto_1', 'Hora Culto 1', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Dia_Culto_2 field
            //
            $column = new TextViewColumn('Dia_Culto_2', 'Dia_Culto_2', 'Dia Culto 2', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Hora_Culto_2 field
            //
            $column = new TextViewColumn('Hora_Culto_2', 'Hora_Culto_2', 'Hora Culto 2', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Dia_Culto_3 field
            //
            $column = new TextViewColumn('Dia_Culto_3', 'Dia_Culto_3', 'Dia Culto 3', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Hora_Culto_3 field
            //
            $column = new TextViewColumn('Hora_Culto_3', 'Hora_Culto_3', 'Hora Culto 3', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Dia_Culto_4 field
            //
            $column = new TextViewColumn('Dia_Culto_4', 'Dia_Culto_4', 'Dia Culto 4', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Hora_Culto_4 field
            //
            $column = new TextViewColumn('Hora_Culto_4', 'Hora_Culto_4', 'Hora Culto 4', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Dia_RJM field
            //
            $column = new TextViewColumn('Dia_RJM', 'Dia_RJM', 'Dia RJM', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Hora_RJM field
            //
            $column = new TextViewColumn('Hora_RJM', 'Hora_RJM', 'Hora RJM', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Dia_Ensaio field
            //
            $column = new TextViewColumn('Dia_Ensaio', 'Dia_Ensaio', 'Dia Ensaio', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Hora_Ensaio field
            //
            $column = new TextViewColumn('Hora_Ensaio', 'Hora_Ensaio', 'Hora Ensaio', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Semana_ensaio field
            //
            $column = new TextViewColumn('Semana_ensaio', 'Semana_ensaio', 'Semana Ensaio', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for Id_CCB field
            //
            $editor = new MaskedEdit('id_ccb_edit', '99-9999');
            $editColumn = new CustomEditColumn('Id CCB', 'Id_CCB', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Ds_CCB field
            //
            $editor = new TextEdit('ds_ccb_edit');
            $editColumn = new CustomEditColumn('CCB', 'Ds_CCB', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Ds_SubSetor field
            //
            $editor = new ComboBox('ds_subsetor_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('GUAIANAZES', 'GUAIANAZES');
            $editor->addChoice('ITAQUERA', 'ITAQUERA');
            $editor->addChoice('SALETE', 'SALETE');
            $editor->addChoice('SAO MIGUEL', 'SAO MIGUEL');
            $editor->addChoice('TIRADENTES', 'TIRADENTES');
            $editor->addChoice('OUTROS', 'OUTROS');
            $editColumn = new CustomEditColumn('Sub Setor', 'Ds_SubSetor', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Ds_Endereco_CCB field
            //
            $editor = new TextEdit('ds_endereco_ccb_edit');
            $editor->SetMaxLength(50);
            $editColumn = new CustomEditColumn('Ds Endereco CCB', 'Ds_Endereco_CCB', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Cep_CCB field
            //
            $editor = new MaskedEdit('cep_ccb_edit', '99999-999');
            $editColumn = new CustomEditColumn('Cep CCB', 'Cep_CCB', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for tel_CCB field
            //
            $editor = new TextEdit('tel_ccb_edit');
            $editor->SetMaxLength(21);
            $editColumn = new CustomEditColumn('Tel CCB', 'tel_CCB', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Dia_Culto_1 field
            //
            $editor = new TextEdit('dia_culto_1_edit');
            $editor->SetMaxLength(3);
            $editColumn = new CustomEditColumn('Dia Culto 1', 'Dia_Culto_1', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Hora_Culto_1 field
            //
            $editor = new TextEdit('hora_culto_1_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Hora Culto 1', 'Hora_Culto_1', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Dia_Culto_2 field
            //
            $editor = new TextEdit('dia_culto_2_edit');
            $editor->SetMaxLength(3);
            $editColumn = new CustomEditColumn('Dia Culto 2', 'Dia_Culto_2', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Hora_Culto_2 field
            //
            $editor = new TextEdit('hora_culto_2_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Hora Culto 2', 'Hora_Culto_2', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Dia_Culto_3 field
            //
            $editor = new TextEdit('dia_culto_3_edit');
            $editor->SetMaxLength(3);
            $editColumn = new CustomEditColumn('Dia Culto 3', 'Dia_Culto_3', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Hora_Culto_3 field
            //
            $editor = new TextEdit('hora_culto_3_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Hora Culto 3', 'Hora_Culto_3', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Dia_Culto_4 field
            //
            $editor = new TextEdit('dia_culto_4_edit');
            $editor->SetMaxLength(3);
            $editColumn = new CustomEditColumn('Dia Culto 4', 'Dia_Culto_4', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Hora_Culto_4 field
            //
            $editor = new TextEdit('hora_culto_4_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Hora Culto 4', 'Hora_Culto_4', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Dia_RJM field
            //
            $editor = new TextEdit('dia_rjm_edit');
            $editor->SetMaxLength(3);
            $editColumn = new CustomEditColumn('Dia RJM', 'Dia_RJM', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Hora_RJM field
            //
            $editor = new TextEdit('hora_rjm_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Hora RJM', 'Hora_RJM', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Dia_Ensaio field
            //
            $editor = new TextEdit('dia_ensaio_edit');
            $editor->SetMaxLength(3);
            $editColumn = new CustomEditColumn('Dia Ensaio', 'Dia_Ensaio', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Hora_Ensaio field
            //
            $editor = new TextEdit('hora_ensaio_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Hora Ensaio', 'Hora_Ensaio', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Semana_ensaio field
            //
            $editor = new TextEdit('semana_ensaio_edit');
            $editor->SetMaxLength(20);
            $editColumn = new CustomEditColumn('Semana Ensaio', 'Semana_ensaio', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
            //
            // Edit column for Ds_CCB field
            //
            $editor = new TextEdit('ds_ccb_edit');
            $editColumn = new CustomEditColumn('CCB', 'Ds_CCB', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Ds_SubSetor field
            //
            $editor = new ComboBox('ds_subsetor_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('GUAIANAZES', 'GUAIANAZES');
            $editor->addChoice('ITAQUERA', 'ITAQUERA');
            $editor->addChoice('SALETE', 'SALETE');
            $editor->addChoice('SAO MIGUEL', 'SAO MIGUEL');
            $editor->addChoice('TIRADENTES', 'TIRADENTES');
            $editor->addChoice('OUTROS', 'OUTROS');
            $editColumn = new CustomEditColumn('Sub Setor', 'Ds_SubSetor', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Ds_Endereco_CCB field
            //
            $editor = new TextEdit('ds_endereco_ccb_edit');
            $editor->SetMaxLength(50);
            $editColumn = new CustomEditColumn('Ds Endereco CCB', 'Ds_Endereco_CCB', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Cep_CCB field
            //
            $editor = new MaskedEdit('cep_ccb_edit', '99999-999');
            $editColumn = new CustomEditColumn('Cep CCB', 'Cep_CCB', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for tel_CCB field
            //
            $editor = new TextEdit('tel_ccb_edit');
            $editor->SetMaxLength(21);
            $editColumn = new CustomEditColumn('Tel CCB', 'tel_CCB', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Dia_Culto_1 field
            //
            $editor = new TextEdit('dia_culto_1_edit');
            $editor->SetMaxLength(3);
            $editColumn = new CustomEditColumn('Dia Culto 1', 'Dia_Culto_1', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Hora_Culto_1 field
            //
            $editor = new TextEdit('hora_culto_1_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Hora Culto 1', 'Hora_Culto_1', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Dia_Culto_2 field
            //
            $editor = new TextEdit('dia_culto_2_edit');
            $editor->SetMaxLength(3);
            $editColumn = new CustomEditColumn('Dia Culto 2', 'Dia_Culto_2', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Hora_Culto_2 field
            //
            $editor = new TextEdit('hora_culto_2_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Hora Culto 2', 'Hora_Culto_2', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Dia_Culto_3 field
            //
            $editor = new TextEdit('dia_culto_3_edit');
            $editor->SetMaxLength(3);
            $editColumn = new CustomEditColumn('Dia Culto 3', 'Dia_Culto_3', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Hora_Culto_3 field
            //
            $editor = new TextEdit('hora_culto_3_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Hora Culto 3', 'Hora_Culto_3', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Dia_Culto_4 field
            //
            $editor = new TextEdit('dia_culto_4_edit');
            $editor->SetMaxLength(3);
            $editColumn = new CustomEditColumn('Dia Culto 4', 'Dia_Culto_4', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Hora_Culto_4 field
            //
            $editor = new TextEdit('hora_culto_4_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Hora Culto 4', 'Hora_Culto_4', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Dia_RJM field
            //
            $editor = new TextEdit('dia_rjm_edit');
            $editor->SetMaxLength(3);
            $editColumn = new CustomEditColumn('Dia RJM', 'Dia_RJM', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Hora_RJM field
            //
            $editor = new TextEdit('hora_rjm_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Hora RJM', 'Hora_RJM', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Dia_Ensaio field
            //
            $editor = new TextEdit('dia_ensaio_edit');
            $editor->SetMaxLength(3);
            $editColumn = new CustomEditColumn('Dia Ensaio', 'Dia_Ensaio', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Hora_Ensaio field
            //
            $editor = new TextEdit('hora_ensaio_edit');
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Hora Ensaio', 'Hora_Ensaio', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Semana_ensaio field
            //
            $editor = new TextEdit('semana_ensaio_edit');
            $editor->SetMaxLength(20);
            $editColumn = new CustomEditColumn('Semana Ensaio', 'Semana_ensaio', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for Id_CCB field
            //
            $editor = new MaskedEdit('id_ccb_edit', '99-9999');
            $editColumn = new CustomEditColumn('Id CCB', 'Id_CCB', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Ds_CCB field
            //
            $editor = new TextEdit('ds_ccb_edit');
            $editColumn = new CustomEditColumn('CCB', 'Ds_CCB', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Ds_SubSetor field
            //
            $editor = new ComboBox('ds_subsetor_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('GUAIANAZES', 'GUAIANAZES');
            $editor->addChoice('ITAQUERA', 'ITAQUERA');
            $editor->addChoice('SALETE', 'SALETE');
            $editor->addChoice('SAO MIGUEL', 'SAO MIGUEL');
            $editor->addChoice('TIRADENTES', 'TIRADENTES');
            $editor->addChoice('OUTROS', 'OUTROS');
            $editColumn = new CustomEditColumn('Sub Setor', 'Ds_SubSetor', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
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
            $editor = new MaskedEdit('cep_ccb_edit', '99999-999');
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
            $grid->SetShowAddButton(true && $this->GetSecurityInfo()->HasAddGrant());
        }
    
        private function AddMultiUploadColumn(Grid $grid)
        {
    
        }
    
        protected function AddPrintColumns(Grid $grid)
        {
            //
            // View column for Id_CCB field
            //
            $column = new TextViewColumn('Id_CCB', 'Id_CCB', 'Id CCB', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('Ds_CCB', 'Ds_CCB', 'CCB', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadcongregacoes_Ds_CCB_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Ds_SubSetor field
            //
            $column = new TextViewColumn('Ds_SubSetor', 'Ds_SubSetor', 'Sub Setor', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadcongregacoes_Ds_SubSetor_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Ds_Endereco_CCB field
            //
            $column = new TextViewColumn('Ds_Endereco_CCB', 'Ds_Endereco_CCB', 'Ds Endereco CCB', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Cep_CCB field
            //
            $column = new TextViewColumn('Cep_CCB', 'Cep_CCB', 'Cep CCB', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for tel_CCB field
            //
            $column = new TextViewColumn('tel_CCB', 'tel_CCB', 'Tel CCB', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Dia_Culto_1 field
            //
            $column = new TextViewColumn('Dia_Culto_1', 'Dia_Culto_1', 'Dia Culto 1', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Hora_Culto_1 field
            //
            $column = new TextViewColumn('Hora_Culto_1', 'Hora_Culto_1', 'Hora Culto 1', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Dia_Culto_2 field
            //
            $column = new TextViewColumn('Dia_Culto_2', 'Dia_Culto_2', 'Dia Culto 2', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Hora_Culto_2 field
            //
            $column = new TextViewColumn('Hora_Culto_2', 'Hora_Culto_2', 'Hora Culto 2', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Dia_Culto_3 field
            //
            $column = new TextViewColumn('Dia_Culto_3', 'Dia_Culto_3', 'Dia Culto 3', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Hora_Culto_3 field
            //
            $column = new TextViewColumn('Hora_Culto_3', 'Hora_Culto_3', 'Hora Culto 3', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Dia_Culto_4 field
            //
            $column = new TextViewColumn('Dia_Culto_4', 'Dia_Culto_4', 'Dia Culto 4', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Hora_Culto_4 field
            //
            $column = new TextViewColumn('Hora_Culto_4', 'Hora_Culto_4', 'Hora Culto 4', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Dia_RJM field
            //
            $column = new TextViewColumn('Dia_RJM', 'Dia_RJM', 'Dia RJM', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Hora_RJM field
            //
            $column = new TextViewColumn('Hora_RJM', 'Hora_RJM', 'Hora RJM', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Dia_Ensaio field
            //
            $column = new TextViewColumn('Dia_Ensaio', 'Dia_Ensaio', 'Dia Ensaio', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Hora_Ensaio field
            //
            $column = new TextViewColumn('Hora_Ensaio', 'Hora_Ensaio', 'Hora Ensaio', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Semana_ensaio field
            //
            $column = new TextViewColumn('Semana_ensaio', 'Semana_ensaio', 'Semana Ensaio', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for Id_CCB field
            //
            $column = new TextViewColumn('Id_CCB', 'Id_CCB', 'Id CCB', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('Ds_CCB', 'Ds_CCB', 'CCB', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadcongregacoes_Ds_CCB_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for Ds_SubSetor field
            //
            $column = new TextViewColumn('Ds_SubSetor', 'Ds_SubSetor', 'Sub Setor', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadcongregacoes_Ds_SubSetor_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for Ds_Endereco_CCB field
            //
            $column = new TextViewColumn('Ds_Endereco_CCB', 'Ds_Endereco_CCB', 'Ds Endereco CCB', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for Cep_CCB field
            //
            $column = new TextViewColumn('Cep_CCB', 'Cep_CCB', 'Cep CCB', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for tel_CCB field
            //
            $column = new TextViewColumn('tel_CCB', 'tel_CCB', 'Tel CCB', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for Dia_Culto_1 field
            //
            $column = new TextViewColumn('Dia_Culto_1', 'Dia_Culto_1', 'Dia Culto 1', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for Hora_Culto_1 field
            //
            $column = new TextViewColumn('Hora_Culto_1', 'Hora_Culto_1', 'Hora Culto 1', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for Dia_Culto_2 field
            //
            $column = new TextViewColumn('Dia_Culto_2', 'Dia_Culto_2', 'Dia Culto 2', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for Hora_Culto_2 field
            //
            $column = new TextViewColumn('Hora_Culto_2', 'Hora_Culto_2', 'Hora Culto 2', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for Dia_Culto_3 field
            //
            $column = new TextViewColumn('Dia_Culto_3', 'Dia_Culto_3', 'Dia Culto 3', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for Hora_Culto_3 field
            //
            $column = new TextViewColumn('Hora_Culto_3', 'Hora_Culto_3', 'Hora Culto 3', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for Dia_Culto_4 field
            //
            $column = new TextViewColumn('Dia_Culto_4', 'Dia_Culto_4', 'Dia Culto 4', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for Hora_Culto_4 field
            //
            $column = new TextViewColumn('Hora_Culto_4', 'Hora_Culto_4', 'Hora Culto 4', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for Dia_RJM field
            //
            $column = new TextViewColumn('Dia_RJM', 'Dia_RJM', 'Dia RJM', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for Hora_RJM field
            //
            $column = new TextViewColumn('Hora_RJM', 'Hora_RJM', 'Hora RJM', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for Dia_Ensaio field
            //
            $column = new TextViewColumn('Dia_Ensaio', 'Dia_Ensaio', 'Dia Ensaio', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for Hora_Ensaio field
            //
            $column = new TextViewColumn('Hora_Ensaio', 'Hora_Ensaio', 'Hora Ensaio', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for Semana_ensaio field
            //
            $column = new TextViewColumn('Semana_ensaio', 'Semana_ensaio', 'Semana Ensaio', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for Id_CCB field
            //
            $column = new TextViewColumn('Id_CCB', 'Id_CCB', 'Id CCB', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('Ds_CCB', 'Ds_CCB', 'CCB', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadcongregacoes_Ds_CCB_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Ds_SubSetor field
            //
            $column = new TextViewColumn('Ds_SubSetor', 'Ds_SubSetor', 'Sub Setor', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadcongregacoes_Ds_SubSetor_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Ds_Endereco_CCB field
            //
            $column = new TextViewColumn('Ds_Endereco_CCB', 'Ds_Endereco_CCB', 'Ds Endereco CCB', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for Cep_CCB field
            //
            $column = new TextViewColumn('Cep_CCB', 'Cep_CCB', 'Cep CCB', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for tel_CCB field
            //
            $column = new TextViewColumn('tel_CCB', 'tel_CCB', 'Tel CCB', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for Dia_Culto_1 field
            //
            $column = new TextViewColumn('Dia_Culto_1', 'Dia_Culto_1', 'Dia Culto 1', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for Hora_Culto_1 field
            //
            $column = new TextViewColumn('Hora_Culto_1', 'Hora_Culto_1', 'Hora Culto 1', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for Dia_Culto_2 field
            //
            $column = new TextViewColumn('Dia_Culto_2', 'Dia_Culto_2', 'Dia Culto 2', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for Hora_Culto_2 field
            //
            $column = new TextViewColumn('Hora_Culto_2', 'Hora_Culto_2', 'Hora Culto 2', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for Dia_Culto_3 field
            //
            $column = new TextViewColumn('Dia_Culto_3', 'Dia_Culto_3', 'Dia Culto 3', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for Hora_Culto_3 field
            //
            $column = new TextViewColumn('Hora_Culto_3', 'Hora_Culto_3', 'Hora Culto 3', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for Dia_Culto_4 field
            //
            $column = new TextViewColumn('Dia_Culto_4', 'Dia_Culto_4', 'Dia Culto 4', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for Hora_Culto_4 field
            //
            $column = new TextViewColumn('Hora_Culto_4', 'Hora_Culto_4', 'Hora Culto 4', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for Dia_RJM field
            //
            $column = new TextViewColumn('Dia_RJM', 'Dia_RJM', 'Dia RJM', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for Hora_RJM field
            //
            $column = new TextViewColumn('Hora_RJM', 'Hora_RJM', 'Hora RJM', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for Dia_Ensaio field
            //
            $column = new TextViewColumn('Dia_Ensaio', 'Dia_Ensaio', 'Dia Ensaio', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for Hora_Ensaio field
            //
            $column = new TextViewColumn('Hora_Ensaio', 'Hora_Ensaio', 'Hora Ensaio', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for Semana_ensaio field
            //
            $column = new TextViewColumn('Semana_ensaio', 'Semana_ensaio', 'Semana Ensaio', $this->dataset);
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
            $detailPage = new cadcongregacoes_CCB_MINISTERIOPage('cadcongregacoes_CCB_MINISTERIO', $this, array('Id_CCB'), array('Id_CCB'), $this->GetForeignKeyFields(), $this->CreateMasterDetailRecordGrid(), $this->dataset, GetCurrentUserPermissionSetForDataSource('cadcongregacoes.CCB_MINISTERIO'), 'UTF-8');
            $detailPage->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource('cadcongregacoes.CCB_MINISTERIO'));
            $detailPage->SetHttpHandlerName('cadcongregacoes_CCB_MINISTERIO_handler');
            $handler = new PageHTTPHandler('cadcongregacoes_CCB_MINISTERIO_handler', $detailPage);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('Ds_CCB', 'Ds_CCB', 'CCB', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadcongregacoes_Ds_CCB_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Ds_SubSetor field
            //
            $column = new TextViewColumn('Ds_SubSetor', 'Ds_SubSetor', 'Sub Setor', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadcongregacoes_Ds_SubSetor_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('Ds_CCB', 'Ds_CCB', 'CCB', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadcongregacoes_Ds_CCB_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Ds_SubSetor field
            //
            $column = new TextViewColumn('Ds_SubSetor', 'Ds_SubSetor', 'Sub Setor', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadcongregacoes_Ds_SubSetor_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('Ds_CCB', 'Ds_CCB', 'CCB', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadcongregacoes_Ds_CCB_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Ds_SubSetor field
            //
            $column = new TextViewColumn('Ds_SubSetor', 'Ds_SubSetor', 'Sub Setor', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadcongregacoes_Ds_SubSetor_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('Ds_CCB', 'Ds_CCB', 'CCB', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadcongregacoes_Ds_CCB_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Ds_SubSetor field
            //
            $column = new TextViewColumn('Ds_SubSetor', 'Ds_SubSetor', 'Sub Setor', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadcongregacoes_Ds_SubSetor_handler_view', $column);
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
        $Page = new cadcongregacoesPage("cadcongregacoes", "cadcongregacoes.php", GetCurrentUserPermissionSetForDataSource("cadcongregacoes"), 'UTF-8');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("cadcongregacoes"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
