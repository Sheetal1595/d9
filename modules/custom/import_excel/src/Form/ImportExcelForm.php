<?php
namespace Drupal\import_excel\Form;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

class ImportExcelForm extends FormBase {

    public function getFormId() {
        return 'import_excel_form';
        }

public function buildForm(array $form, FormStateInterface $form_state) {
  
  $form = array(
    '#attributes' => array('enctype' => 'multipart/form-data'),
  );
  
  $form['file_upload_details'] = array(
    '#markup' => t('<b>The File</b>'),
  );
  
  $validators = array(
    'file_validate_extensions' => array('xlsx'),
  );
  $form['excel_file'] = array(
    '#type' => 'managed_file',
    '#name' => 'excel_file',
    '#title' => t('File *'),
    '#size' => 20,
    '#description' => t('Excel format only'),
    '#upload_validators' => $validators,
    '#upload_location' => 'public://content/excel_files/',
  );
  
  $form['actions']['#type'] = 'actions';
  $form['actions']['submit'] = array(
    '#type' => 'submit',
    '#value' => $this->t('Save'),
    '#button_type' => 'primary',
  );

  return $form;

}


public function validateForm(array &$form, FormStateInterface $form_state) {    
    if ($form_state->getValue('excel_file') == NULL) {
      $form_state->setErrorByName('excel_file', $this->t('upload proper File'));
    }
  }

  public function submitForm(array &$form, FormStateInterface $form_state)
  {

  
    $file = \Drupal::entityTypeManager()->getStorage('file')
    ->load($form_state->getValue('excel_file')[0]);    
    $full_path = $file->get('uri')->value;
    $file_name = basename($full_path);

 
$inputFileName = \Drupal::service('file_system')->realpath('public://content/excel_files/'.$file_name);
		
		$spreadsheet = IOFactory::load($inputFileName);
		
		$sheetData = $spreadsheet->getActiveSheet();
		
		$rows = array();
		foreach ($sheetData->getRowIterator() as $row) {
			
			$cellIterator = $row->getCellIterator();
            // echo "<pre>";print_r($cellIterator);exit;

			$cellIterator->setIterateOnlyExistingCells(FALSE); 
            
			$cells = [];
			foreach ($cellIterator as $cell) {
				$cells[] = $cell->getValue();
					 
               
			}
            // echo "<pre>";print_r($cells);exit;

           $rows[] = $cells;
        //    echo "<pre>";print_r($rows);exit;
		   
		}

        foreach($rows as $row){

            // print_r($row);die;
 
		
		}
		
		\Drupal::messenger()->addMessage('imported successfully');
  }
}
  ?>