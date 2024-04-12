<?php
$action = (isset($_GET['action'])) ? sanitize_text_field( $_GET['action'] ) : '';
$heading = '';
$id = ( isset( $_GET['quiz_category'] ) ) ? absint( intval( $_GET['quiz_category'] ) ) : null;
$options = array(

);
$quiz_category = array(
    'id'            => '',
    'title'         => '',
    'description'   => '',
    'published'     => '1',
    'options'       => json_encode($options),
);
switch( $action ) {
    case 'add':
        $heading = __('Add new category', $this->plugin_name);
        break;
    case 'edit':
        $heading = __('Edit category', $this->plugin_name);
        $quiz_category = $this->quiz_categories_obj->get_quiz_category( $id );
        break;
}

$options = isset($quiz_category['options']) && $quiz_category['options'] != '' ? json_decode($quiz_category['options'], true) : array();
$title = isset($quiz_category['title']) && $quiz_category['title'] != '' ? stripslashes( htmlentities( $quiz_category['title'], ENT_QUOTES ) ) : '';

if( isset( $_POST['ays_submit'] ) ) {
    $_POST['id'] = $id;
    $result = $this->quiz_categories_obj->add_edit_quiz_category( $_POST );
}
if(isset($_POST['ays_apply'])){
    $_POST["id"] = $id;
    $_POST['ays_change_type'] = 'apply';
    $this->quiz_categories_obj->add_edit_quiz_category($_POST);
}
?>
<div class="wrap">
    <div class="container-fluid">
        <h1><?php echo $heading; ?></h1>
        <div>
            <?php if($id !== null): ?>
            <div class="row">
                <div class="col-sm-3">
                    <label> <?php echo __( "Shortcode text for editor", $this->plugin_name ); ?> </label>
                </div>
                <div class="col-sm-9">
                    <p style="font-size:14px; font-style:italic;">
                        <?php echo __("To insert the Quiz category into a page, post or text widget, copy shortcode", $this->plugin_name); ?>
                        <strong onClick="selectElementContents(this)" style="font-size:16px; font-style:normal;"><?php echo "[ays_quiz_cat id='".$id."' display='all/random' count='5']"; ?></strong>
                        <?php echo " " . __( "and paste it at the desired place in the editor.", $this->plugin_name); ?><br>
                        <?php echo __( "The count attribute is required for random view type.", $this->plugin_name); ?>
                    </p>
                </div>
            </div>
            <?php endif;?>
        </div>
        <hr/>
        <form class="ays-quiz-category-form" id="ays-quiz-category-form" method="post">
            <div class="form-group row">
                <div class="col-sm-2">
                    <label for='ays-title'>
                        <?php echo __('Title', $this->plugin_name); ?>
                        <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Title of the category',$this->plugin_name)?>">
                            <i class="ays_fa ays_fa_info_circle"></i>
                        </a>
                    </label>
                </div>
                <div class="col-sm-10">
                    <input class='ays-text-input' id='ays-title' name='ays_title' required type='text' value='<?php echo $title; ?>'>
                </div>
            </div>

            <hr/>
            <div class='ays-field-dashboard'>
                <label for='ays-description'>
                    <?php echo __('Description', $this->plugin_name); ?>
                    <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Provide more information about the quiz category',$this->plugin_name)?>">
                        <i class="ays_fa ays_fa_info_circle"></i>
                    </a>
                </label>
                <?php
                $content = stripslashes(wpautop($quiz_category['description']));
                $editor_id = 'ays-quiz-description';
                $settings = array(
                    'editor_height' => '6',
                    'textarea_name' => 'ays_description',
                    'editor_class' => 'ays-textarea'
                );
                wp_editor($content,$editor_id,$settings);
                ?>
            </div>

            <hr/>
            <div class="form-group row">
                <div class="col-sm-2">
                    <label>
                        <?php echo __('Category status', $this->plugin_name); ?>
                        <a class="ays_help" data-toggle="tooltip" title="<?php echo __('Choose whether the quiz category is active or not. If you choose Unpublished option, the quiz category won’t be shown anywhere on your website.',$this->plugin_name)?>">
                            <i class="ays_fa ays_fa_info_circle"></i>
                        </a>
                    </label>
                </div>

                <div class="col-sm-3">
                    <div class="form-check form-check-inline">
                        <input type="radio" id="ays-publish" name="ays_publish" value="1" <?php echo ( $quiz_category['published'] == '1') ? 'checked' : ''; ?> />
                        <label class="form-check-label" for="ays-publish"> <?php echo __('Published', $this->plugin_name); ?> </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" id="ays-unpublish" name="ays_publish" value="0" <?php echo ( $quiz_category['published']  == '0' ) ? 'checked' : ''; ?> />
                        <label class="form-check-label" for="ays-unpublish"> <?php echo __('Unpublished', $this->plugin_name); ?> </label>
                    </div>
                </div>
            </div>

            <hr/>
            <?php
            wp_nonce_field('quiz_category_action', 'quiz_category_action');
            $other_attributes = array( 'id' => 'ays-button' );
            submit_button( __( 'Save and close', $this->plugin_name ), 'primary', 'ays_submit', true, $other_attributes );
            submit_button( __( 'Save', $this->plugin_name), '', 'ays_apply', true, $other_attributes);
            ?>
        </form>
    </div>
</div>
