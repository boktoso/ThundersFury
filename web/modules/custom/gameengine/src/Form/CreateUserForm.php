<?php

namespace Drupal\gameengine\Form;

use Drupal\Core\Database\InvalidQueryException;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\user\Entity\User;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\CssCommand;
use Drupal\Core\Ajax\HtmlCommand;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\Core\Site\Settings;
use \GuzzleHttp\Exception\ClientException;

/**
 * Class NewUserForm.
 *
 *
 * @package Drupal\customerportal\Form
 */
class CreateUserForm extends FormBase {

  /**
   * Get the Form ID.
   *
   * @return string
   *   Returns the ID of the form.
   */
  public function getFormId() {
    return 'CreateUserForm';
  }

  /**
   * Validate the username.
   *
   * @param array $form
   *   Form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   Form State.
   *
   * @return \Drupal\Core\Ajax\AjaxResponse
   *   AJAX Response.
   */
  public function validateUserNameAjax(array &$form, FormStateInterface $form_state) {
    $valid = TRUE;
    $username = trim($form_state->getValue('username'));
    $message = 'This Username is Available';
    if (!(user_load_by_name($username) == FALSE)) {
      $valid = FALSE;
      $message = '<span style="color:red;">This Username Already Exists</span>';
    }

    if (preg_match('/[^a-zA-Z0-9\-\_\.\@\ ]/', $username)) {
      $valid = FALSE;
      $message = '<span style="color:red;">This Username Contains Invalid Characters</span>';
    }
    if ($username == NULL || $username == '') {
      $valid = FALSE;
      $message = '<span style="color:red;">Enter a Unique Username</span>';
    }

    $response = new AjaxResponse();
    if ($valid) {
      $css = ['border' => '1px solid green'];
      $message = $this->t($message);
    }
    else {
      $css = ['border' => '1px solid red'];
      $message = $this->t($message);
    }
    $response->addCommand(new CssCommand('#edit-username', $css));
    $response->addCommand(new HtmlCommand('.username-valid-message', $message));
    return $response;
  }

  /**
   * Validate the password.
   *
   * @param array $form
   *   Form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   Form State.
   */
  public function validatePassword2Ajax(array &$form, FormStateInterface $form_state) {

    $password = $form_state->getValue('password');
    $password2 = $form_state->getValue('password2');
    $valid = TRUE;
    $message = '';
    $response = new AjaxResponse();

    if ($password !== $password2) {
      $valid = FALSE;
    }
    if ($valid) {
      $css = ['border' => '1px solid green'];
      $message = $this->t($message);
    }
    else {
      $css = ['border' => '1px solid red'];
      $message = 'Passwords do not match.';
    }
    $response->addCommand(new CssCommand('#edit-password', $css));
    $response->addCommand(new CssCommand('#edit-password2', $css));
    $response->addCommand(new HtmlCommand('.password2-valid-message', $message));
    return $response;
  }

  /**
   * Build the form.
   *
   * @param array $form
   *   Form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   Form State.
   * @param string|null $values
   *   Values to add.
   *
   * @return array|bool
   *   Array containing the form.
   */
  public function buildForm(array $form, FormStateInterface $form_state, $values = NULL) {
    $form['#prefix'] = '<div class="row"><div class="col-xs-12 col-md-3"></div><div class="col-xs-12 col-md-6">';
    $form['#suffix'] = '</div><div class="col-xs-12 col-md-3"></div></div>';

    $form['username'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Username'),
      '#required' => TRUE,
      '#ajax' => [
        'callback' => [$this, 'validateUserNameAjax'],
        'event' => 'change',
        'disable-refocus' => TRUE,
      ],
      '#limit_validation_errors' => [],
      '#suffix' => '<h5 class="username-valid-message"></h5>',
      '#attributes' => [
        'data-disable-refocus' => TRUE,
      ],
    ];

    $form['password'] = [
      '#type' => 'password',
      '#title' => $this->t('Password'),
      '#required' => TRUE,
      '#limit_validation_errors' => [],
      '#suffix' => '<h5 class="password-valid-message"></h5>',
      '#attributes' => [
        'data-disable-refocus' => TRUE,
      ],
    ];

    $form['password2'] = [
      '#type' => 'password',
      '#title' => $this->t('Confirm Password'),
      '#required' => TRUE,
      '#ajax' => [
        'callback' => [$this, 'validatePassword2Ajax'],
        'event' => 'change',
        'disable-refocus' => TRUE,
      ],
      '#limit_validation_errors' => [],
      '#suffix' => '<h5 class="password2-valid-message"></h5>',
      '#attributes' => [
        'data-disable-refocus' => TRUE,
      ],
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
      '#validate' => [
        '::validateUsername',
        '::validatePasswords'
      ],
    ];

    $form['cancel'] = [
      '#type' => 'link',
      '#url' => Url::fromUri('internal:/user/login'),
      '#title' => 'Cancel',
      '#attributes' => [
        'class' => [
          'btn',
          'btn-primary',
          'pull-right',
        ],
      ],
    ];

    return $form;
  }

