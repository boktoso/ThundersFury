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

  const FILE_TYPE = 1;
  const BASE64_TYPE = 2;
  const STRING_TYPE = 3;

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
          $timeStamp = time();
          $newPath = sys_get_temp_dir() . '/' . $timeStamp . '/';
          if(!file_exists($newPath)) {
            @mkdir($newPath);
          }
          $filename = is_int($fName) ? $file->getClientOriginalName() : self::str_replace_last('_', '.', $fName);
          $file->move($newPath, $filename);
          if(file_exists($newPath . $filename)) {
            $newImg = $this->resizeImage($newPath . $filename, self::FILE_TYPE);
          }
          else {
            return new JsonResponse(['errorMessage' => 'Failed to move file to temp directory.']);
          }
        }
        catch (\Exception $e) {
          \Drupal::logger('gameengine')->alert($e->getMessage());
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
    $response = [];
    $data = json_decode($request->getContent(), TRUE);
    if (!empty($data['fileData'])) {
      $fileData = $data['fileData'];
      try {
        if(strpos($fileData, 'data:') === FALSE) {
          $newImg = $this->resizeImage($fileData, self::STRING_TYPE);
        }
        else {
          preg_match('/data:image\/[jpeg|png|gif]*;base64,([^"]*)/', $fileData, $matches);
          if (count($matches) > 1) {
            $fileData = $matches[1];
            $newImg = $this->resizeImage($fileData, self::BASE64_TYPE);
          }
        }
      }
      catch (\Exception $e) {
        \Drupal::logger('gameengine')->alert($e->getMessage());
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
    else {
      $response = [
        "errorMessage" => "No Image",
      ];
    }

    return new JsonResponse($response);
  }

  /**
   * Resize the Image.
   *
   * @param string $file
   *   File Location String.
   *
   * @return \Gumlet\ImageResize|null
   *   Returns Gumlet Image if success, NULL otherwise.
   *
   * @throws \Gumlet\ImageResizeException
   *   Throws ImageResizeException.
   */
  public function resizeImage($file, $type = 1) {
    try {
      switch ($type) {
        case self::FILE_TYPE:
          $thumbnail = new ImageResize($file);
          break;

        case self::BASE64_TYPE:
          $thumbnail = ImageResize::createFromString(base64_decode($file));
          break;

        case self::STRING_TYPE:
          $thumbnail = ImageResize::createFromString($file);
          break;

        default:
          break;
      }
      if($thumbnail === NULL) {
        throw new \Exception('Could not initialize resizer.');
      }
      $thumbnail->resizeToBestFit(200, 200, TRUE);
      return $thumbnail;
    }
    catch (ImageResizeException $e) {
      \Drupal::logger('gameengine')->alert($e->getMessage());
      return NULL;
    }
    catch (\Exception $e) {
      \Drupal::logger('gameengine')->alert($e->getMessage());
      return NULL;
    }
  }

  /**
   * Replace last in string.
   *
   * @param string $search
   *   Char to find.
   * @param string $replace
   *   Char to replace.
   * @param string $str
   *   String.
   *
   * @return mixed
   *   Returns the new string.
   */
  public static function str_replace_last($search, $replace, $str) {
    if (($pos = strrpos($str, $search)) !== FALSE) {
      $search_length = strlen($search);
      $str = substr_replace($str, $replace, $pos, $search_length);
    }
    return $str;
  }

}
