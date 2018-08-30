<?php

namespace Drupal\gameengine\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Gumlet\ImageResize;
use Gumlet\ImageResizeException;

/**
 * Class ResizeImage.
 *
 * @package Drupal\gameengine\Controller
 */
class ResizeImage {

  /**
   * ResizeImage constructor.
   */
  public function __construct() {
  }

  /**
   * Resize the thumbnail.
   *
   * @param \Symfony\Component\HttpFoundation\Request $request
   *   Request.
   * @param string $apiVersion
   *   Api Version.
   *
   * @return \Symfony\Component\HttpFoundation\JsonResponse
   *   Returns JSON response.
   */
  public function resizeImageToThumb(Request $request, $apiVersion) {
    $data = $request->files->all();
    $response = [];
    if (!empty($data)) {
      foreach ($data as $fName => $file) {
        try {
          $fileData = file_get_contents($file->getClientOriginalName());
          $newImg = $this->resizeImage($fileData);
        }
        catch (\Exception $e) {
          $newImg = NULL;
        }
        if (is_null($newImg)) {
          $response = [
            "errorMessage" => "Failed to resize the image",
          ];
        }
        else {
          $response = [
            "img" => base64_encode($newImg->getImageAsString()),
          ];
        }
      }
    }
    else {
      $response = [
        "errorMessage" => "No Image",
      ];
    }

    return new JsonResponse($response);
  }

  /**
   * Resize BASE64.
   *
   * Taking BASE64, creating an image, and then making it 200 x 200 keeping
   * ratio.
   */
  public function resizeBase64ToThumb(Request $request, $apiVersion) {
    return new JsonResponse([
      'errorMessage' => 'Not Implemented',
    ]);
  }

  /**
   * Resize the Image.
   *
   * @param string $file
   *   File String.
   *
   * @return \Gumlet\ImageResize|null
   *   Returns Gumlet Image if success, NULL otherwise.
   *
   * @throws \Gumlet\ImageResizeException
   *   Throws ImageResizeException.
   */
  public function resizeImage($file) {
    try {
      $thumbnail = new ImageResize($file);
      $thumbnail->resizeToBestFit(200, 200, TRUE);
      return $thumbnail;
    }
    catch (ImageResizeException $e) {
      return NULL;
    }
    catch (\Exception $e) {
      return NULL;
    }
  }

}