  /**
   * Submit the form.
   *
   * @param array $form
   *   Form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   Form State.
   *
   * @return array|bool
   *   Returns true.
   *
   * @throws \Drupal\Core\Entity\EntityStorageException
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    // Submit to Salesforce.
    $values = $form_state->getValues();

    // Trim each value.
    foreach ($values as $k => $v) {
      $values[$k] = trim($v);
    }

    try {
      // Create the user.
      $newUser = User::create();
      $newUser->setPassword($values['password']);
      $newUser->setUsername($values['username']);
      $newUser->addRole('player');
      $newUser->activate();
      try {
        $newDisplayName = (string) mt_rand(0,9999999);
      	$newDisplayName = str_pad($newDisplayName, 6, "0", STR_PAD_LEFT);
        $newUser->set('field_display_name', $newDisplayName);
      }
      catch (Exception $e) {}
      $newUser->save();

      $path = '/user/login';
      $url = Url::fromUri('internal:' . $path);
      $form_state->setRedirectUrl($url);
    }
    catch (Exception $e) {
      drupal_set_message(t('Failed to create user account.  Please try again in a few minutes.  If error persists, please contact support.'), 'error');
      $form_state->setRebuild();
    }

    return [$form, $form_state];
  }

  /**
   * Validate the username.
   *
   * @param array $form
   *   Form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   Form State.
   *
   * @return array
   *   Array of the form and form_state.
   */
  public function validateUsername(array &$form, FormStateInterface $form_state) {
    $valid = TRUE;
    $username = trim($form_state->getValue('username'));
    $message = 'This Username is Available';
    if (!(user_load_by_name($username) == FALSE)) {
      $valid = FALSE;
      $message = '<span style="color:red;">This Username Already Exists</span>';
    }

    if (preg_match('/[^a-zA-Z0-9\-\_\.\@\ ]/', $username)) {
      $valid = FALSE;
      $message = '<span style="color:red;">This Username Contains Invalid Characters</span>';
    }
    if ($username == NULL || $username == '') {
      $valid = FALSE;
      $message = '<span style="color:red;">Enter a Unique Username</span>';
    }
    if ($valid) {
      $message = $this->t($message);
    }
    else {
      $message = $this->t($message);
    }

    if ($valid === FALSE) {
      $form_state->setErrorByName('user', $message);
    }

    return [$form, $form_state];
  }

  /**
   * Validate the username.
   *
   * @param array $form
   *   Form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   Form State.
   *
   * @return array
   *   Array of the form and form_state.
   */
  public function validatePasswords(array &$form, FormStateInterface $form_state) {
    $password = $form_state->getValue('password');
    $password2 = $form_state->getValue('password2');
    $valid = TRUE;
    $message = '';
    $response = new AjaxResponse();

    if ($password !== $password2) {
      $valid = FALSE;
    }
    if ($valid) {
      $message = $this->t($message);
    }
    else {
      $message = 'Passwords do not match.';
    }

    if ($valid === FALSE) {
      $form_state->setErrorByName('user', $message);
    }

    return [$form, $form_state];
  }

}
