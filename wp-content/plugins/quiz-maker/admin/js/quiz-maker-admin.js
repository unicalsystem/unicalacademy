(function ($) {
    'use strict';
    $(document).ready(function () {
        // Notifications dismiss button
        $(document).on('click', '.notice-dismiss', function (e) {
            changeCurrentUrl('status');
        });

        if(location.href.indexOf('del_stat')){
            setTimeout(function(){
                changeCurrentUrl('del_stat');
                changeCurrentUrl('mcount');
            }, 500);
        }

        function changeCurrentUrl(key){
            var linkModified = location.href.split('?')[1].split('&');
            for(var i = 0; i < linkModified.length; i++){
                if(linkModified[i].split("=")[0] == key){
                    linkModified.splice(i, 1);
                }
            }
            linkModified = linkModified.join('&');
            window.history.replaceState({}, document.title, '?'+linkModified);
        }

        // Quiz toast close button
        jQuery('.quiz_toast__close').click(function(e){
            e.preventDefault();
            var parent = $(this).parent('.quiz_toast');
            parent.fadeOut("slow", function() { $(this).remove(); } );
        });
        
        var toggle_ddmenu = $(document).find('.toggle_ddmenu');
        toggle_ddmenu.on('click', function () {
            var ddmenu = $(this).next();
            var state = ddmenu.attr('data-expanded');
            switch (state) {
                case 'true':
                    $(this).find('.ays_fa').css({
                        transform: 'rotate(0deg)'
                    });
                    ddmenu.attr('data-expanded', 'false');
                    break;
                case 'false':
                    $(this).find('.ays_fa').css({
                        transform: 'rotate(90deg)'
                    });
                    ddmenu.attr('data-expanded', 'true');
                    break;
            }
        });
        
        $('[data-toggle="popover"]').popover();
        $('[data-toggle="tooltip"]').tooltip();
        
        // Disabling submit when press enter button on inputing
        $(document).on("input", 'input', function(e){
            if(e.keyCode == 13){
                if($(document).find("#ays-question-form").length !== 0 ||
                   $(document).find("#ays-quiz-category-form").length !== 0 ||
                   $(document).find("#ays-quiz-settings-form").length !== 0){
                    return false;
                }
            }
        });
        
        $(document).on("keydown", function(e){
            if(e.target.nodeName == "TEXTAREA"){
                return true;
            }
            if(e.keyCode == 13){
                if($(document).find("#ays-question-form").length !== 0 ||
                   $(document).find("#ays-quiz-category-form").length !== 0 ||
                   $(document).find("#ays-quiz-settings-form").length !== 0){
                    return false;
                }
            }
            if(e.keyCode === 27){
                $(document).find('.ays-modal').aysModal('hide');
                return false;
            }
        });
        
        
        // Dashboard page
        // start
        var heart_interval = setInterval(function () {
            $('div.ays-quiz-maker-wrapper h1 i.ays_fa').toggleClass('pulse');
            $(document).find('.ays_heart_beat i.ays_fa').toggleClass('ays_pulse');
        }, 1000);


        var appearanceTime = 200,
            appearanceEffects = ['fadeInLeft', 'fadeInRight'];        
        $(document).find('div.ays-quiz-card').each(function (index) {
            var card = $(this);
            setTimeout(function () {
                card.addClass('ays-quiz-card-show' + ' ' + appearanceEffects[index % 2]);
            }, appearanceTime);
            appearanceTime += 200;
        });
        
        // end
        
        
        $(document).find('#ays-quiz-title').on('input', function(e){
            $(document).find('.ays_quiz_title_in_top').html($(this).val());
        });
        
        if($(document).find('.ays-top-menu').width() <= $(document).find('div.ays-top-tab-wrapper').width()){
            $(document).find('.ays_menu_left').css('display', 'flex');
            $(document).find('.ays_menu_right').css('display', 'flex');
        }
        $(window).resize(function(){
            if($(document).find('.ays-top-menu').width() < $(document).find('div.ays-top-tab-wrapper').width()){
                $(document).find('.ays_menu_left').css('display', 'flex');
                $(document).find('.ays_menu_right').css('display', 'flex');
            }else{
                $(document).find('.ays_menu_left').css('display', 'none');
                $(document).find('.ays_menu_right').css('display', 'none');
                $(document).find('div.ays-top-tab-wrapper').css('transform', 'translate(0px)');
            }
        });
        var menuItemWidths0 = [];
        var menuItemWidths = [];
        $(document).find('.ays-top-tab-wrapper .nav-tab').each(function(){
            var $this = $(this);
            menuItemWidths0.push($this.outerWidth());
        });

        for(var i = 0; i < menuItemWidths0.length; i+=2){
            if(menuItemWidths0.length <= i+1){
                menuItemWidths.push(menuItemWidths0[i]);
            }else{
                menuItemWidths.push(menuItemWidths0[i]+menuItemWidths0[i+1]);
            }
        }
        var menuItemWidth = 0;
        for(var i = 0; i < menuItemWidths.length; i++){
            menuItemWidth += menuItemWidths[i];
        }
        menuItemWidth = menuItemWidth / menuItemWidths.length;

        $(document).on('click', '.ays_menu_left', function(){
            var scroll = parseInt($(this).attr('data-scroll'));
            scroll -= menuItemWidth;
            if(scroll < 0){
                scroll = 0;
            }
            $(document).find('div.ays-top-tab-wrapper').css('transform', 'translate(-'+scroll+'px)');
            $(this).attr('data-scroll', scroll);
            $(document).find('.ays_menu_right').attr('data-scroll', scroll);
        });
        $(document).on('click', '.ays_menu_right', function(){
            var scroll = parseInt($(this).attr('data-scroll'));
            var howTranslate = $(document).find('div.ays-top-tab-wrapper').width() - $(document).find('.ays-top-menu').width();
            howTranslate += 7;
            if(scroll == -1){
                scroll = menuItemWidth;
            }
            scroll += menuItemWidth;
            if(scroll > howTranslate){
                scroll = Math.abs(howTranslate);
            }
            $(document).find('div.ays-top-tab-wrapper').css('transform', 'translate(-'+scroll+'px)');
            $(this).attr('data-scroll', scroll);
            $(document).find('.ays_menu_left').attr('data-scroll', scroll);
        });
        

//        if($(document).find('.checkbox_carousel_body').width() >= $(document).find('div.checkbox_carousel').width()){
//            $(document).find('.cb_carousel_arrows').css('display', 'block');
//            $(document).find('div.checkbox_carousel').each(function(){
//                $(this).attr('data-scroll-width', this.scrollWidth);
//            });
//        }
        $(document).on('click', '.cb_carousel_left', function(){
            var howTranslate = ($(document).find('div.checkbox_carousel').width() * 25) / 100;
            var currentTranslate = parseInt($(this).parents('.checkbox_carousel').find('.checkbox_carousel_body').css('transform').split(',')[4]);
            if(currentTranslate == NaN){
                currentTranslate = 0;
            }
            if(currentTranslate < 0){
                howTranslate = howTranslate + currentTranslate;
            }else{
                howTranslate = howTranslate + -currentTranslate;
            }
            if(howTranslate > 0){
                howTranslate = 0;
            }
            $(this).parents('.checkbox_carousel').find('.checkbox_carousel_body').css('transform', 'translateX('+howTranslate+'px)');
        });
        
        $(document).on('click', '.cb_carousel_right', function(){
            var howTranslate = ($(document).find('div.checkbox_carousel').width() * 25) / 100;
            var currentTranslate = parseInt($(this).parents('.checkbox_carousel').find('.checkbox_carousel_body').css('transform').split(',')[4]);
            if(currentTranslate < 0){
                howTranslate = howTranslate + -currentTranslate;
            }else{
                howTranslate = howTranslate + currentTranslate;
            }
            
            if(parseInt($(this).parents('.checkbox_carousel')[0].scrollWidth) - parseInt($(this).parents('.checkbox_carousel').width()) < Math.abs(howTranslate)){
                howTranslate = parseInt($(this).parents('.checkbox_carousel').data('scrollWidth') - parseInt($(this).parents('.checkbox_carousel').width()) + 2);
            }
            $(this).parents('.checkbox_carousel').find('.checkbox_carousel_body').css('transform', 'translateX(-'+howTranslate+'px)');
        });
        
//        $(document).find('#ays_enable_paypal').on('change', function(){
//            if($(this).prop('checked') == true){
//                if($(document).find('#ays_enable_logged_users').attr('checked') != 'checked'){
//                    $(document).find('#ays_enable_logged_users').trigger('click');
////                    $(document).find('#ays_enable_logged_users').attr('checked', 'checked');
//                    if($(document).find('#ays_logged_in_message').val() == ''){
//                        $(document).find('#ays_logged_in_message').html('You need to log in to pass this quiz.');
//                    }
//                }
//                $(document).find('#ays_enable_logged_users').attr('disabled', 'disabled');
//            }else{
//                $(document).find('#ays_enable_logged_users').removeAttr('disabled');
//            }
//        });
//        if($(document).find('#ays_enable_paypal').prop('checked') == true){
//            if($(document).find('#ays_enable_logged_users').attr('checked') != 'checked'){
//                $(document).find('#ays_enable_logged_users').trigger('click');
//                $(document).find('#ays_enable_logged_users').attr('checked', 'checked');
//                if($(document).find('#ays_logged_in_message').val() == ''){
//                    $(document).find('#ays_logged_in_message').html('You need to log in to pass this quiz.');
//                }
//            }
//            setTimeout(function(){
//                $(document).find('#ays_enable_logged_users').attr('disabled', 'disabled');
//            }, 1);
//        }else{
//            $(document).find('#ays_enable_logged_users').removeAttr('disabled');
//        }
        

        $(document).on('change', '.ays_toggle_checkbox', function (e) {
            var state = $(this).prop('checked');
            var parent = $(this).parents('.ays_toggle_parent');
            
            if($(this).hasClass('ays_toggle_slide')){
                switch (state) {
                    case true:
                        parent.find('.ays_toggle_target').slideDown(250);
                        break;
                    case false:
                        parent.find('.ays_toggle_target').slideUp(250);
                        break;
                }
            }else{
                switch (state) {
                    case true:
                        parent.find('.ays_toggle_target').show(250);
                        break;
                    case false:
                        parent.find('.ays_toggle_target').hide(250);
                        break;
                }
            }
        });
        
        $(document).on('change', '.ays_toggle_select', function (e) {
            var state = $(this).val();
            var toggle = $(this).data('hide');
            var parent = $(this).parents('.ays_toggle_parent');
            
            if($(this).hasClass('ays_toggle_slide')){
                if (toggle == state) {
                    parent.find('.ays_toggle_target').slideUp(250);
                    parent.find('.ays_toggle_target_inverse').slideDown(150);
                }else{
                    parent.find('.ays_toggle_target').slideDown(150);
                    parent.find('.ays_toggle_target_inverse').slideUp(250);
                }
            }else{
                if (toggle == state) {
                    parent.find('.ays_toggle_target').hide(150);
                    parent.find('.ays_toggle_target_inverse').show(250);
                }else{
                    parent.find('.ays_toggle_target').show(250);
                    parent.find('.ays_toggle_target_inverse').hide(150);
                }
            }
        });

        $(document).on('click', '.ays_toggle_radio', function (e) {
            var dataFlag = $(this).attr('data-flag');
            var state = false;
            if (dataFlag == 'true') {
                state = true;
            }
            var parent = $(this).parents('.ays_toggle_parent');
            if($(this).hasClass('ays_toggle_slide')){
                switch (state) {
                    case true:
                        parent.find('.ays_toggle_target').slideDown(250);
                        break;
                    case false:
                        parent.find('.ays_toggle_target').slideUp(250);
                        break;
                }
            }else{
                switch (state) {
                    case true:
                        parent.find('.ays_toggle_target').show(250);
                        break;
                    case false:
                        parent.find('.ays_toggle_target').hide(250);
                        break;
                }
            }
        });

//        var minMaxInps = $(document).find('.interval_max,.interval_min');
//        if(minMaxInps.hasClass("ays_point_by")){
//            minMaxInps.prop("type" , "text");
//        }
//        $(document).find('.ays_point_count').on("click" , function(){
//            minMaxInps.prop("type" , "text");
//        });
//        $(document).find(".ays_perc_count").on("click" , function(){
//            minMaxInps.removeClass('ays_point_by');
//            minMaxInps.prop("type" , "number");
//        });
//
//        $(document).find('#ays_quiz_show_timer').change(function () {
//            if ($(this).prop('checked')) {
//                $('.ays_show_time').show(250);
//            } else {
//                $('.ays_show_time').hide(250);
//            }
//        });

        var minMaxInps = $(document).find('.interval_max,.interval_min');
        if(minMaxInps.hasClass("ays_point_by")){
            minMaxInps.prop("type" , "text");
        }

        $(document).find('.ays_intervals_display_by').on("click" , function(){
            var interval_by = $(this).val();
            var minMaxInps = $(document).find('.interval_max,.interval_min');
            switch(interval_by){
                case 'by_percentage':
                    minMaxInps.removeClass('ays_point_by');
                    minMaxInps.prop("type" , "number");
                    $(document).find('.ays-intervals-table .ays_keywords_row').addClass('display_none').hide();
                    $(document).find('.ays-intervals-table .ays_interval_max_row, .ays-intervals-table .ays_interval_min_row').removeClass('display_none').show();
                    break;
                case 'by_points':
                    minMaxInps.prop("type" , "text");
                    $(document).find('.ays-intervals-table .ays_keywords_row').addClass('display_none').hide();
                    $(document).find('.ays-intervals-table .ays_interval_max_row, .ays-intervals-table .ays_interval_min_row').removeClass('display_none').show();
                    break;
                case 'by_keywords':
                    minMaxInps.removeClass('ays_point_by');
                    minMaxInps.prop("type" , "number");
                    $(document).find('.ays-intervals-table .ays_keywords_row').removeClass('display_none').show();
                    $(document).find('.ays-intervals-table .ays_interval_max_row, .ays-intervals-table .ays_interval_min_row').addClass('display_none').hide();
                    break;
                default:
                    minMaxInps.removeClass('ays_point_by');
                    minMaxInps.prop("type" , "number");
                    $(document).find('.ays-intervals-table .ays_keywords_row').addClass('display_none').hide();
                    $(document).find('.ays-intervals-table .ays_interval_max_row, .ays-intervals-table .ays_interval_min_row').removeClass('display_none').show();
            }

        });
                    
        
        $(document).find('.checkbox_carousel_body input[type="checkbox"]').on('change', function(e){
            if($(this).prop('checked') == true){
                $(document).find('#'+$(this).attr('id')+'_required').removeAttr('disabled');
            }else{
                $(document).find('#'+$(this).attr('id')+'_required').attr('disabled', 'disabled');
                $(document).find('#'+$(this).attr('id')+'_required').removeAttr('checked');
            }
        });

        $(document).find('.checkbox_carousel_body input[type="checkbox"]').each(function(e){
            if($(this).prop('checked') == true){
                $(document).find('#'+$(this).attr('id')+'_required').removeAttr('disabled');
            }else{
                $(document).find('#'+$(this).attr('id')+'_required').attr('disabled', 'disabled');
                $(document).find('#'+$(this).attr('id')+'_required').removeAttr('checked');
            }
        });

        $(document).find('#form_available_fields').sortable({
            cursor: 'move',
			opacity: 0.8,
            tolerance: "pointer",
            helper: "clone",
            placeholder: "sortable_placeholder",
            connectWith: ".checkbox_carousel_body",
            revert: true,
            forcePlaceholderSize: true,
            forceHelperSize: true,
            containment: ".checkbox_carousel",
            receive: function(event, ui) {
                var item = ui.item;
                var $default_attributes = ["ays_form_name","ays_form_email","ays_form_phone"];
                item.find('.custom_field_required').addClass('display_none');
                item.removeClass('ui-state-highlight').addClass('ui-state-default');
                item.find('input[name="ays_quiz_attributes[]"]').attr('name', 'ays_quiz_attributes_passive[]');
                for(var i=0; i < $default_attributes.length; i++){
                    item.find('input[name="'+$default_attributes[i]+'"]').val('off');
                }
            }
        });

        $(document).find('#form_fields').sortable({
            cursor: 'move',
			opacity: 0.8,
            tolerance: "pointer",
            helper: "clone",
            placeholder: "sortable_placeholder",
            connectWith: ".checkbox_carousel_body",
            revert: true,
            forcePlaceholderSize: true,
            forceHelperSize: true,
            containment: ".checkbox_carousel",
            receive: function(event, ui) {
                var item = ui.item;
                var $default_attributes = ["ays_form_name","ays_form_email","ays_form_phone"];
                item.find('.custom_field_required').removeClass('display_none');
                item.removeClass('ui-state-default').addClass('ui-state-highlight');
                item.find('input[name="ays_quiz_attributes_passive[]"]').attr('name', 'ays_quiz_attributes[]');
                for(var i=0; i < $default_attributes.length; i++){
                    item.find('input[name="'+$default_attributes[i]+'"]').val('on');
                }
            }
        });

        var ays_results = $(document).find('.ays_result_read, .ays_quiz_results_unreads');
        for (var i in ays_results) {
            if (typeof ays_results.eq(i).val() != 'undefined') {
                if (ays_results.eq(i).val() == 0) {
                    ays_results.eq(i).parents('tr').addClass('ays_read_result');
                }
            }
        }
        var ays_quiz_results = $(document).find('.ays-show-results');
        for (var i in ays_quiz_results) {
            ays_quiz_results.eq(i).parents('tr').addClass('ays_quiz_read_result');
        }

        $(document).find('#ays-category').select2({
            placeholder: 'Select category'
        });

        $(document).find('#ays_user_roles').select2({
            placeholder: 'Select role'
        });

        
//        $(document).find('.interval_wproduct').select2({
//            placeholder: 'Select a product',
//            allowClear: true,
//            templateResult: ays_formatState
//        });
        
        function ays_formatState (ays_state) {
            if(!ays_state.id) {
                return ays_state.text;
            }
            var baseUrl = $(ays_state.element).data('nkar');
            if(baseUrl != ''){
                var ays_state = $(
                    '<span><img src=' + baseUrl + ' class=\'ays_prod_image\' /> ' + ays_state.text + '</span>'
                );
            }else{
                var ays_state = $(
                    '<span>' + ays_state.text + '</span>'
                );
            }
            return ays_state;
        }

        $(document).find('b[role="presentation"]').removeClass('ays_fa ays_fa_chevron_down');
        
        $(document).find('.ays-field .select2-container').on("click", function () {
            if ($(this).hasClass('select2-container--open')) {
                $(this).find('b[role="presentation"]').removeClass('ays_fa ays_fa_chevron_down');
                $(this).find('b[role="presentation"]').addClass('ays_fa ays_fa_chevron_up');
            } else {
                $(this).find('b[role="presentation"]').removeClass('ays_fa ays_fa_chevron_up');
                $(this).find('b[role="presentation"]').addClass('ays_fa ays_fa_chevron_down');
            }
        });

        // Initialize sortable
        $(document).find('table.ays-answers-table tbody').sortable({
            handle: '.ays_fa_arrows',
            cursor: 'move',
			opacity: 0.8,
			placeholder: 'clone',
            update: function (event, ui) {
                var className = ui.item.attr('class').split(' ')[0];
                $('table.ays-answers-table tbody').find('tr.'+className).each(function (index) {
                    var newValue = index + 1,
                        classEven = (((index + 1) % 2) === 0) ? 'even' : '';
                    if ($(this).hasClass('even')) {
                        $(this).removeClass('even');
                    }
                    $(this).addClass(classEven);
                    $(this).find('.ays-correct-answer').val(newValue);
                });
            }
        });

        $(document).find('table.ays-questions-table tbody').sortable({
            handle: 'td.ays-sort',
            cursor: 'move',
			opacity: 0.8,
			placeholder: 'clone',
            update: function (event, ui) {
                var className = ui.item.attr('class').split(' ')[0];
                var sorting_ids = [];
                $(document).find('tr.' + className).each(function (index) {
                    var classEven = (((index + 1) % 2) === 0) ? 'even' : '';
                    if ($(this).hasClass('even')) {
                        $(this).removeClass('even');
                    }
                    sorting_ids.push($(this).data('id'));
                    $(this).addClass(classEven);
                });
                $(document).find('input#ays_already_added_questions').val(sorting_ids);
            }
        });

        $(document).find('table.ays-intervals-table tbody').sortable({
            handle: 'td.ays-sort',
            cursor: 'move',
			opacity: 0.8,
			placeholder: 'clone',
            update: function (event, ui) {
                var className = ui.item.attr('class').split(' ')[0];
                $(document).find('tr.' + className).each(function (index) {
                    var classEven = (((index + 1) % 2) === 0) ? 'even' : '';
                    if ($(this).hasClass('even')) {
                        $(this).removeClass('even');
                    }
                    $(this).addClass(classEven);
                });
            }
        });

        //Aro User page settings table
        $(document).find('.ays-show-user-page-table').sortable({
            cursor: 'move',
            opacity: 0.8,
            tolerance: "pointer",
            helper: "clone",
            placeholder: "ays_user_page_sortable_placeholder",
            revert: true,
            forcePlaceholderSize: true,
            forceHelperSize: true,
        });


        $('.interval_max').on('input', function () {
            var this_max = $(this);
            var next_min_input = $(this).parents().eq(1).next().find('.interval_min');
            if (next_min_input) next_min_input.val(parseInt(this_max.val()) + 1);
        });
        
        $('.interval_max,.interval_min').on('change', function () {
            var this_value = parseInt($(this).val());
            var prev_min_input = parseInt($(this).parents().eq(1).prev().find('.interval_min').val());
            var prev_max_input = parseInt($(this).parents().eq(1).prev().find('.interval_max').val());

            if (this_value <= prev_min_input || this_value <= prev_max_input) {
                alert('Your value must be bigger than ' + prev_min_input + ' or ' + prev_max_input);
            }
        });
        
        $('.ays-add-interval').on('click', function () {
            var intervals_table = $('.ays-intervals-table'),
                row_count = intervals_table.children('tbody').children('tr').length,
                className = ((row_count % 2) === 0) ? "" : "even",
                isWoo = intervals_table.hasClass('with-woo-product'),
                wooSelect = isWoo ? intervals_table.find(".interval_wproduct").eq(0).parent().clone(true).prop("outerHTML") : "";
            var wooOptions = "";
            var intervalsDisplayBy = $(document).find('.ays_intervals_display_by[name="ays_display_score_by"]:checked').val();
            var intervalsKeyword = 'display_none';
            var intervalsMinMax = '';
            if (intervalsDisplayBy == 'by_keywords') {
                intervalsKeyword = '';
                intervalsMinMax = 'display_none';
            }
            var simbolsArr = aysGenCharArray( "A", "F" );
            var intervalsOptionHTML = '';
            for (var i = 0; i < simbolsArr.length; i++) {
                intervalsOptionHTML += '<option value="'+ simbolsArr[i] +'">'+ simbolsArr[i] +'</option>';
            }

            var intervalsHTML = '';
            intervalsHTML +=
                "<td class='ays_interval_min_row "+ intervalsMinMax +"'><input type='number' name='interval_min[]' class='interval_min'></td>" +
                "<td class='ays_interval_max_row "+ intervalsMinMax +"'><input type='number' name='interval_max[]' class='interval_max'></td>" +
                "<td class='ays_keywords_row "+ intervalsKeyword +"'>" +
                "   <select name='interval_keyword[]' class='ays_quiz_keywords'>" +
                        intervalsOptionHTML +
                "   </select>" +
                "</td>";

            if(isWoo){
                wooSelect = "<td>" +
                    "<select  name='interval_wproduct[]' class='interval_wproduct'>" +
                        "<option></option>" +
                    "</select>" +
                "</td>";
            }
            intervals_table.append("<tr class=\"ays-interval-row ui-state-default " + className + " \">\n" +
                "   <td class=\"ays-sort\"><i class=\"ays_fa ays_fa_arrows\" aria-hidden=\"true\"></i></td>\n" +
                intervalsHTML +
                "   <td><textarea name=\"interval_text[]\" class=\"interval_text\"></textarea></td>\n" +
                wooSelect +
                "   <td class=\"ays-interval-image-td\">\n" +
                "       <label class='ays-label' for='ays-answer'><a href=\"javascript:void(0)\" class=\"add-answer-image add-interval-image\" style=display:block;>Add</a></label>\n" +
                "       <div class=\"ays-answer-image-container ays-interval-image-container\" style=display:none;>\n" +
                "           <span class=\"ays-remove-answer-img\"></span>\n" +
                "           <img src=\"\" class=\"ays-answer-img\" style=\"width: 100%;\"/>\n" +
                "           <input type=\"hidden\" name=\"interval_image[]\" class=\"ays-answer-image\" value=\"\"/>\n" +
                "       </div>\n" +
                "   </td>\n" +
                "   <td>\n" +
                "       <a href=\"javascript:void(0)\" class=\"ays-delete-interval\">\n" +
                "           <i class=\"ays_fa ays_fa_minus_square\" aria-hidden=\"true\"></i>\n" +
                "       </a>\n" +
                "   </td>\n" +
                "</tr>");
            intervals_table.find('.interval_wproduct').select2({
                allowClear: true,
                placeholder: 'Select a product',
                minimumInputLength: 1,
                ajax: {
                    url: quiz_maker_ajax.ajax_url,
                    dataType: 'json',
                    data: function (params) {
                        var checkedProducts = $(document).find('#ays_woo_selected_prods').val();
                        var checkedArray = [];
                        if(checkedProducts != ""){
                            checkedArray = checkedProducts.split(',');
                        }
                        return {
                            action: 'ays_get_woocommerce_products',
                            q: params.term,
                            prods: checkedArray,
                            page: params.page
                        };
                    }
                }
            });
        });

        $(document).on('click', '.ays-remove-answer-img', function () {
            $(this).parent().fadeOut();
            var ays_remove_answer_img = $(this);
            if(ays_remove_answer_img.parent().hasClass('ays-interval-image-container')){
                setTimeout(function(){
                    ays_remove_answer_img.parents().eq(1).find('.add-interval-image').fadeIn();
                    ays_remove_answer_img.parent().find('img.ays-answer-img').attr('src', '');
                    ays_remove_answer_img.parent().find('input.ays-answer-image').val('');
                },300);
            }
        });

        $(document).on('click', '.ays-delete-interval', function () {
            $(this).parent('td').parent('tr.ays-interval-row').remove();
            $(document).find('tr.ays-interval-row').each(function (r, el) {
                if ($(this).hasClass('even')) {
                    $(this).removeClass('even');
                }
                var index = r+1;
                var className = ((index % 2) === 0) ? 'even' : '';
                $(this).addClass(className);
            });
        });
        
        // Modal close
        $(document).find('.ays-close').on('click', function () {
            $(document).find('.ays-modal').aysModal('hide');
        });
            

        // Quiz questions table
        $(document).on('click', '.ays-delete-question', function () {
            var id = $(this).parents('.ays-question-row').data('id');
            var index = $.inArray(id, window.aysQuestSelected);

            if ( index !== -1 ) {
                window.aysQuestSelected.splice( index, 1 );
            }
        });


        $(document).find('input[type="checkbox"].ays-select-all').on('change', function () {
            var state = $(this).prop('checked'),
                table = $('table.ays-add-questions-table'),
                id_container = $(document).find('input#ays_already_added_questions'),
                existing_ids = id_container.val().split(',');
            if (state === false) {
                table.find('input[type="checkbox"].ays-select-single').each(function () {
                    if ($.inArray($(this).val().toString(), existing_ids) !== -1) {
                        var position = $.inArray($(this).val().toString(), existing_ids);
                        existing_ids.splice(position, 1);
                        id_container.val(existing_ids.join(','));
                        //$(document).find('tr.ays-question-row[data-id="' + $(this).val() + '"]').remove();
                    }
                });
            }
            table.find('input[type="checkbox"].ays-select-all').prop('checked', state);
            table.find('input[type="checkbox"].ays-select-single').each(function () {
                $(this).prop('checked', state);
            });
        });

        $(document).find('input[type="checkbox"].ays-select-single').on('change', function () {
            if (!$(this).prop('checked')) {
                var index = 1,
                    id_container = $(document).find('input#ays_already_added_questions'),
                    existing_ids = id_container.val().split(','),
                    question = $(this).val();
                if ($.inArray(question.toString(), existing_ids) !== -1) {
                    var position = $.inArray(question.toString(), existing_ids);
                    existing_ids.splice(position, 1);
                    id_container.val(existing_ids.join(','));
                }
                $(document).find('input[type="checkbox"].ays-select-all').prop('checked', false);
            }
        });

        var flags = [];
        $(document).find('input[type="checkbox"].ays-select-single').each(function () {
            if (!$(this).prop('checked'))
                flags.push(false);
            else
                flags.push(true);

        });

        if (flags.every(checkTrue)) {
            $(document).find('input[type="checkbox"].ays-select-all').prop('checked', true);
        }
        
        
        
        $(document).on('click', 'a.add-quiz-bg-music', function (e) {
            openMusicMediaUploader(e, $(this));
        });        
        $(document).on('click', 'a.add-quiz-image', function (e) {
            openQuizMediaUploader(e, $(this));
        });
        $(document).on('click', '.ays-remove-quiz-img', function () {
            $(this).parent().find('img#ays-quiz-img').attr('src', '');
            $('input#ays-quiz-image').val('');
            $(this).parent().fadeOut();
            $(document).find('.ays-field a.add-quiz-image').text('Add Image');
            var ays_quiz_theme = $(document).find('input[name="ays_quiz_theme"]:checked').val();
            switch (ays_quiz_theme) {
                case 'elegant_dark':
                case 'elegant_light':
                case 'rect_light':
                case 'rect_dark':
                case 'classic_dark':
                case 'classic_light':
                    $(document).find('#ays-quiz-live-image').css({'display': 'none'});
                    break;
                case 'modern_light':
                case 'modern_dark':
                    $(document).find('.ays-quiz-live-container').css({'background-image':'none'});
                    $(document).find('#ays-quiz-live-image').css({'display': 'none'});
                    break;
            }
        });
        $(document).on('click', 'a.add-quiz-bg-image', function (e) {
            openQuizMediaUploader(e, $(this));
        });
        $(document).on('click', '.ays-edit-quiz-bg-img', function (e) {
            openQuizMediaUploader(e, $(this));
        });
        $(document).on('click', '.ays-add-image, .ays-edit-img', function (e) {
            openMediaUploaderForImage(e, $(this));
        });

        $(document).on('click', '.ays-remove-img', function () {
            var wrap = $(this).parents('.ays-image-wrap');
            wrap.find('.ays-image-container').fadeOut(500);
            setTimeout(function(){
                wrap.find('img').attr('src', '');
                wrap.find('input.ays-image-path').val('');
                wrap.find('a.ays-add-image').show();
            }, 450);
        });
        
        
        var pagination = $('.ays-question-pagination');
        var pageCount = 20;
        if (pagination.length > 0) {
            createPagination(pagination, pageCount, 1);
        }

        // Tabulation
        $(document).find('.nav-tab-wrapper a.nav-tab').on('click', function (e) {
            if(! $(this).hasClass('no-js')){
                var elemenetID = $(this).attr('href');
                var active_tab = $(this).attr('data-tab');
                $(document).find('.nav-tab-wrapper a.nav-tab').each(function () {
                    if ($(this).hasClass('nav-tab-active')) {
                        $(this).removeClass('nav-tab-active');
                    }
                });
                $(this).addClass('nav-tab-active');
                $(document).find('.ays-quiz-tab-content').each(function () {
                    $(this).css('display', 'none');
                });
                $(document).find("[name='ays_quiz_tab']").val(active_tab);
                $(document).find("[name='ays_question_tab']").val(active_tab);
                $('.ays-quiz-tab-content' + elemenetID).css('display', 'block');
                e.preventDefault();
            }
        });
        
        $(document).find('.ays_next_tab').on('click', function(e){
            e.preventDefault();
            var $this = $(this);
            var parent = $this.parents('.ays-quiz-tab-content');
            if (typeof parent.next() != undefined && parent.next().hasClass('ays-quiz-tab-content')) {
                var parentId = parent.next().attr('id');
                var element = $(document).find('.nav-tab-wrapper a[data-tab='+ parentId +']');
                element.get(0).scrollIntoView({behavior: "smooth", block: "end", inline: "nearest"});
                element.trigger('click');
            }

        });

        $('.open-lightbox').on('click', function (e) {
            e.preventDefault();
            var image = $(this).attr('href');
            $('html').addClass('no-scroll');
            $('.ays-quiz-row ').append('<div class="lightbox-opened"><img src="' + image + '"></div>');
        });

        $('body').on('click', '.lightbox-opened', function () {
            $('html').removeClass('no-scroll');
            $('.lightbox-opened').remove();
        });

        
        $('#ays_users_roles').select2();        
        $('#ays_add_postcat_for_quiz').select2();
        $(document).find('#ays_quiz_users').select2();
        
        
        $(document).find('#ays_enable_restriction_pass').on('click', function () {
            if ($(this).prop('checked')) {
                if ($(document).find('#ays_enable_logged_users').prop('checked')){
                    $(document).find('#ays_enable_logged_users').prop('disabled', true);
                }else{
                    $(document).find('#ays_enable_logged_users').trigger('click');
                    $(document).find('#ays_enable_logged_users').prop('checked', true);
                    $(document).find('#ays_enable_logged_users').prop('disabled', true);
                }
            } else if($(document).find('#ays_enable_restriction_pass_users').prop('checked')) {
                $(document).find('#ays_enable_logged_users').prop('disabled', true);
            } else {
                $(document).find('#ays_enable_logged_users').prop('disabled', false);
            }
        });

        $(document).find('#ays_enable_restriction_pass_users').on('click', function () {
            if ($(this).prop('checked')) {
                if ($(document).find('#ays_enable_logged_users').prop('checked')){
                    $(document).find('#ays_enable_logged_users').prop('disabled', true);
                }else{
                    $(document).find('#ays_enable_logged_users').trigger('click');
                    $(document).find('#ays_enable_logged_users').prop('checked', true);
                    $(document).find('#ays_enable_logged_users').prop('disabled', true);
                }
            } else if($(document).find('#ays_enable_restriction_pass').prop('checked')) {
                $(document).find('#ays_enable_logged_users').prop('disabled', true);
            } else {
                $(document).find('#ays_enable_logged_users').prop('disabled', false);
            }
        });
        
        if($(document).find('#ays_logged_in_message').val() == ""){
            $(document).find('#ays_logged_in_message').html('You need to log in to pass this quiz.');
        }


//        $('#ays_enable_mail_user, #ays_enable_certificate').on('change', function () {
//            if ($(this).prop('checked')) {
//                if ($('#ays_information_form').val() === 'disable') {
//                    $('#ays_information_form').find('option[value="after"]').prop('selected', true).trigger('change');
//                    $('#ays_form_email').prop('checked', true);
//                    $('#ays_form_name').prop('checked', true);
//                }
//            }
//        });
        

        $('#quiz_stat_select').select2();
        $('#ays_smtp_secures').select2();
        $('#ays_paypal_currency').select2();
        $('.tablenav.top').find('.clear').before($('#filter-div'));
        $('.tablenav.top').find('.clear').before($('#category-filter-div-quizlist'));


        $(document).find('a[href="#tab3"]').on('click',function () {
            if($(document).find('.ays_active_theme_image').length === 0){
                $(document).find('#answers_view_select').css('display','none');
            }
        });
        
        $(document).on('click', '.ays-results-order-filter', function(e){
            e.preventDefault();
            var orderby = $(document).find('select[name="orderby"]').val();
            var link = location.href;
            if( orderby != '' ){
                orderby = "&orderby="+orderby;
                document.location.href = link+orderby;
            }else{
                document.location.href = link;
            }
        });
        
        setTimeout(function(){
            $(document).find('g title:contains("Chart created using amCharts library")').parent().remove();
        }, 1000);
        
        
        setTimeout(function(){
            if($(document).find('#ays_custom_css').length > 0){
                if(wp.codeEditor){
                    wp.codeEditor.initialize($(document).find('#ays_custom_css'), cm_settings);
                }
            }
        }, 500);

        $(document).find('a[href="#tab2"]').on('click', function (e) {        
            setTimeout(function(){
                if($(document).find('#ays_custom_css').length > 0){
                    var ays_custom_css = $(document).find('#ays_custom_css').html();
                    if(wp.codeEditor){
                        $(document).find('#ays_custom_css').next('.CodeMirror').remove();
                        wp.codeEditor.initialize($(document).find('#ays_custom_css'), cm_settings);
                        $(document).find('#ays_custom_css').html(ays_custom_css);
                    }
                }
            }, 500);
        });
        
        // Schedule of the Quiz
//        $('#active_date_check').change(function () {
//            $('.active_date').toggleClass('d-none')
//        })
        
        $(document).on('click', '#import_toggle_button', function(e){
            $(document).find('.upload-import-file-wrap').toggleClass('show-upload-view');
        });

        $(document).on('change', '#import_file', function(e){
            var pattern = /(.csv|.xlsx|.json)$/g;
            if(pattern.test($(this).val())){
                $(this).parents('form').find('input[name="import-file-submit"]').removeAttr('disabled')
            }
        });
        
        $(document).on('change', '#simple_import_check', function(e){
            if($(this).prop('checked') == true){
                $("input[type='hidden']#import_file_hidden").val('simple');
            }else{
                $("input[type='hidden']#import_file_hidden").val('custom');
            }
        });


        $('#ays_slack_client').on('input', function () {
            var clientId = $(this).val();
            if (clientId == '') {
                $("#slackOAuth2").addClass('disabled btn-outline-secondary');
                $("#slackOAuth2").removeClass('btn-secondary');
                return false;
            }
            var scopes = "channels%3Ahistory%20" +
                "channels%3Aread%20" +
                "channels%3Awrite%20" +
                "groups%3Aread%20" +
                "groups%3Awrite%20" +
                "mpim%3Aread%20" +
                "mpim%3Awrite%20" +
                "im%3Awrite%20" +
                "im%3Aread%20" +
                "chat%3Awrite%3Abot%20" +
                "chat%3Awrite%3Auser";
            var url = "https://slack.com/oauth/authorize?client_id=" + clientId + "&scope=" + scopes + "&state=" + clientId;
            $("#slackOAuth2").attr('data-src', url);//.toggleClass('disabled btn-outline-secondary btn-secondary');
            $("#slackOAuth2").removeClass('disabled btn-outline-secondary');
            $("#slackOAuth2").addClass('btn-secondary');
        });
        $("#slackOAuth2").on('click', function () {
            var url = $(this).attr('data-src');
            if (!url) {
                return false;
            }
            location.replace(url)
        });
        $('#ays_slack_secret').on('input', function(e) {
            if($(this).val() == ''){
                $("#slackOAuthGetToken").addClass('disabled btn-outline-secondary');
                $("#slackOAuthGetToken").removeClass('btn-secondary');
                return false;
            }
            
            $("#slackOAuthGetToken").removeClass('disabled btn-outline-secondary');
            $("#slackOAuthGetToken").addClass('btn-secondary');
        });

        $(document).find("#slackInstructionsPopOver").popover({
            content: $(document).find("#slackInstructions").html(),
            html: true,
//            trigger: "focus"
        });
        
        if ($('#ays-attribute-type').val() == 'select') {
            $('.ays_attr_options').show(250);
        }
        if ($('#ays-attribute-type').val() == 'checkbox') {
            $('.ays_attr_description').show(250);
        }
        $('#ays-attribute-type').on('change', function () {
            if ($(this).val() === 'select') {
                $('.ays_attr_options').show(250);
                $('.ays_attr_description').hide();
            } else if ($(this).val() === 'checkbox') {
                $('.ays_attr_description').show(250);
                $('.ays_attr_options').hide();
            } else {
                $('.ays_attr_options').hide(250);
                $('.ays_attr_description').hide(250);
            }
        });
        
        $(document).find('.cat-filter-apply').on('click', function(e){
            e.preventDefault();
            var catFilter = $(document).find('select[name="filterby"]').val();

            var link = location.href;
            if( catFilter != '' ){
                catFilter = "&filterby="+catFilter;
                document.location.href = link+catFilter;
            }else{
                var linkModifiedStart = link.split('?')[0];
                var linkModified = link.split('?')[1].split('&');
                for(var i = 0; i < linkModified.length; i++){
                    if(linkModified[i].split("=")[0] == "filterby"){
                        linkModified.splice(i, 1);
                    }
                }
                linkModified = linkModified.join('&');
                document.location.href = linkModifiedStart + "?" + linkModified;
            }
        });

        $(document).find('.review-page-quiz-filter-apply').on('click', function(e){
            e.preventDefault();
            var catFilter = $(document).find('select[name="filterby"]').val();

            var link = location.href;
            if( catFilter != '' ){
                catFilter = "&filterby="+catFilter;
                document.location.href = link+catFilter;
            }else{
                var linkModifiedStart = link.split('?')[0];
                var linkModified = link.split('?')[1].split('&');
                for(var i = 0; i < linkModified.length; i++){
                    if(linkModified[i].split("=")[0] == "filterby"){
                        linkModified.splice(i, 1);
                    }
                }
                linkModified = linkModified.join('&');
                document.location.href = linkModifiedStart + "?" + linkModified;
            }
        });

        $(document).find('.all-results-filter-apply').on('click', function(e){
            e.preventDefault();
            var catFilter = $(document).find('select[name="filterby"]').val();
            var userFilter = $(document).find('select[name="userby"]').val();
            var link = location.href;
            var linkModifiedStart = link.split('?')[0];
            var parsedUrl = aysGetJsonFromUrl( link );

            if( catFilter != '' ){
                parsedUrl.filterby = catFilter;
            }else{
                if(typeof parsedUrl.filterby != 'undefined'){
                    delete parsedUrl.filterby;
                }
            }

            if(userFilter != '' ){
                parsedUrl.wpuser = userFilter;
            }else{
                if(typeof parsedUrl.wpuser != 'undefined'){
                    delete parsedUrl.wpuser;
                }
            }

            var linkModified = [];
            for(var i in parsedUrl){
                linkModified.push(i + '=' + parsedUrl[i]);
            }
            linkModified = linkModified.join('&');
            document.location.href = linkModifiedStart + "?" + linkModified;
        });

        $(document).find('.user-filter-apply').on('click', function(e){
            e.preventDefault();
            var catFilter = $(document).find('select[name="filterbyuser"]').val();
            var link = location.href;
            var linkFisrtPart = link.split('?')[0];
            var linkModified = link.split('?')[1].split('&');
            for(var i = 0; i < linkModified.length; i++){
                if(linkModified[i].split("=")[0] == "wpuser"){
                    linkModified.splice(i, 1);
                }
            }
            link = linkFisrtPart + "?" + linkModified.join('&');
            
            if( catFilter != '' ){
                catFilter = "&wpuser="+catFilter;
                document.location.href = link+catFilter;
            }else{
                document.location.href = link;
            }
        });
        
        $(document).find('#ays-deactive, #ays-active').datetimepicker({
            controlType: 'select',
            oneLine: true,
            dateFormat: "yy-mm-dd",
            timeFormat: "HH:mm:ss"
        });
        
        
        // Quizzes form submit
        // Checking the issues
        $(document).find('#ays-quiz-category-form').on('submit', function(e){
            
            if($(document).find('#ays-quiz-title').val() == ''){
                $(document).find('#ays-quiz-title').val('Quiz').trigger('input');
            }
            var $this = $(this)[0];
            if($(document).find('#ays-quiz-title').val() != ""){
                $this.submit();
            }else{
                e.preventDefault();
                $this.submit();
            }
        });
        

        // Save as default button
        $(document).find('#ays_default').on('click', function(e){

            var message = $(this).data('message');
            var confirm = window.confirm( message );

            if(confirm !== true){
                e.preventDefault();
            }

        });

        $(document).find('.ays-question-ordering').on('click',function(){
            var table_tbody = $(document).find('#ays-questions-table tbody');
            table_tbody.append(table_tbody.find('tr').get().reverse());

            var sorting_ids = [];
            table_tbody.find('tr').each(function (index) {
                sorting_ids.push($(this).data('id'));
            });
            $(document).find('input#ays_already_added_questions').val(sorting_ids);

            var ordered = $(this).attr('data-ordered');
            if(ordered == 'true'){
                $(this).find('i.ays_fa_exchange').removeClass('ordered');
                $(this).attr('data-ordered', 'false');
            }else{
                $(this).find('i.ays_fa_exchange').addClass('ordered');
                $(this).attr('data-ordered', 'true');
            }
        });


        // Delete confirmation
        $(document).on('click', '.ays_confirm_del', function(e){            
            e.preventDefault();
            var message = $(this).data('message');
            var confirm = window.confirm('Are you sure you want to delete '+message+'?');
            if(confirm === true){
                window.location.replace($(this).attr('href'));
            }
        });

        //generate password
        $(document).find("#ays_psw_quiz").on('click', function(){
            $('#ays_generate_psw_content_quiz').hide(150);
            $('#ays_psw_content_quiz').show(500)
        });
        $(document).find("#ays_generate_password_quiz").on('click', function(){
            $('#ays_psw_content_quiz').hide(150);
            $('#ays_generate_psw_content_quiz').show(500)
        });

        $(document).on('click','.ays_genreted_password_count',function(){
            var count_passwords = $(document).find('#ays_password_count_quiz').val();
            var generated_table = $(document).find('.ays_created');
            var psw_symbols     = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$_+?%^&)";
            var psw_count       = 8;
            var password        = "";
            var content         = "";
                for (var i = 0; i < count_passwords; i++) {
                    for(var j = 0; j < psw_count; j++){
                        var psw = Math.floor(Math.random() * psw_symbols.length);
                            password += psw_symbols.substring(psw, psw+1);
                    }
                    content += '<li>';
                        content += '<span class="created_psw">'+password+'</span><a class="ays_gen_psw_copy"><i class="fa fa-clipboard" aria-hidden="true"></i></a>';
                        content += '<input type="hidden" name="ays_generated_psw[]" value="'+password+'" class="ays_generated_psw">';
                    content += '</li>';
                    password = "";
                }
            generated_table.append(content);
        });

        $(document).on('click','.ays_gen_psw_copy',function(){
            var $this = $(this);
            var generated_psw_parent  = $this.parents('#ays_generated_password').find('.ays_active');
            var copied_psw_value      = $this.next().val();
            var $temp                 = $("<input type='text'>");

            $("body").append($temp);
            $temp.val(copied_psw_value).select();
            document.execCommand("copy");
            $temp.remove();

            var content = '';
                content += '<li><span>'+ copied_psw_value+'</span>';
                    content += '<input type="hidden" name="ays_active_gen_psw[]" value="'+ copied_psw_value +'" class="ays_generated_psw">';
                content += '</li>';

                generated_psw_parent.append(content);
                $this.parent().remove();
        });

        $(document).on('click','#ays_gen_psw_copy_all',function(){
            var $this = $(this)
            var copied_passwords_ul_li = $this.parents('#ays_generated_password').find('#ays_generated_psw li');
            var $temp = $("<textarea><textarea>");
            var passwords = [];
            copied_passwords_ul_li.each(function(){
                var copied_passwords_value = $(this);
                var all_passwords = $(this).text();
                    passwords.push('\n'+all_passwords);
                    $(document).find('.ays_active').append(copied_passwords_value);
                var input = $('.ays_active').find('.ays_generated_psw').attr('name','ays_active_gen_psw[]');
                    $('.ays_active').find('.ays_gen_psw_copy').remove();
            });
            $("body").append($temp);
            $temp.val(passwords).select();
            document.execCommand("copy");
            $temp.remove();

            $(document).find('#ays_generated_psw li').remove();
        });

                //-------------GOOGLE SHEETS START-------------------
        $(document).find("#googleInstructionsPopOver").popover({
            content: $(document).find("#googleInstructions").html(),
            html: true,
        });
        var currentVal = $(document).find("#ays_google_client").val();
        $('#ays_google_client').on('input', function () {
//            var gclientId = $(this).val();
//            if (gclientId == '') {
//                $("#googleOAuth2").removeClass('btn-secondary');
//
//                $("#googleOAuth2").addClass('btn-outline-secondary');
//                $("#googleOAuth2").attr('data-src', '');
//                return false;
//            }
        });

//        var googleSecret = $(document).find('#ays_google_secret');
//        if(googleSecret.hasClass('ays_enable_secret')){
//            googleSecret.prop("readonly" , false);
//        }

        //-------------GOOGLE SHEETS END-------------------

    });
        
})(jQuery);
