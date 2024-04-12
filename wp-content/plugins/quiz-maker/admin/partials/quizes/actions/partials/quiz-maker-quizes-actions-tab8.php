<div id="tab8" class="ays-quiz-tab-content <?php echo ($ays_quiz_tab == 'tab8') ? 'ays-quiz-tab-content-active' : ''; ?>">
    <p class="ays-subtitle"><?php echo __('Integrations settings',$this->plugin_name)?></p>
    <hr/>
    <fieldset>
        <legend>
            <img class="ays_integration_logo" src="<?php echo AYS_QUIZ_ADMIN_URL; ?>/images/integrations/mailchimp_logo.png" alt="">
            <h5><?php echo __('MailChimp Settings',$this->plugin_name)?></h5>
        </legend>
        <?php
            if(count($mailchimp) > 0):
        ?>
            <?php
                if($mailchimp_username == "" || $mailchimp_api_key == ""):
            ?>
            <blockquote class="error_message">
                <?php echo __(
                    sprintf(
                        "For enabling this option, please go to %s page and fill all options.",
                        "<a style='color:blue;text-decoration:underline;font-size:20px;' href='?page=$this->plugin_name-settings&ays_quiz_tab=tab2'>this</a>"
                    ),
                    $this->plugin_name );
                ?>
            </blockquote>
            <?php
                else:
            ?>
            <div class="form-group row">
                <div class="col-sm-4">
                    <label for="ays_enable_mailchimp">
                        <?php echo __('Enable MailChimp',$this->plugin_name)?>
                    </label>
                </div>
                <div class="col-sm-1">
                    <input type="checkbox" class="ays-enable-timer1" id="ays_enable_mailchimp"
                           name="ays_enable_mailchimp"
                           value="on"
                           <?php
                                if($mailchimp_username == "" || $mailchimp_api_key == ""){
                                    echo "disabled";
                                }else{
                                    echo ($enable_mailchimp == 'on') ? 'checked' : '';
                                }
                           ?>/>
                </div>
            </div>
            <hr>
            <div class="form-group row">
                <div class="col-sm-4">
                    <label for="ays_mailchimp_list">
                        <?php echo __('MailChimp list',$this->plugin_name)?>
                    </label>
                </div>
                <div class="col-sm-8">
                    <?php if(is_array($mailchimp_select)): ?>
                        <select name="ays_mailchimp_list" id="ays_mailchimp_list"
                           <?php
                                if($mailchimp_username == "" || $mailchimp_api_key == ""){
                                    echo 'disabled';
                                }
                            ?>>
                            <option value="" disabled selected>Select list</option>
                        <?php foreach($mailchimp_select as $mlist): ?>
                            <option <?php echo ($mailchimp_list == $mlist['listId']) ? 'selected' : ''; ?>
                                value="<?php echo $mlist['listId']; ?>"><?php echo $mlist['listName']; ?></option>
                        <?php endforeach; ?>
                        </select>
                    <?php else: ?>
                        <span><?php echo $mailchimp_select; ?></span>
                    <?php endif; ?>
                </div>
            </div>
            <?php
                endif;
            ?>
        <?php
            else:
        ?>
            <blockquote class="error_message">
                <?php echo __(
                    sprintf(
                        "For enabling this option, please go to %s page and fill all options.",
                        "<a style='color:blue;text-decoration:underline;font-size:20px;' href='?page=$this->plugin_name-settings&ays_quiz_tab=tab2'>this</a>"
                    ),
                    $this->plugin_name );
                ?>
            </blockquote>
        <?php
            endif;
        ?>
    </fieldset> <!-- MailChimp Settings -->
    <hr/>
    <fieldset>
        <legend>
            <img class="ays_integration_logo" src="<?php echo AYS_QUIZ_ADMIN_URL; ?>/images/integrations/campaignmonitor_logo.png" alt="">
            <h5><?php echo __('Campaign Monitor Settings', $this->plugin_name) ?></h5>
        </legend>
        <?php
        if (count($monitor) > 0):
            ?>
            <?php
            if ($monitor_client == "" || $monitor_api_key == ""):
                ?>
                <blockquote class="error_message">
                    <?php echo __(
                        sprintf(
                            "For enabling this option, please go to %s page and fill all options.",
                            "<a style='color:blue;text-decoration:underline;font-size:20px;' href='?page=$this->plugin_name-settings&ays_quiz_tab=tab2'>this</a>"
                        ),
                        $this->plugin_name);
                    ?>
                </blockquote>
            <?php
            else:
                ?>
                <hr/>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="ays_enable_monitor">
                            <?php echo __('Enable Campaign Monitor', $this->plugin_name) ?>
                        </label>
                    </div>
                    <div class="col-sm-1">
                        <input type="checkbox" class="ays-enable-timer1" id="ays_enable_monitor"
                               name="ays_enable_monitor"
                               value="on"
                            <?php
                            if ($monitor_client == "" || $monitor_api_key == "") {
                                echo "disabled";
                            } else {
                                echo ($enable_monitor == 'on') ? 'checked' : '';
                            }
                            ?>/>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="ays_monitor_list">
                            <?php echo __('Campaign Monitor list', $this->plugin_name) ?>
                        </label>
                    </div>
                    <div class="col-sm-8">
                        <?php if (is_array($monitor_select)): ?>
                            <select name="ays_monitor_list" id="ays_monitor_list"
                                <?php
                                if ($monitor_client == "" || $monitor_api_key == "") {
                                    echo 'disabled';
                                }
                                ?>>
                                <option value="" disabled selected><?= __("Select List", $this->plugin_name) ?></option>
                                <?php foreach ( $monitor_select as $mlist ): ?>
                                    <option <?= ($monitor_list == $mlist['ListID']) ? 'selected' : ''; ?>
                                            value="<?= $mlist['ListID']; ?>"><?php echo $mlist['Name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        <?php else: ?>
                            <span><?php echo $monitor_select; ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php
            endif;
            ?>
        <?php
        else:
            ?>
            <blockquote class="error_message">
                <?php echo __(
                    sprintf(
                        "For enabling this option, please go to %s page and fill all options.",
                        "<a style='color:blue;text-decoration:underline;font-size:20px;' href='?page=$this->plugin_name-settings&ays_quiz_tab=tab2'>this</a>"
                    ),
                    $this->plugin_name);
                ?>
            </blockquote>
        <?php
        endif;
        ?>
    </fieldset> <!-- Campaign Monitor Settings -->
    <hr/>
    <fieldset>
        <legend>
            <img class="ays_integration_logo" src="<?php echo AYS_QUIZ_ADMIN_URL; ?>/images/integrations/zapier_logo.png" alt="">
            <h5><?php echo __('Zapier Integration Settings', $this->plugin_name) ?></h5>
        </legend>
        <?php
        if (count($zapier) > 0):
            ?>
            <?php
            if ($zapier_hook == ""):
                ?>
                <blockquote class="error_message">
                    <?php echo __(
                        sprintf(
                            "For enabling this option, please go to %s page and fill all options.",
                            "<a style='color:blue;text-decoration:underline;font-size:20px;' href='?page=$this->plugin_name-settings&ays_quiz_tab=tab2'>this</a>"
                        ),
                        $this->plugin_name);
                    ?>
                </blockquote>
            <?php else: ?>
                <hr/>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="ays_enable_zapier">
                            <?php echo __('Enable Zapier Integration', $this->plugin_name) ?>
                        </label>
                    </div>
                    <div class="col-sm-1">
                        <input type="checkbox" class="ays-enable-timer1" id="ays_enable_zapier"
                               name="ays_enable_zapier"
                               value="on"
                            <?php
                            if ($zapier_hook == "") {
                                echo "disabled";
                            } else {
                                echo ($enable_zapier == 'on') ? 'checked' : '';
                            }
                            ?>/>
                    </div>
                    <div class="col-sm-3">
                        <button type="button"
                                data-url="<?= $zapier_hook ?>" <?= $zapier_hook ? "" : "disabled" ?>
                                id="testZapier"
                                class="btn btn-outline-secondary">
                            <?= __("Send test data", $this->plugin_name) ?>
                        </button>
                        <a class="ays_help" data-toggle="tooltip" style="font-size: 16px;"
                           title="<?= __('We will send you a test data, and you can catch it in your ZAP for configure it.', $this->plugin_name) ?>">
                            <i class="ays_fa ays_fa_info_circle"></i>
                        </a>
                    </div>
                </div>
                <div id="testZapierFields" class="d-none">
                    <input type="checkbox" name="zapierTest[]" value="ays_user_name" data-name="Name" checked/>
                    <input type="checkbox" name="zapierTest[]" value="ays_user_email" data-name="E-mail" checked/>
                    <input type="checkbox" name="zapierTest[]" value="ays_user_phone" data-name="Phone" checked/>
                    <?php
                    foreach ( $all_attributes as $attribute ) {
                        $checked = (in_array(strval($attribute['id']), $quiz_attributes)) ? 'checked' : '';
                        echo "<input type=\"checkbox\" name=\"zapierTest[]\" value=\"" . $attribute['slug'] . "\" data-name=\"".$attribute['name']."\" checked/>";
                    }
                    ?>
                </div>
            <?php endif; ?>
        <?php
        else:
            ?>
            <blockquote class="error_message">
                <?php echo __(
                    sprintf(
                        "For enabling this option, please go to %s page and fill all options.",
                        "<a style='color:blue;text-decoration:underline;font-size:20px;' href='?page=$this->plugin_name-settings&ays_quiz_tab=tab2'>this</a>"
                    ),
                    $this->plugin_name);
                ?>
            </blockquote>
        <?php
        endif;
        ?>
    </fieldset> <!-- Zapier Integration Settings -->
    <hr/>
    <fieldset>
        <legend>
            <img class="ays_integration_logo" src="<?php echo AYS_QUIZ_ADMIN_URL; ?>/images/integrations/activecampaign_logo.png" alt="">
            <h5><?php echo __('ActiveCampaign Settings', $this->plugin_name) ?></h5>
        </legend>
        <?php
        if (count($active_camp) > 0):
            ?>
            <?php
            if ($active_camp_url == "" || $active_camp_api_key == ""):
                ?>
                <blockquote class="error_message">
                    <?php echo __(
                        sprintf(
                            "For enabling this option, please go to %s page and fill all options.",
                            "<a style='color:blue;text-decoration:underline;font-size:20px;' href='?page=$this->plugin_name-settings&ays_quiz_tab=tab2'>this</a>"
                        ),
                        $this->plugin_name);
                    ?>
                </blockquote>
            <?php
            else:
                ?>
                <hr/>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="ays_enable_active_camp">
                            <?php echo __('Enable ActiveCampaign', $this->plugin_name) ?>
                        </label>
                    </div>
                    <div class="col-sm-1">
                        <input type="checkbox" class="ays-enable-timer1" id="ays_enable_active_camp"
                               name="ays_enable_active_camp"
                               value="on"
                            <?php
                            if ($active_camp_url == "" || $active_camp_api_key == "") {
                                echo "disabled";
                            } else {
                                echo ($enable_active_camp == 'on') ? 'checked' : '';
                            }
                            ?>/>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="ays_active_camp_list">
                            <?php echo __('ActiveCampaign list', $this->plugin_name) ?>
                        </label>
                    </div>
                    <div class="col-sm-8">
                        <?php if (is_array($active_camp_list_select)): ?>
                            <select name="ays_active_camp_list" id="ays_active_camp_list"
                                <?php
                                if ($active_camp_url == "" || $active_camp_api_key == "") {
                                    echo 'disabled';
                                }
                                ?>>
                                <option value="" disabled
                                        selected><?= __("Select List", $this->plugin_name) ?></option>
                                <option value=""><?= __("Just create contact", $this->plugin_name) ?></option>
                                <?php foreach ( $active_camp_list_select as $list ): ?>
                                    <option <?= ($active_camp_list == $list['id']) ? 'selected' : ''; ?>
                                            value="<?= $list['id']; ?>"><?= $list['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        <?php else: ?>
                            <span><?php echo $active_camp_list_select; ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="ays_active_camp_automation">
                            <?php echo __('ActiveCampaign automation', $this->plugin_name) ?>
                        </label>
                    </div>
                    <div class="col-sm-8">
                        <?php if (is_array($active_camp_automation_select)): ?>
                            <select name="ays_active_camp_automation" id="ays_active_camp_automation"
                                <?php
                                if ($active_camp_url == "" || $active_camp_api_key == "") {
                                    echo 'disabled';
                                }
                                ?>>
                                <option value="" disabled
                                        selected><?= __("Select List", $this->plugin_name) ?></option>
                                <option value=""><?= __("Just create contact", $this->plugin_name) ?></option>
                                <?php foreach ( $active_camp_automation_select as $automation ): ?>
                                    <option <?= ($active_camp_automation == $automation['id']) ? 'selected' : ''; ?>
                                            value="<?= $automation['id']; ?>"><?= $automation['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        <?php else: ?>
                            <span><?php echo $active_camp_automation_select; ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php
            endif;
            ?>
        <?php
        else:
            ?>
            <blockquote class="error_message">
                <?php echo __(
                    sprintf(
                        "For enabling this option, please go to %s page and fill all options.",
                        "<a style='color:blue;text-decoration:underline;font-size:20px;' href='?page=$this->plugin_name-settings&ays_quiz_tab=tab2'>this</a>"
                    ),
                    $this->plugin_name);
                ?>
            </blockquote>
        <?php
        endif;
        ?>
    </fieldset> <!-- ActiveCampaign Settings -->
    <hr/>
    <fieldset>
        <legend>
            <img class="ays_integration_logo" src="<?php echo AYS_QUIZ_ADMIN_URL; ?>/images/integrations/slack_logo.png" alt="">
            <h5><?php echo __('Slack Settings', $this->plugin_name) ?></h5>
        </legend>
        <?php
        if (count($slack) > 0):
            ?>
            <?php
            if ($slack_token == ""):
                ?>
                <blockquote class="error_message">
                    <?php echo __(
                        sprintf(
                            "For enabling this option, please go to %s page and fill all options.",
                            "<a style='color:blue;text-decoration:underline;font-size:20px;' href='?page=$this->plugin_name-settings&ays_quiz_tab=tab2'>this</a>"
                        ),
                        $this->plugin_name);
                    ?>
                </blockquote>
            <?php
            else:
                ?>
                <hr/>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="ays_enable_slack">
                            <?php echo __('Enable Slack integration', $this->plugin_name) ?>
                        </label>
                    </div>
                    <div class="col-sm-1">
                        <input type="checkbox" class="ays-enable-timer1" id="ays_enable_slack"
                               name="ays_enable_slack"
                               value="on"
                            <?php
                            if ($slack_token == "") {
                                echo "disabled";
                            } else {
                                echo ($enable_slack == 'on') ? 'checked' : '';
                            }
                            ?>/>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="ays_slack_conversation">
                            <?php echo __('Slack conversation', $this->plugin_name) ?>
                        </label>
                    </div>
                    <div class="col-sm-8">
                        <?php if (is_array($slack_select)): ?>
                            <select name="ays_slack_conversation" id="ays_slack_conversation"
                                <?php
                                if ($slack_token == "") {
                                    echo 'disabled';
                                }
                                ?>>
                                <option value="" disabled
                                        selected><?= __("Select Channel", $this->plugin_name) ?></option>
                                <?php foreach ( $slack_select as $conversation ): ?>
                                    <option <?= ($slack_conversation == $conversation['id']) ? 'selected' : ''; ?>
                                            value="<?= $conversation['id']; ?>"><?php echo $conversation['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        <?php else: ?>
                            <span><?php echo $slack_select; ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php
            endif;
            ?>
        <?php
        else:
            ?>
            <blockquote class="error_message">
                <?php echo __(
                    sprintf(
                        "For enabling this option, please go to %s page and fill all options.",
                        "<a style='color:blue;text-decoration:underline;font-size:20px;' href='?page=$this->plugin_name-settings&ays_quiz_tab=tab2'>this</a>"
                    ),
                    $this->plugin_name);
                ?>
            </blockquote>
        <?php
        endif;
        ?>
    </fieldset> <!-- Slack Settings -->
    <hr/>
    <fieldset>
        <legend>
            <img class="ays_integration_logo" src="<?php echo AYS_QUIZ_ADMIN_URL; ?>/images/integrations/sheets_logo.png" alt="">
            <h5><?php echo __('Google Sheet Settings', $this->plugin_name) ?></h5>
        </legend>
        <?php
        if (count($google) > 0):
            ?>
            <?php
            if ($google_token == ""):
                ?>
                <blockquote class="error_message">
                    <?php echo __(
                        sprintf(
                            "For enabling this option, please go to %s page and fill all options.",
                            "<a style='color:blue;text-decoration:underline;font-size:20px;' href='?page=$this->plugin_name-settings&ays_quiz_tab=tab2'>this</a>"
                        ),
                        $this->plugin_name);
                    ?>
                </blockquote>
            <?php
            else:
                ?>
                <hr/>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="ays_enable_google">
                            <?php echo __('Enable Google integration', $this->plugin_name) ?>
                        </label>
                    </div>
                    <div class="col-sm-1">
                        <input type="checkbox" class="ays-enable-timer1" id="ays_enable_google"
                               name="ays_enable_google"
                               value="on"
                            <?php
                            if ($google_token == "") {
                                echo "disabled";
                            } else {
                                echo ($enable_google_sheets == 'on') ? 'checked' : '';
                            }
                            ?>/>
                    </div>
                </div>
                <hr>
            <?php
            endif;
            ?>
        <?php
        else:
            ?>
            <blockquote class="error_message">
                <?php echo __(
                    sprintf(
                        "For enabling this option, please go to %s page and fill all options.",
                        "<a style='color:blue;text-decoration:underline;font-size:20px;' href='?page=$this->plugin_name-settings&ays_quiz_tab=tab2'>this</a>"
                    ),
                    $this->plugin_name);
                ?>
            </blockquote>
        <?php
        endif;
        ?>
    </fieldset> <!-- Google Sheets -->
</div>
