<?php

namespace Drupal\gameengine\Controller;

use Drupal\Component\Serialization\Json;
use Drupal\Core\Controller\ControllerBase;
use Drupal\user\Entity\User;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Gumlet\ImageResize;

class ResizeImage extends ControllerBase
{
  /**
   * Resize a file image to 200 x 200 keeping ratio.
   */
  public function resizeImageToThumb(Request $request, $apiVersion) {
    $data = $request->files->all();
    foreach($data as $fName => $file) {
      $fileData = file_get_content($file->getClientOriginalName());
      $newImg = $this->resizeIamge($fileData);
      if(is_null($newImg)) {
        $response = [
          "errorMessage" => "Failed to resize the image"
        ];
      }
      else {
        $response = [
          "img" => base64_encode($newImg->getImageAsString()));
        ];
      }
      return new JsonResponse($response);
    }
  }

  /**
   * Taking BASE64, creating an image, and then making it 200 x 200 keeping ratio.
   */
  public function resizeBase64ToThumb(Request $request, $apiVersion) {
      return new JsonResponse([
        'errorMessage' => 'Not Implemented',
      ]);
  }

  /**
   * Resize the file.
   *
   * @param string $file
   *   String content of the file.
   *
   * @return ImageResize|NULL
   *  Returns ImageResize object if success, NULL otherwise.
   */
  public function resizeIamge($file) {
    try {
      $thumbnail = new ImageResize($file);
      try {
        $thumbnail->resizeToBestFit(200, 200, TRUE);
        return $thumbnail;
      }
      catch (ImageResizeException $e) {
        return NULL;
      }
      catch (Exception $e) {
        return NULL;
      }
    }
    catch (ImageResizeException $e) {
      return NULL;
    }
    catch (Exception $e) {
      return NULL;
    }
  }
}
