<?php
namespace Drupal\download_module\Controller;
use Drupal\Core\Controller\ControllerBase;

use Drupal\node\Entity\Node;
use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\Core\Url;
use Drupal\Code\Database\Database;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class DownloadController {


  public function download($nid) {
   

    $node = Node::load($nid);
    $imageUrl = $node->get('field_image1')->entity->uri->value;
    $user = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id());
    $imgae_path = \Drupal::service('file_url_generator')->generateAbsoluteString($imageUrl);
    $email = $user->get('mail')->value;
    $currentdatetime = DrupalDateTime::createFromTimestamp(time());
    $uid= $user->get('uid')->value;
    $query = \Drupal::database();

    $query->insert('asset_download')
    ->fields([
    'filename' => $imageUrl,
    'userid' => $uid,
    'user_mail' =>$email,
    'downloadedtime' => $currentdatetime,
    ])
    ->execute();
    
    if (isset($imgae_path)) {
      
      header('Content-Description: File Transfer');
      header('Content-Type: application/octet-stream');
      header('Content-Disposition: attachment; filename="' . basename($imgae_path) . '"');
      header('Expires: 0');
      header('Cache-Control: must-revalidate');
      header('Pragma: public');
      header('Content-Length: ' . filesize($imgae_path));
      flush(); // Flush system output buffer
      readfile($imgae_path);
      die();
    } else {
      http_response_code(404);
      die();
    }

    return [
      '#theme' => 'listpage',
      '#attached' => [
          'library' => [
              'css/style.css',
          ],
     
        ],
     
     ];
 
  }
  public function downloadList() {
    $header_table = array(
      'id' => t('ID'),
      'userid' => t('userid'),
      'user_mail' => t('user_mail'),
      'filename' => t('filename'),
      'downloaddetails' => t('downloaddetails'),
   
     
    );

      $db = \Drupal::database(); 
      $query = $db->select('asset_download', 'id'); 
      $query->fields('id'); 
      $response = $query->execute()->fetchAll();
      


      
      foreach ($response as $data) {
        $id = Url::fromRoute('download_module.getdetails1', ['id' => $data->id], []);
        
        //get data
        $rows[] = array(
          'id' => $data->id,
          'userid' => $data->userid,
          'user_mail' => $data->user_mail,
          'filename' => $data->filename,
          'downloaddetails' => $data->downloaddetails,
          

        );
  
      }
      // render table
      $form['table'] = [
        '#type' => 'table',
        '#header' => $header_table,
        '#rows' => $rows,
        '#empty' => t('No data found'),
      ];
      return $form;
  }
 
 }
