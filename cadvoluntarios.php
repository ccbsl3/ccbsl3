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
    
    
    
    class cadvoluntarios_GRUPO_VOLUNTARIOPage extends DetailPage
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('GRUPO VOLUNTARIO');
            $this->SetMenuLabel('GRUPO VOLUNTARIO');
            $this->SetHeader(GetPagesHeader());
            $this->SetFooter(GetPagesFooter());
    
            $selectQuery = 'select gc.Id_grupo,gc.Ds_grupo,gc.Id_CCB,cc.Ds_CCB,cc.Ds_SubSetor, gv.id_voluntario from grupoccb gc
            join grupovoluntarios gv on gc.Id_grupo = gv.Id_grupo
            join cadcongregacoes cc on gc.Id_CCB = cc.Id_CCB';
            $insertQuery = array();
            $updateQuery = array();
            $deleteQuery = array();
            $this->dataset = new QueryDataset(
              MySqlIConnectionFactory::getInstance(), 
              GetConnectionOptions(),
              $selectQuery, $insertQuery, $updateQuery, $deleteQuery, 'GRUPO_VOLUNTARIO');
            $this->dataset->addFields(
                array(
                    new IntegerField('Id_grupo', true, true, true),
                    new StringField('Ds_grupo'),
                    new StringField('Id_CCB'),
                    new StringField('Ds_CCB'),
                    new StringField('Ds_SubSetor'),
                    new StringField('id_voluntario', true, true)
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
                new FilterColumn($this->dataset, 'Id_grupo', 'Id_grupo', 'Id Grupo'),
                new FilterColumn($this->dataset, 'Ds_grupo', 'Ds_grupo', 'Ds Grupo'),
                new FilterColumn($this->dataset, 'Id_CCB', 'Id_CCB', 'Id CCB'),
                new FilterColumn($this->dataset, 'Ds_CCB', 'Ds_CCB', 'Ds CCB'),
                new FilterColumn($this->dataset, 'Ds_SubSetor', 'Ds_SubSetor', 'Ds Sub Setor'),
                new FilterColumn($this->dataset, 'id_voluntario', 'id_voluntario', 'Id Voluntario')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['Id_grupo'])
                ->addColumn($columns['Ds_grupo'])
                ->addColumn($columns['Id_CCB'])
                ->addColumn($columns['Ds_CCB'])
                ->addColumn($columns['Ds_SubSetor'])
                ->addColumn($columns['id_voluntario']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
    
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new SpinEdit('id_grupo_edit');
            
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
            
            $main_editor = new TextEdit('ds_subsetor_edit');
            
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
            
            $main_editor = new TextEdit('id_voluntario_edit');
            
            $filterBuilder->addColumn(
                $columns['id_voluntario'],
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
            $column = new TextViewColumn('Ds_CCB', 'Ds_CCB', 'Ds CCB', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for Ds_SubSetor field
            //
            $column = new TextViewColumn('Ds_SubSetor', 'Ds_SubSetor', 'Ds Sub Setor', $this->dataset);
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
            // View column for Ds_grupo field
            //
            $column = new TextViewColumn('Ds_grupo', 'Ds_grupo', 'Ds Grupo', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Id_CCB field
            //
            $column = new TextViewColumn('Id_CCB', 'Id_CCB', 'Id CCB', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('Ds_CCB', 'Ds_CCB', 'Ds CCB', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Ds_SubSetor field
            //
            $column = new TextViewColumn('Ds_SubSetor', 'Ds_SubSetor', 'Ds Sub Setor', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for Id_grupo field
            //
            $editor = new SpinEdit('id_grupo_edit');
            $editColumn = new CustomEditColumn('Id Grupo', 'Id_grupo', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Ds_grupo field
            //
            $editor = new TextEdit('ds_grupo_edit');
            $editColumn = new CustomEditColumn('Ds Grupo', 'Ds_grupo', $editor, $this->dataset);
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
            
            //
            // Edit column for Ds_CCB field
            //
            $editor = new TextEdit('ds_ccb_edit');
            $editColumn = new CustomEditColumn('Ds CCB', 'Ds_CCB', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for Ds_SubSetor field
            //
            $editor = new TextEdit('ds_subsetor_edit');
            $editColumn = new CustomEditColumn('Ds Sub Setor', 'Ds_SubSetor', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
            //
            // Edit column for Id_grupo field
            //
            $editor = new SpinEdit('id_grupo_edit');
            $editColumn = new CustomEditColumn('Id Grupo', 'Id_grupo', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Ds_grupo field
            //
            $editor = new TextEdit('ds_grupo_edit');
            $editColumn = new CustomEditColumn('Ds Grupo', 'Ds_grupo', $editor, $this->dataset);
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
            
            //
            // Edit column for Ds_CCB field
            //
            $editor = new TextEdit('ds_ccb_edit');
            $editColumn = new CustomEditColumn('Ds CCB', 'Ds_CCB', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for Ds_SubSetor field
            //
            $editor = new TextEdit('ds_subsetor_edit');
            $editColumn = new CustomEditColumn('Ds Sub Setor', 'Ds_SubSetor', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for Id_grupo field
            //
            $editor = new SpinEdit('id_grupo_edit');
            $editColumn = new CustomEditColumn('Id Grupo', 'Id_grupo', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Ds_grupo field
            //
            $editor = new TextEdit('ds_grupo_edit');
            $editColumn = new CustomEditColumn('Ds Grupo', 'Ds_grupo', $editor, $this->dataset);
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
            
            //
            // Edit column for Ds_CCB field
            //
            $editor = new TextEdit('ds_ccb_edit');
            $editColumn = new CustomEditColumn('Ds CCB', 'Ds_CCB', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Ds_SubSetor field
            //
            $editor = new TextEdit('ds_subsetor_edit');
            $editColumn = new CustomEditColumn('Ds Sub Setor', 'Ds_SubSetor', $editor, $this->dataset);
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
            // View column for Id_CCB field
            //
            $column = new TextViewColumn('Id_CCB', 'Id_CCB', 'Id CCB', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('Ds_CCB', 'Ds_CCB', 'Ds CCB', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for Ds_SubSetor field
            //
            $column = new TextViewColumn('Ds_SubSetor', 'Ds_SubSetor', 'Ds Sub Setor', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for id_voluntario field
            //
            $column = new TextViewColumn('id_voluntario', 'id_voluntario', 'Id Voluntario', $this->dataset);
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
            // View column for Ds_grupo field
            //
            $column = new TextViewColumn('Ds_grupo', 'Ds_grupo', 'Ds Grupo', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for Id_CCB field
            //
            $column = new TextViewColumn('Id_CCB', 'Id_CCB', 'Id CCB', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('Ds_CCB', 'Ds_CCB', 'Ds CCB', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for Ds_SubSetor field
            //
            $column = new TextViewColumn('Ds_SubSetor', 'Ds_SubSetor', 'Ds Sub Setor', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for id_voluntario field
            //
            $column = new TextViewColumn('id_voluntario', 'id_voluntario', 'Id Voluntario', $this->dataset);
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
            // View column for Ds_grupo field
            //
            $column = new TextViewColumn('Ds_grupo', 'Ds_grupo', 'Ds Grupo', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for Id_CCB field
            //
            $column = new TextViewColumn('Id_CCB', 'Id_CCB', 'Id CCB', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('Ds_CCB', 'Ds_CCB', 'Ds CCB', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for Ds_SubSetor field
            //
            $column = new TextViewColumn('Ds_SubSetor', 'Ds_SubSetor', 'Ds Sub Setor', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for id_voluntario field
            //
            $column = new TextViewColumn('id_voluntario', 'id_voluntario', 'Id Voluntario', $this->dataset);
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
                    new StringField('Ds_SubSetor')
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
    
    class cadvoluntarios_DS_FUNCAO_NA_COMUMNestedPage extends NestedFormPage
    {
        protected function DoBeforeCreate()
        {
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`funcoes`');
            $this->dataset->addFields(
                array(
                    new IntegerField('Id_Funcao', true, true, true),
                    new StringField('Ds_Funcao')
                )
            );
        }
    
        protected function DoPrepare() {
    
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for Id_Funcao field
            //
            $editor = new TextEdit('id_funcao_edit');
            $editColumn = new CustomEditColumn('Id Funcao', 'Id_Funcao', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for Ds_Funcao field
            //
            $editor = new TextEdit('ds_funcao_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Ds Funcao', 'Ds_Funcao', $editor, $this->dataset);
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
            $this->dataset->AddLookupField('Id_CCB', 'cadcongregacoes', new StringField('Id_CCB'), new StringField('Ds_CCB', false, false, false, false, 'Id_CCB_Ds_CCB', 'Id_CCB_Ds_CCB_cadcongregacoes'), 'Id_CCB_Ds_CCB_cadcongregacoes');
            $this->dataset->AddLookupField('DS_FUNCAO_NA_COMUM', 'funcoes', new IntegerField('Id_Funcao'), new StringField('Ds_Funcao', false, false, false, false, 'DS_FUNCAO_NA_COMUM_Ds_Funcao', 'DS_FUNCAO_NA_COMUM_Ds_Funcao_funcoes'), 'DS_FUNCAO_NA_COMUM_Ds_Funcao_funcoes');
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
                new FilterColumn($this->dataset, 'NM_PROFISSAO', 'NM_PROFISSAO', 'PROFISSAO'),
                new FilterColumn($this->dataset, 'Id_CCB', 'Id_CCB_Ds_CCB', 'CCB'),
                new FilterColumn($this->dataset, 'NM_COMUM_CCB', 'NM_COMUM_CCB', 'Comum CCB'),
                new FilterColumn($this->dataset, 'DS_ENDERECO_VOLUNTARIO', 'DS_ENDERECO_VOLUNTARIO', 'Endereço'),
                new FilterColumn($this->dataset, 'NM_BAIRRO_CEP_CIDADE_VOLUNTARIO', 'NM_BAIRRO_CEP_CIDADE_VOLUNTARIO', 'CEP'),
                new FilterColumn($this->dataset, 'CD_TEL_COM_VOLUNTARIO', 'CD_TEL_COM_VOLUNTARIO', 'Telefone'),
                new FilterColumn($this->dataset, 'CD_TEL_RES_VOLUNTARIO', 'CD_TEL_RES_VOLUNTARIO', 'Telefone'),
                new FilterColumn($this->dataset, 'CD_CELULAR', 'CD_CELULAR', 'Celular'),
                new FilterColumn($this->dataset, 'CD_SEXO', 'CD_SEXO', 'Sexo'),
                new FilterColumn($this->dataset, 'DS_DISPONIBILIDADE_VOLUNTARIO', 'DS_DISPONIBILIDADE_VOLUNTARIO', 'Atuação'),
                new FilterColumn($this->dataset, 'DS_EMAIL_VOLUNTARIO', 'DS_EMAIL_VOLUNTARIO', 'E-mail'),
                new FilterColumn($this->dataset, 'DS_FUNCAO_NA_COMUM', 'DS_FUNCAO_NA_COMUM_Ds_Funcao', 'Função'),
                new FilterColumn($this->dataset, 'DS_HABILIDADES', 'DS_HABILIDADES', 'DS HABILIDADES'),
                new FilterColumn($this->dataset, 'DT_APRESENTACAO', 'DT_APRESENTACAO', 'DT APRESENTACAO'),
                new FilterColumn($this->dataset, 'DT_BATISMO_VOLUNTARIO', 'DT_BATISMO_VOLUNTARIO', 'DT BATISMO VOLUNTARIO'),
                new FilterColumn($this->dataset, 'DT_NASC_VOLUNTARIO', 'DT_NASC_VOLUNTARIO', 'Data Nascimento'),
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
                new FilterColumn($this->dataset, 'thumb_aso', 'thumb_aso', 'Foto Certificado ASO')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['Id_voluntario'])
                ->addColumn($columns['NM_VOLUNTARIO'])
                ->addColumn($columns['NM_PROFISSAO'])
                ->addColumn($columns['Id_CCB'])
                ->addColumn($columns['DS_ENDERECO_VOLUNTARIO'])
                ->addColumn($columns['NM_BAIRRO_CEP_CIDADE_VOLUNTARIO'])
                ->addColumn($columns['CD_TEL_RES_VOLUNTARIO'])
                ->addColumn($columns['CD_SEXO'])
                ->addColumn($columns['DS_EMAIL_VOLUNTARIO'])
                ->addColumn($columns['DS_FUNCAO_NA_COMUM'])
                ->addColumn($columns['DT_NASC_VOLUNTARIO'])
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
                ->addColumn($columns['thumb_aso']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('Id_CCB')
                ->setOptionsFor('DS_FUNCAO_NA_COMUM');
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
            
            $main_editor = new MaskedEdit('nm_bairro_cep_cidade_voluntario_edit', '99999-999');
            
            $text_editor = new TextEdit('NM_BAIRRO_CEP_CIDADE_VOLUNTARIO');
            
            $filterBuilder->addColumn(
                $columns['NM_BAIRRO_CEP_CIDADE_VOLUNTARIO'],
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
            
            $main_editor = new TextEdit('cd_tel_res_voluntario_edit');
            
            $filterBuilder->addColumn(
                $columns['CD_TEL_RES_VOLUNTARIO'],
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
            
            $main_editor = new DynamicCombobox('ds_funcao_na_comum_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_cadvoluntarios_DS_FUNCAO_NA_COMUM_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('DS_FUNCAO_NA_COMUM', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_cadvoluntarios_DS_FUNCAO_NA_COMUM_search');
            
            $text_editor = new TextEdit('DS_FUNCAO_NA_COMUM');
            
            $filterBuilder->addColumn(
                $columns['DS_FUNCAO_NA_COMUM'],
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
            if (GetCurrentUserPermissionSetForDataSource('cadvoluntarios.GRUPO_VOLUNTARIO')->HasViewGrant() && $withDetails)
            {
            //
            // View column for cadvoluntarios_GRUPO_VOLUNTARIO detail
            //
            $column = new DetailColumn(array('Id_voluntario'), 'cadvoluntarios.GRUPO_VOLUNTARIO', 'cadvoluntarios_GRUPO_VOLUNTARIO_handler', $this->dataset, 'GRUPO VOLUNTARIO');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            }
            
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
            $column = new TextViewColumn('NM_VOLUNTARIO', 'NM_VOLUNTARIO', 'Nome', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_NM_VOLUNTARIO_handler_list');
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
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('Id_CCB', 'Id_CCB_Ds_CCB', 'CCB', $this->dataset);
            $column->SetOrderable(true);
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
            // View column for NM_BAIRRO_CEP_CIDADE_VOLUNTARIO field
            //
            $column = new TextViewColumn('NM_BAIRRO_CEP_CIDADE_VOLUNTARIO', 'NM_BAIRRO_CEP_CIDADE_VOLUNTARIO', 'CEP', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_NM_BAIRRO_CEP_CIDADE_VOLUNTARIO_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for CD_TEL_RES_VOLUNTARIO field
            //
            $column = new TextViewColumn('CD_TEL_RES_VOLUNTARIO', 'CD_TEL_RES_VOLUNTARIO', 'Telefone', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_CD_TEL_RES_VOLUNTARIO_handler_list');
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
            // View column for Ds_Funcao field
            //
            $column = new TextViewColumn('DS_FUNCAO_NA_COMUM', 'DS_FUNCAO_NA_COMUM_Ds_Funcao', 'Função', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_DS_FUNCAO_NA_COMUM_Ds_Funcao_handler_list');
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
            $column = new TextViewColumn('NM_VOLUNTARIO', 'NM_VOLUNTARIO', 'Nome', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_NM_VOLUNTARIO_handler_view');
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
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('Id_CCB', 'Id_CCB_Ds_CCB', 'CCB', $this->dataset);
            $column->SetOrderable(true);
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
            // View column for NM_BAIRRO_CEP_CIDADE_VOLUNTARIO field
            //
            $column = new TextViewColumn('NM_BAIRRO_CEP_CIDADE_VOLUNTARIO', 'NM_BAIRRO_CEP_CIDADE_VOLUNTARIO', 'CEP', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_NM_BAIRRO_CEP_CIDADE_VOLUNTARIO_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for CD_TEL_RES_VOLUNTARIO field
            //
            $column = new TextViewColumn('CD_TEL_RES_VOLUNTARIO', 'CD_TEL_RES_VOLUNTARIO', 'Telefone', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_CD_TEL_RES_VOLUNTARIO_handler_view');
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
            // View column for DS_EMAIL_VOLUNTARIO field
            //
            $column = new TextViewColumn('DS_EMAIL_VOLUNTARIO', 'DS_EMAIL_VOLUNTARIO', 'E-mail', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_DS_EMAIL_VOLUNTARIO_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for Ds_Funcao field
            //
            $column = new TextViewColumn('DS_FUNCAO_NA_COMUM', 'DS_FUNCAO_NA_COMUM_Ds_Funcao', 'Função', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_DS_FUNCAO_NA_COMUM_Ds_Funcao_handler_view');
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
            // Edit column for NM_PROFISSAO field
            //
            $editor = new TextEdit('nm_profissao_edit');
            $editColumn = new CustomEditColumn('PROFISSAO', 'NM_PROFISSAO', $editor, $this->dataset);
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
                    new StringField('Ds_SubSetor')
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
            // Edit column for DS_ENDERECO_VOLUNTARIO field
            //
            $editor = new TextEdit('ds_endereco_voluntario_edit');
            $editColumn = new CustomEditColumn('Endereço', 'DS_ENDERECO_VOLUNTARIO', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for NM_BAIRRO_CEP_CIDADE_VOLUNTARIO field
            //
            $editor = new MaskedEdit('nm_bairro_cep_cidade_voluntario_edit', '99999-999');
            $editColumn = new CustomEditColumn('CEP', 'NM_BAIRRO_CEP_CIDADE_VOLUNTARIO', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for CD_TEL_RES_VOLUNTARIO field
            //
            $editor = new TextEdit('cd_tel_res_voluntario_edit');
            $editColumn = new CustomEditColumn('Telefone', 'CD_TEL_RES_VOLUNTARIO', $editor, $this->dataset);
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
            // Edit column for DS_FUNCAO_NA_COMUM field
            //
            $editor = new DynamicCombobox('ds_funcao_na_comum_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`funcoes`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id_Funcao', true, true, true),
                    new StringField('Ds_Funcao')
                )
            );
            $lookupDataset->setOrderByField('Ds_Funcao', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Função', 'DS_FUNCAO_NA_COMUM', 'DS_FUNCAO_NA_COMUM_Ds_Funcao', '_cadvoluntarios_DS_FUNCAO_NA_COMUM_search', $editor, $this->dataset, $lookupDataset, 'Id_Funcao', 'Ds_Funcao', '');
            $editColumn->setNestedInsertFormLink(
                $this->GetHandlerLink(cadvoluntarios_DS_FUNCAO_NA_COMUMNestedPage::getNestedInsertHandlerName())
            );
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
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ST_PARTICIPOU_NR35 field
            //
            $editor = new ComboBox('st_participou_nr35_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('Sim', 'Sim');
            $editor->addChoice('Não', 'Não');
            $editColumn = new CustomEditColumn('NR35', 'ST_PARTICIPOU_NR35', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ST_PARTICIPOU_SEG_TRABALHO field
            //
            $editor = new ComboBox('st_participou_seg_trabalho_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('Sim', 'Sim');
            $editor->addChoice('Não', 'Não');
            $editColumn = new CustomEditColumn('TST', 'ST_PARTICIPOU_SEG_TRABALHO', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
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
            // Edit column for NM_PROFISSAO field
            //
            $editor = new TextEdit('nm_profissao_edit');
            $editColumn = new CustomEditColumn('PROFISSAO', 'NM_PROFISSAO', $editor, $this->dataset);
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
                    new StringField('Ds_SubSetor')
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
            // Edit column for DS_ENDERECO_VOLUNTARIO field
            //
            $editor = new TextEdit('ds_endereco_voluntario_edit');
            $editColumn = new CustomEditColumn('Endereço', 'DS_ENDERECO_VOLUNTARIO', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for NM_BAIRRO_CEP_CIDADE_VOLUNTARIO field
            //
            $editor = new MaskedEdit('nm_bairro_cep_cidade_voluntario_edit', '99999-999');
            $editColumn = new CustomEditColumn('CEP', 'NM_BAIRRO_CEP_CIDADE_VOLUNTARIO', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for CD_TEL_RES_VOLUNTARIO field
            //
            $editor = new TextEdit('cd_tel_res_voluntario_edit');
            $editColumn = new CustomEditColumn('Telefone', 'CD_TEL_RES_VOLUNTARIO', $editor, $this->dataset);
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
            // Edit column for DS_FUNCAO_NA_COMUM field
            //
            $editor = new DynamicCombobox('ds_funcao_na_comum_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`funcoes`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id_Funcao', true, true, true),
                    new StringField('Ds_Funcao')
                )
            );
            $lookupDataset->setOrderByField('Ds_Funcao', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Função', 'DS_FUNCAO_NA_COMUM', 'DS_FUNCAO_NA_COMUM_Ds_Funcao', 'multi_edit_cadvoluntarios_DS_FUNCAO_NA_COMUM_search', $editor, $this->dataset, $lookupDataset, 'Id_Funcao', 'Ds_Funcao', '');
            $editColumn->setNestedInsertFormLink(
                $this->GetHandlerLink(cadvoluntarios_DS_FUNCAO_NA_COMUMNestedPage::getNestedInsertHandlerName())
            );
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
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for ST_PARTICIPOU_NR35 field
            //
            $editor = new ComboBox('st_participou_nr35_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('Sim', 'Sim');
            $editor->addChoice('Não', 'Não');
            $editColumn = new CustomEditColumn('NR35', 'ST_PARTICIPOU_NR35', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for ST_PARTICIPOU_SEG_TRABALHO field
            //
            $editor = new ComboBox('st_participou_seg_trabalho_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('Sim', 'Sim');
            $editor->addChoice('Não', 'Não');
            $editColumn = new CustomEditColumn('TST', 'ST_PARTICIPOU_SEG_TRABALHO', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
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
            // Edit column for NM_PROFISSAO field
            //
            $editor = new TextEdit('nm_profissao_edit');
            $editColumn = new CustomEditColumn('PROFISSAO', 'NM_PROFISSAO', $editor, $this->dataset);
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
                    new StringField('Ds_SubSetor')
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
            // Edit column for DS_ENDERECO_VOLUNTARIO field
            //
            $editor = new TextEdit('ds_endereco_voluntario_edit');
            $editColumn = new CustomEditColumn('Endereço', 'DS_ENDERECO_VOLUNTARIO', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for NM_BAIRRO_CEP_CIDADE_VOLUNTARIO field
            //
            $editor = new MaskedEdit('nm_bairro_cep_cidade_voluntario_edit', '99999-999');
            $editColumn = new CustomEditColumn('CEP', 'NM_BAIRRO_CEP_CIDADE_VOLUNTARIO', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for CD_TEL_RES_VOLUNTARIO field
            //
            $editor = new TextEdit('cd_tel_res_voluntario_edit');
            $editColumn = new CustomEditColumn('Telefone', 'CD_TEL_RES_VOLUNTARIO', $editor, $this->dataset);
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
            // Edit column for DS_FUNCAO_NA_COMUM field
            //
            $editor = new DynamicCombobox('ds_funcao_na_comum_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`funcoes`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id_Funcao', true, true, true),
                    new StringField('Ds_Funcao')
                )
            );
            $lookupDataset->setOrderByField('Ds_Funcao', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Função', 'DS_FUNCAO_NA_COMUM', 'DS_FUNCAO_NA_COMUM_Ds_Funcao', 'insert_cadvoluntarios_DS_FUNCAO_NA_COMUM_search', $editor, $this->dataset, $lookupDataset, 'Id_Funcao', 'Ds_Funcao', '');
            $editColumn->setNestedInsertFormLink(
                $this->GetHandlerLink(cadvoluntarios_DS_FUNCAO_NA_COMUMNestedPage::getNestedInsertHandlerName())
            );
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
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ST_PARTICIPOU_NR35 field
            //
            $editor = new ComboBox('st_participou_nr35_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('Sim', 'Sim');
            $editor->addChoice('Não', 'Não');
            $editColumn = new CustomEditColumn('NR35', 'ST_PARTICIPOU_NR35', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ST_PARTICIPOU_SEG_TRABALHO field
            //
            $editor = new ComboBox('st_participou_seg_trabalho_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('Sim', 'Sim');
            $editor->addChoice('Não', 'Não');
            $editColumn = new CustomEditColumn('TST', 'ST_PARTICIPOU_SEG_TRABALHO', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
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
            $column = new TextViewColumn('NM_VOLUNTARIO', 'NM_VOLUNTARIO', 'Nome', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_NM_VOLUNTARIO_handler_print');
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
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('Id_CCB', 'Id_CCB_Ds_CCB', 'CCB', $this->dataset);
            $column->SetOrderable(true);
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
            // View column for NM_BAIRRO_CEP_CIDADE_VOLUNTARIO field
            //
            $column = new TextViewColumn('NM_BAIRRO_CEP_CIDADE_VOLUNTARIO', 'NM_BAIRRO_CEP_CIDADE_VOLUNTARIO', 'CEP', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_NM_BAIRRO_CEP_CIDADE_VOLUNTARIO_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for CD_TEL_RES_VOLUNTARIO field
            //
            $column = new TextViewColumn('CD_TEL_RES_VOLUNTARIO', 'CD_TEL_RES_VOLUNTARIO', 'Telefone', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_CD_TEL_RES_VOLUNTARIO_handler_print');
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
            // View column for DS_EMAIL_VOLUNTARIO field
            //
            $column = new TextViewColumn('DS_EMAIL_VOLUNTARIO', 'DS_EMAIL_VOLUNTARIO', 'E-mail', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_DS_EMAIL_VOLUNTARIO_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for Ds_Funcao field
            //
            $column = new TextViewColumn('DS_FUNCAO_NA_COMUM', 'DS_FUNCAO_NA_COMUM_Ds_Funcao', 'Função', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_DS_FUNCAO_NA_COMUM_Ds_Funcao_handler_print');
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
            $column = new TextViewColumn('NM_VOLUNTARIO', 'NM_VOLUNTARIO', 'Nome', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_NM_VOLUNTARIO_handler_export');
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
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('Id_CCB', 'Id_CCB_Ds_CCB', 'CCB', $this->dataset);
            $column->SetOrderable(true);
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
            // View column for NM_BAIRRO_CEP_CIDADE_VOLUNTARIO field
            //
            $column = new TextViewColumn('NM_BAIRRO_CEP_CIDADE_VOLUNTARIO', 'NM_BAIRRO_CEP_CIDADE_VOLUNTARIO', 'CEP', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_NM_BAIRRO_CEP_CIDADE_VOLUNTARIO_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for CD_TEL_RES_VOLUNTARIO field
            //
            $column = new TextViewColumn('CD_TEL_RES_VOLUNTARIO', 'CD_TEL_RES_VOLUNTARIO', 'Telefone', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_CD_TEL_RES_VOLUNTARIO_handler_export');
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
            // View column for DS_EMAIL_VOLUNTARIO field
            //
            $column = new TextViewColumn('DS_EMAIL_VOLUNTARIO', 'DS_EMAIL_VOLUNTARIO', 'E-mail', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_DS_EMAIL_VOLUNTARIO_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for Ds_Funcao field
            //
            $column = new TextViewColumn('DS_FUNCAO_NA_COMUM', 'DS_FUNCAO_NA_COMUM_Ds_Funcao', 'Função', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_DS_FUNCAO_NA_COMUM_Ds_Funcao_handler_export');
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
            $column = new TextViewColumn('NM_VOLUNTARIO', 'NM_VOLUNTARIO', 'Nome', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_NM_VOLUNTARIO_handler_compare');
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
            // View column for Ds_CCB field
            //
            $column = new TextViewColumn('Id_CCB', 'Id_CCB_Ds_CCB', 'CCB', $this->dataset);
            $column->SetOrderable(true);
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
            // View column for NM_BAIRRO_CEP_CIDADE_VOLUNTARIO field
            //
            $column = new TextViewColumn('NM_BAIRRO_CEP_CIDADE_VOLUNTARIO', 'NM_BAIRRO_CEP_CIDADE_VOLUNTARIO', 'CEP', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_NM_BAIRRO_CEP_CIDADE_VOLUNTARIO_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for CD_TEL_RES_VOLUNTARIO field
            //
            $column = new TextViewColumn('CD_TEL_RES_VOLUNTARIO', 'CD_TEL_RES_VOLUNTARIO', 'Telefone', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_CD_TEL_RES_VOLUNTARIO_handler_compare');
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
            // View column for DS_EMAIL_VOLUNTARIO field
            //
            $column = new TextViewColumn('DS_EMAIL_VOLUNTARIO', 'DS_EMAIL_VOLUNTARIO', 'E-mail', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_DS_EMAIL_VOLUNTARIO_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for Ds_Funcao field
            //
            $column = new TextViewColumn('DS_FUNCAO_NA_COMUM', 'DS_FUNCAO_NA_COMUM_Ds_Funcao', 'Função', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('cadvoluntarios_DS_FUNCAO_NA_COMUM_Ds_Funcao_handler_compare');
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
            $detailPage = new cadvoluntarios_GRUPO_VOLUNTARIOPage('cadvoluntarios_GRUPO_VOLUNTARIO', $this, array('id_voluntario'), array('Id_voluntario'), $this->GetForeignKeyFields(), $this->CreateMasterDetailRecordGrid(), $this->dataset, GetCurrentUserPermissionSetForDataSource('cadvoluntarios.GRUPO_VOLUNTARIO'), 'UTF-8');
            $detailPage->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource('cadvoluntarios.GRUPO_VOLUNTARIO'));
            $detailPage->SetHttpHandlerName('cadvoluntarios_GRUPO_VOLUNTARIO_handler');
            $handler = new PageHTTPHandler('cadvoluntarios_GRUPO_VOLUNTARIO_handler', $detailPage);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for NM_VOLUNTARIO field
            //
            $column = new TextViewColumn('NM_VOLUNTARIO', 'NM_VOLUNTARIO', 'Nome', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_NM_VOLUNTARIO_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for NM_PROFISSAO field
            //
            $column = new TextViewColumn('NM_PROFISSAO', 'NM_PROFISSAO', 'PROFISSAO', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_NM_PROFISSAO_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for DS_ENDERECO_VOLUNTARIO field
            //
            $column = new TextViewColumn('DS_ENDERECO_VOLUNTARIO', 'DS_ENDERECO_VOLUNTARIO', 'Endereço', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_DS_ENDERECO_VOLUNTARIO_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for NM_BAIRRO_CEP_CIDADE_VOLUNTARIO field
            //
            $column = new TextViewColumn('NM_BAIRRO_CEP_CIDADE_VOLUNTARIO', 'NM_BAIRRO_CEP_CIDADE_VOLUNTARIO', 'CEP', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_NM_BAIRRO_CEP_CIDADE_VOLUNTARIO_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for CD_TEL_RES_VOLUNTARIO field
            //
            $column = new TextViewColumn('CD_TEL_RES_VOLUNTARIO', 'CD_TEL_RES_VOLUNTARIO', 'Telefone', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_CD_TEL_RES_VOLUNTARIO_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for CD_SEXO field
            //
            $column = new TextViewColumn('CD_SEXO', 'CD_SEXO', 'Sexo', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_CD_SEXO_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for DS_EMAIL_VOLUNTARIO field
            //
            $column = new TextViewColumn('DS_EMAIL_VOLUNTARIO', 'DS_EMAIL_VOLUNTARIO', 'E-mail', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_DS_EMAIL_VOLUNTARIO_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Ds_Funcao field
            //
            $column = new TextViewColumn('DS_FUNCAO_NA_COMUM', 'DS_FUNCAO_NA_COMUM_Ds_Funcao', 'Função', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_DS_FUNCAO_NA_COMUM_Ds_Funcao_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for DT_NASC_VOLUNTARIO field
            //
            $column = new TextViewColumn('DT_NASC_VOLUNTARIO', 'DT_NASC_VOLUNTARIO', 'Data Nascimento', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_DT_NASC_VOLUNTARIO_handler_list', $column);
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
            $column = new TextViewColumn('NM_VOLUNTARIO', 'NM_VOLUNTARIO', 'Nome', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_NM_VOLUNTARIO_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for NM_PROFISSAO field
            //
            $column = new TextViewColumn('NM_PROFISSAO', 'NM_PROFISSAO', 'PROFISSAO', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_NM_PROFISSAO_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for DS_ENDERECO_VOLUNTARIO field
            //
            $column = new TextViewColumn('DS_ENDERECO_VOLUNTARIO', 'DS_ENDERECO_VOLUNTARIO', 'Endereço', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_DS_ENDERECO_VOLUNTARIO_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for NM_BAIRRO_CEP_CIDADE_VOLUNTARIO field
            //
            $column = new TextViewColumn('NM_BAIRRO_CEP_CIDADE_VOLUNTARIO', 'NM_BAIRRO_CEP_CIDADE_VOLUNTARIO', 'CEP', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_NM_BAIRRO_CEP_CIDADE_VOLUNTARIO_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for CD_TEL_RES_VOLUNTARIO field
            //
            $column = new TextViewColumn('CD_TEL_RES_VOLUNTARIO', 'CD_TEL_RES_VOLUNTARIO', 'Telefone', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_CD_TEL_RES_VOLUNTARIO_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for CD_SEXO field
            //
            $column = new TextViewColumn('CD_SEXO', 'CD_SEXO', 'Sexo', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_CD_SEXO_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for DS_EMAIL_VOLUNTARIO field
            //
            $column = new TextViewColumn('DS_EMAIL_VOLUNTARIO', 'DS_EMAIL_VOLUNTARIO', 'E-mail', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_DS_EMAIL_VOLUNTARIO_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Ds_Funcao field
            //
            $column = new TextViewColumn('DS_FUNCAO_NA_COMUM', 'DS_FUNCAO_NA_COMUM_Ds_Funcao', 'Função', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_DS_FUNCAO_NA_COMUM_Ds_Funcao_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for DT_NASC_VOLUNTARIO field
            //
            $column = new TextViewColumn('DT_NASC_VOLUNTARIO', 'DT_NASC_VOLUNTARIO', 'Data Nascimento', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_DT_NASC_VOLUNTARIO_handler_print', $column);
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
            $column = new TextViewColumn('NM_VOLUNTARIO', 'NM_VOLUNTARIO', 'Nome', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_NM_VOLUNTARIO_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for NM_PROFISSAO field
            //
            $column = new TextViewColumn('NM_PROFISSAO', 'NM_PROFISSAO', 'PROFISSAO', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_NM_PROFISSAO_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for DS_ENDERECO_VOLUNTARIO field
            //
            $column = new TextViewColumn('DS_ENDERECO_VOLUNTARIO', 'DS_ENDERECO_VOLUNTARIO', 'Endereço', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_DS_ENDERECO_VOLUNTARIO_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for NM_BAIRRO_CEP_CIDADE_VOLUNTARIO field
            //
            $column = new TextViewColumn('NM_BAIRRO_CEP_CIDADE_VOLUNTARIO', 'NM_BAIRRO_CEP_CIDADE_VOLUNTARIO', 'CEP', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_NM_BAIRRO_CEP_CIDADE_VOLUNTARIO_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for CD_TEL_RES_VOLUNTARIO field
            //
            $column = new TextViewColumn('CD_TEL_RES_VOLUNTARIO', 'CD_TEL_RES_VOLUNTARIO', 'Telefone', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_CD_TEL_RES_VOLUNTARIO_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for CD_SEXO field
            //
            $column = new TextViewColumn('CD_SEXO', 'CD_SEXO', 'Sexo', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_CD_SEXO_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for DS_EMAIL_VOLUNTARIO field
            //
            $column = new TextViewColumn('DS_EMAIL_VOLUNTARIO', 'DS_EMAIL_VOLUNTARIO', 'E-mail', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_DS_EMAIL_VOLUNTARIO_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Ds_Funcao field
            //
            $column = new TextViewColumn('DS_FUNCAO_NA_COMUM', 'DS_FUNCAO_NA_COMUM_Ds_Funcao', 'Função', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_DS_FUNCAO_NA_COMUM_Ds_Funcao_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for DT_NASC_VOLUNTARIO field
            //
            $column = new TextViewColumn('DT_NASC_VOLUNTARIO', 'DT_NASC_VOLUNTARIO', 'Data Nascimento', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_DT_NASC_VOLUNTARIO_handler_compare', $column);
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
                    new StringField('Ds_SubSetor')
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
                    new StringField('Ds_Funcao')
                )
            );
            $lookupDataset->setOrderByField('Ds_Funcao', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_cadvoluntarios_DS_FUNCAO_NA_COMUM_search', 'Id_Funcao', 'Ds_Funcao', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_cadvoluntarios_Id_CCB_search', 'Id_CCB', 'Ds_CCB', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`funcoes`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id_Funcao', true, true, true),
                    new StringField('Ds_Funcao')
                )
            );
            $lookupDataset->setOrderByField('Ds_Funcao', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_cadvoluntarios_DS_FUNCAO_NA_COMUM_search', 'Id_Funcao', 'Ds_Funcao', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for NM_VOLUNTARIO field
            //
            $column = new TextViewColumn('NM_VOLUNTARIO', 'NM_VOLUNTARIO', 'Nome', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_NM_VOLUNTARIO_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for NM_PROFISSAO field
            //
            $column = new TextViewColumn('NM_PROFISSAO', 'NM_PROFISSAO', 'PROFISSAO', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_NM_PROFISSAO_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for DS_ENDERECO_VOLUNTARIO field
            //
            $column = new TextViewColumn('DS_ENDERECO_VOLUNTARIO', 'DS_ENDERECO_VOLUNTARIO', 'Endereço', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_DS_ENDERECO_VOLUNTARIO_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for NM_BAIRRO_CEP_CIDADE_VOLUNTARIO field
            //
            $column = new TextViewColumn('NM_BAIRRO_CEP_CIDADE_VOLUNTARIO', 'NM_BAIRRO_CEP_CIDADE_VOLUNTARIO', 'CEP', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_NM_BAIRRO_CEP_CIDADE_VOLUNTARIO_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for CD_TEL_RES_VOLUNTARIO field
            //
            $column = new TextViewColumn('CD_TEL_RES_VOLUNTARIO', 'CD_TEL_RES_VOLUNTARIO', 'Telefone', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_CD_TEL_RES_VOLUNTARIO_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for CD_SEXO field
            //
            $column = new TextViewColumn('CD_SEXO', 'CD_SEXO', 'Sexo', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_CD_SEXO_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for DS_EMAIL_VOLUNTARIO field
            //
            $column = new TextViewColumn('DS_EMAIL_VOLUNTARIO', 'DS_EMAIL_VOLUNTARIO', 'E-mail', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_DS_EMAIL_VOLUNTARIO_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for Ds_Funcao field
            //
            $column = new TextViewColumn('DS_FUNCAO_NA_COMUM', 'DS_FUNCAO_NA_COMUM_Ds_Funcao', 'Função', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_DS_FUNCAO_NA_COMUM_Ds_Funcao_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for DT_NASC_VOLUNTARIO field
            //
            $column = new TextViewColumn('DT_NASC_VOLUNTARIO', 'DT_NASC_VOLUNTARIO', 'Data Nascimento', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'cadvoluntarios_DT_NASC_VOLUNTARIO_handler_view', $column);
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
                    new StringField('Ds_SubSetor')
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
                    new StringField('Ds_Funcao')
                )
            );
            $lookupDataset->setOrderByField('Ds_Funcao', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, '_cadvoluntarios_DS_FUNCAO_NA_COMUM_search', 'Id_Funcao', 'Ds_Funcao', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_cadvoluntarios_Id_CCB_search', 'Id_CCB', 'Ds_CCB', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`funcoes`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('Id_Funcao', true, true, true),
                    new StringField('Ds_Funcao')
                )
            );
            $lookupDataset->setOrderByField('Ds_Funcao', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_cadvoluntarios_DS_FUNCAO_NA_COMUM_search', 'Id_Funcao', 'Ds_Funcao', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            
            
            
            
            
            new cadvoluntarios_Id_CCBNestedPage($this, GetCurrentUserPermissionSetForDataSource('cadvoluntarios.Id_CCB'));
            new cadvoluntarios_DS_FUNCAO_NA_COMUMNestedPage($this, GetCurrentUserPermissionSetForDataSource('cadvoluntarios.DS_FUNCAO_NA_COMUM'));
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
        $Page = new cadvoluntariosPage("cadvoluntarios", "cadvoluntarios.php", GetCurrentUserPermissionSetForDataSource("cadvoluntarios"), 'UTF-8');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("cadvoluntarios"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
