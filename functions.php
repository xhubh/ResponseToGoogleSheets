<?php
define('THEME_PATH', get_stylesheet_directory());

// Enqueue scripts and styles
function okmg_scripts()
{
    wp_enqueue_style('okmg-style', get_stylesheet_uri());
    wp_enqueue_script('okmg-script', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0', true);
    wp_localize_script(
        'okmg-script',
        'local_ajax_object',
        array('ajax_url' => admin_url('admin-ajax.php'))
    );
}
add_action('wp_enqueue_scripts', 'okmg_scripts');

// Register navigation menu
function okmg_register_nav_menu()
{
    register_nav_menu('primary', __('Primary Menu', 'okmg'));
}
add_action('after_setup_theme', 'okmg_register_nav_menu');

//auto import acf fields



// Submit form Handler
function getClient()
{
    $projectId = get_field('project_id', 'option');
    $privateId = get_field('private_id', 'option');
    $clientId = get_field('client_id', 'option');
    $clientEmail = get_field('client_email', 'option');
    $privateKey = get_field('private_key', 'option');
    $authConfig = [
        "type" => "service_account",
        'project_id' => $projectId,
        'private_key_id' => $privateId,
        "client_email" => $clientEmail,
        "client_id" => $clientId,
        'private_key' => $privateKey,
        'auth_uri' => 'https://accounts.google.com/o/oauth2/auth',
        'token_uri' => 'https://oauth2.googleapis.com/token',
        "auth_provider_x509_cert_url" => "https://www.googleapis.com/oauth2/v1/certs",
        "client_x509_cert_url" => "https://www.googleapis.com/robot/v1/metadata/x509/test-588%40localcheck-php.iam.gserviceaccount.com",
    ];
    $json = json_encode($authConfig);
    file_put_contents(THEME_PATH . '/cred.json', stripslashes($json));
    $client = new Google_Client();
    $client->setApplicationName('Project');
    $client->setScopes(Google_Service_Sheets::SPREADSHEETS);
    $client->setAuthConfig(THEME_PATH . '/cred.json');
    $client->setAccessType('offline');
    return $client;
}

function insertData($range = 'Sheet1', array $data = [],  array $keys = [], $sheet_id = '1GPRZl-JZ7ZIrnb-eZE41t6quDC6IX4UbxJSTg63w31c')
{
    // Get the API client and construct the service object.

    $client = getClient();

    $service = new Google_Service_Sheets($client);
    $valueRange = new Google_Service_Sheets_ValueRange();
    $valueRange_col = new Google_Service_Sheets_ValueRange();
    $valueRange->setValues(
        [
            'values' => $data
        ]
    );
    $valueRange_col->setValues(
        [
            'values' => $keys
        ]
    );
    $conf = ["valueInputOption" => "RAW"];
    // $response = $service->spreadsheets_values->append($sheet_id, $range, $valueRange, $conf);
    $response = $service->spreadsheets_values->update($sheet_id, 'A1', $valueRange_col, $conf);
    $response = $service->spreadsheets_values->append($sheet_id, 'A2', $valueRange, $conf);
    return $response;
}

add_action('wp_ajax_submit_form', 'submit_form');
add_action('wp_ajax_nopriv_submit_form', 'submit_form');

function submit_form()
{
    require_once(THEME_PATH . '/vendor/autoload.php');
    $formData = array();
    $formKeys = array();
    foreach ($_POST as $key => $value) {
        if ($key == 'sheet') {
            preg_match('/\/d\/([a-zA-Z0-9-_]+)/', $value, $matches);
            $sheet_id = $matches[1];
        } else if ($key != 'action') {
            $formKeys[] = sanitize_text_field($key);
            $formData[] = sanitize_text_field($value);
        }
    }
    insertData('Sheet1', $formData, $formKeys, $sheet_id);
}

//Add Page for storing Credentials
if (function_exists('acf_add_options_page')) {

    acf_add_options_page(array(
        'page_title'    => 'Google Settings',
        'menu_title'    => 'Google Settings',
        'menu_slug'     => 'google-credentials-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
}
