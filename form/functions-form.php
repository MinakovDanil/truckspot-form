<?php

/**
 * Enqueue scripts and styles.
 */

function form_scripts()
{
    if (is_page_template('form/template-form.php')) {

        // Styles
        wp_enqueue_style('normalize', get_template_directory_uri() . '/form/assets/css/normalize.min.css', array(), null, false);
        wp_enqueue_style('jquery-ui-style', '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.min.css', array(), null, false);
        wp_enqueue_style('select2-style', 'https://cdnjs.cloudflare.com/ajax/libs/select2/3.4.5/select2.min.css', array(), null, false);
        wp_enqueue_style('form-style', get_template_directory_uri() . '/form/assets/css/form.css', array(), null, false);


        // Scripts
        wp_enqueue_script('jquery');
        wp_enqueue_script('jquery-validate', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js', array(), null, true);
        wp_enqueue_script('jquery-ui', 'https://code.jquery.com/ui/1.12.1/jquery-ui.min.js', array(), null, true);
        wp_enqueue_script('select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/3.4.5/select2.min.js', array(), null, true);
        wp_enqueue_script('form-script', get_template_directory_uri() . '/form/assets/js/form.js', array('jquery'), null, true);
        wp_localize_script('form-script', 'ajax_call', array('ajaxurl' => admin_url('admin-ajax.php')));
    }
}
add_action('wp_enqueue_scripts', 'form_scripts');



/**
 * Carbon fields
 */
require get_template_directory() . '/form/inc/carbon-fields.php';


/**
 * register_post_types
 */
function register_post_types()
{
    // Leads
    register_post_type('leads', [
        'label'  => null,
        'labels' => [
            'name'               => 'Leads',
            'menu_name'          => 'Leads',
            'singular_name'      => 'Lead',
            'add_new'            => 'Add New',
            'add_new_item'       => 'Add New Lead',
            'edit_item'          => 'Edit Lead',
            'new_item'           => 'New Lead',
            'view_item'          => 'View Lead',
            'search_items'       => 'Search Leads',
            'not_found'          => 'No leads found',
            'not_found_in_trash' => 'No leads found in Trash',
            'parent_item_colon'  => 'Parent Leads:',
        ],
        'public'                  => false,
        'show_ui'                 => true,  // you should be able to edit it in wp-admin
        'exclude_from_search'     => true,  // you should exclude it from search results
        'show_in_menus'           => false,
        'menu_position'           => 21,
        'menu_icon'               => 'dashicons-businessperson',
        'has_archive'             => false,
        'rewrite'                 => false,
        'supports'                => ['title'],
    ]);
}
add_action('init', 'register_post_types');



// save utm to cookie
add_action('init', 'save_utm_to_cookie');
function save_utm_to_cookie()
{
    $day = 30;
    $date = time() + 3600 * 24 * $day;
    if (isset($_GET["utm_source"])) setcookie("utm_source", $_GET["utm_source"], $date, "/");
    if (isset($_GET["utm_medium"])) setcookie("utm_medium", $_GET["utm_medium"], $date, "/");
    if (isset($_GET["utm_campaign"])) setcookie("utm_campaign", $_GET["utm_campaign"], $date, "/");
    if (isset($_GET["utm_content"])) setcookie("utm_content", $_GET["utm_content"], $date, "/");
    if (isset($_GET["utm_term"])) setcookie("utm_term", $_GET["utm_term"], $date, "/");
    if (isset($_GET["sid"])) setcookie("sid", $_GET["sid"], $date, "/");
    if (isset($_GET["ssid"])) setcookie("ssid", $_GET["ssid"], $date, "/");
}


// fake data
add_action('wp_ajax_get_fake_data', 'get_fake_data');
add_action('wp_ajax_nopriv_get_fake_data', 'get_fake_data');
// search city
add_action('wp_ajax_search_city', 'search_city');
add_action('wp_ajax_nopriv_search_city', 'search_city');
// select model
add_action('wp_ajax_select_model', 'select_model');
add_action('wp_ajax_nopriv_select_model', 'select_model');
// check city
add_action('wp_ajax_check_city', 'check_city');
add_action('wp_ajax_nopriv_check_city', 'check_city');
// get data
add_action('wp_ajax_get_data', 'get_data');
add_action('wp_ajax_nopriv_get_data', 'get_data');
// leads to admin
add_action('wp_ajax_leads_to_admin', 'leads_to_admin');
add_action('wp_ajax_nopriv_leads_to_admin', 'leads_to_admin');



// search city
function search_city()
{
    global $wpdb;
    $wpdb->hide_errors();

    $zip_list = trim($_POST['zip_list']);
    $zip_list = strval($zip_list);
    $result_zip = '%' . $wpdb->esc_like($zip_list) . '%';

    $cities = $wpdb->get_results($wpdb->prepare("SELECT city, zip, state FROM us_cities WHERE city LIKE %s OR zip LIKE %s LIMIT 10", $result_zip, $result_zip), ARRAY_A);

    $result = [];

    foreach ($cities as $city) {
        $cityGluing = $city['zip'] . ' : ' . $city['city'] . ', ' . $city['state'];
        array_push($result, $cityGluing);
    }

    echo json_encode($result);

    wp_die();
}


// get years
function get_years()
{
    $today = date('Y');
    for ($i = $today; $i >= 1850; $i--) {
        echo "<option value='$i'>$i</option>";
    }
}

// get vehicles
function get_vehicles()
{
    global $wpdb;
    $wpdb->hide_errors();


    // Получаем марки транспорта из БД
    $vehicle_makes = $wpdb->get_results("SELECT make FROM vehicle_model_year WHERE NULLIF(model, '') IS NOT NULL GROUP BY make", ARRAY_A);

    // Получаем марки транспорта из админки
    $makes_admin = vehicle_make_from_admin();


    // Формируем массив 
    $makes = [];
    foreach ($vehicle_makes as $item) {
        array_push($makes, $item['make']);
    }

    // Объединяем массивы
    $result = array_merge($makes, $makes_admin);

    // Удаляем дубликаты (если есть)
    $result = array_unique($result);

    // Сортируем массив по алфавиту
    natcasesort($result);


    // Выводим марки
    foreach ($result as $make) { ?>
        <option value="<?php echo $make; ?>"><?php echo $make; ?></option>
    <?php }
}


// ajax select model
function select_model()
{
    global $wpdb;
    $wpdb->hide_errors();

    // Выбранная марка
    $selected_vehicle = trim($_POST['vehicle']);

    // Получаем модели данной марки из БД
    $vehicle_models = $wpdb->get_results("SELECT model FROM vehicle_model_year WHERE make = '$selected_vehicle' GROUP BY model", ARRAY_A);
    if (!$vehicle_models) {
        $vehicle_models = [];
    }

    // Формируем массив
    $result = [];
    foreach ($vehicle_models as $item) {
        array_push($result, $item['model']);
    }


    // Получаем модели транспорта из админки
    $models_admin = vehicle_model_from_admin();
    // Если данная марка присутствует в админке
    if (isset($models_admin[$selected_vehicle])) {
        // Перебераем все модели данной марки
        foreach ($models_admin[$selected_vehicle] as $item) {
            // Заносим в массив марку
            array_push($result, $item);
        }
    }

    // Удаляем дубликаты (если есть)
    $result = array_unique($result);

    // Сортируем массив по алфавиту
    natcasesort($result);

    // Выводим модели
    foreach ($result as $model) { ?>
        <option value="<?php echo $model; ?>"><?php echo $model; ?></option>
<?php }

    wp_die();
}


// Модели транспорта из админки
function vehicle_model_from_admin()
{
    // Получаем марки и модели транспорта из админки
    $vehicles_from_admin = carbon_get_theme_option('form_vehicles');

    // Если транспорта нет - возвращаем пустой массив
    if (!$vehicles_from_admin) {
        return [];
    }

    $models_admin = [];
    foreach ($vehicles_from_admin as $vehicle) {
        $models_admin[$vehicle['make']] = [];

        foreach ($vehicle['models'] as $vehicle_models) {
            array_push($models_admin[$vehicle['make']], $vehicle_models['model']);
        }
    }

    return $models_admin;
}



// Марки транспорта из админки
function vehicle_make_from_admin()
{
    // Получаем марки и модели транспорта из админки
    $vehicles_from_admin = carbon_get_theme_option('form_vehicles');

    // Если транспорта нет - возвращаем пустой массив
    if (!$vehicles_from_admin) {
        return [];
    }


    $makes_admin = [];
    foreach ($vehicles_from_admin as $vehicle) {
        // Добавляем марки в массив
        array_push($makes_admin, $vehicle['make']);
    }

    return $makes_admin;
}


// check city
function check_city()
{
    global $wpdb;
    $wpdb->hide_errors();

    $arrCity = $_POST['data'];

    $cityAndState = explode(', ', $arrCity[1]);


    $resiltCity = $wpdb->get_col("SELECT id FROM us_cities WHERE zip = $arrCity[0] AND city = '$cityAndState[0]' AND state = '$cityAndState[1]'");
    if ($resiltCity) {
        echo 1;
    } else {
        echo 0;
    }

    wp_die();
}


// get data
function get_data()
{
    $result['utm'] = false;
    $result['sid'] = false;


    // UTM
    $utmKeys = array('utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term', 'ssid');
    $utms = array();

    foreach ($utmKeys as $item) {
        if ($_COOKIE[$item]) {
            $utms[$item] = $_COOKIE[$item];
        }
    }

    if (!empty($utms)) {
        $result['utm'] = $utms;
    }

    // SID
    if ($_COOKIE['sid']) {
        $result['sid'] = $_COOKIE['sid'];

        if (carbon_get_theme_option('frm_correct_sid')) {
            $arrSids = array();

            // Перебераем допустимые SID
            foreach (carbon_get_theme_option('frm_correct_sid') as $item) {
                // Добавляем в массив каждый SID
                array_push($arrSids, $item['sid']);
            }

            // Поверяеем допустимые SID
            if (!in_array($_COOKIE['sid'], $arrSids)) {
                $result['sid'] = 'ER';
            }
        }
    }


    echo json_encode($result);


    wp_die();
}


// get fake phone
function get_fake_data()
{
    $result['fake_phone'] = carbon_get_theme_option('frm_fake_phone');
    $result['fake_email'] = carbon_get_theme_option('frm_fake_email');
    $result['last_phone'] = carbon_get_theme_option('frm_last_phone');

    echo json_encode($result);

    wp_die();
}



// leads to admin
function leads_to_admin()
{

    $leadData = $_POST['data'];

    $phone = str_replace(['+'], '', $leadData['phone1']);

    $my_post = array(
        'post_title' => sanitize_text_field($leadData['firstname'] . ' ' . $leadData['lastname']),
        'post_author'   => 1,
        'post_status'   => 'publish',
        'post_type' => 'leads',
    );
    $newpost_id = wp_insert_post($my_post);
    if ($newpost_id != 0) {
        // Main
        carbon_set_post_meta($newpost_id, 'lead_campid', $leadData['campid']);
        carbon_set_post_meta($newpost_id, 'lead_sid', $leadData['sid']);
        carbon_set_post_meta($newpost_id, 'lead_ssid', $leadData['ssid']);
        carbon_set_post_meta($newpost_id, 'lead_email', $leadData['email']);
        carbon_set_post_meta($newpost_id, 'lead_firstname', $leadData['firstname']);
        carbon_set_post_meta($newpost_id, 'lead_lastname', $leadData['lastname']);
        carbon_set_post_meta($newpost_id, 'lead_phone1', $phone);
        carbon_set_post_meta($newpost_id, 'lead_origincity', $leadData['origincity']);
        carbon_set_post_meta($newpost_id, 'lead_originstate', $leadData['originstate']);
        carbon_set_post_meta($newpost_id, 'lead_originzip', $leadData['originzip']);
        carbon_set_post_meta($newpost_id, 'lead_movedate', $leadData['movedate']);
        carbon_set_post_meta($newpost_id, 'lead_customer_notes', $leadData['customerNotes']);
        carbon_set_post_meta($newpost_id, 'lead_movingcity', $leadData['movingcity']);
        carbon_set_post_meta($newpost_id, 'lead_movingstate', $leadData['movingstate']);
        carbon_set_post_meta($newpost_id, 'lead_movingzip', $leadData['movingzip']);
        // Utm
        carbon_set_post_meta($newpost_id, 'lead_utm_source', $leadData['utm_source']);
        carbon_set_post_meta($newpost_id, 'lead_utm_medium', $leadData['utm_medium']);
        carbon_set_post_meta($newpost_id, 'lead_utm_campaign', $leadData['utm_campaign']);
        carbon_set_post_meta($newpost_id, 'lead_utm_content', $leadData['utm_content']);
        carbon_set_post_meta($newpost_id, 'lead_utm_term', $leadData['utm_term']);
        // Vehicle
        // 1
        carbon_set_post_meta($newpost_id, 'lead_vehicletype1', $leadData['vehicletype1']);
        carbon_set_post_meta($newpost_id, 'lead_vehiclemake1', $leadData['vehiclemake1']);
        carbon_set_post_meta($newpost_id, 'lead_vehiclemodel1', $leadData['vehiclemodel1']);
        carbon_set_post_meta($newpost_id, 'lead_vehicleyear1', $leadData['vehicleyear1']);
        carbon_set_post_meta($newpost_id, 'lead_trailertype1', $leadData['trailertype1']);
        carbon_set_post_meta($newpost_id, 'lead_doesnotrun1', $leadData['doesnotrun1']);
        carbon_set_post_meta($newpost_id, 'lead_modifed1', $leadData['modifed1']);
        carbon_set_post_meta($newpost_id, 'lead_istrailer1', $leadData['istrailer1']);
        carbon_set_post_meta($newpost_id, 'lead_length1', $leadData['length1']);
        carbon_set_post_meta($newpost_id, 'lead_width1', $leadData['width1']);
        carbon_set_post_meta($newpost_id, 'lead_height1', $leadData['height1']);
        carbon_set_post_meta($newpost_id, 'lead_weigth1', $leadData['weigth1']);

        // 2,3,4,5,6
        for ($i = 2; $i < 7; $i++) {
            if ($leadData['vehicletype' . $i]) {
                carbon_set_post_meta($newpost_id, 'lead_vehicletype' . $i, $leadData['vehicletype' . $i]);
                carbon_set_post_meta($newpost_id, 'lead_vehiclemake' . $i, $leadData['vehiclemake' . $i]);
                carbon_set_post_meta($newpost_id, 'lead_vehiclemodel' . $i, $leadData['vehiclemodel' . $i]);
                carbon_set_post_meta($newpost_id, 'lead_vehicleyear' . $i, $leadData['vehicleyear' . $i]);
                carbon_set_post_meta($newpost_id, 'lead_trailertype' . $i, $leadData['trailertype' . $i]);
                carbon_set_post_meta($newpost_id, 'lead_doesnotrun' . $i, $leadData['doesnotrun' . $i]);
                carbon_set_post_meta($newpost_id, 'lead_modifed' . $i, $leadData['modifed' . $i]);
                carbon_set_post_meta($newpost_id, 'lead_istrailer' . $i, $leadData['istrailer' . $i]);
                carbon_set_post_meta($newpost_id, 'lead_length' . $i, $leadData['length' . $i]);
                carbon_set_post_meta($newpost_id, 'lead_width' . $i, $leadData['width' . $i]);
                carbon_set_post_meta($newpost_id, 'lead_height' . $i, $leadData['height' . $i]);
                carbon_set_post_meta($newpost_id, 'lead_weigth' . $i, $leadData['weigth' . $i]);
            }
        }
    }

    wp_die();
}
