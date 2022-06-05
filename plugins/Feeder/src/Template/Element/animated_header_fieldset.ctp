<?= $this->Html->css('Feeder.animated-header-fieldset.css') ?>

<div class="form-group">
    <label class="col-sm-2 control-label">
        <?= $this->Form->label(__('has_animated_header')) ?>
    </label>
    <div class="col-sm-10">
        <div class="i-check">
            <?= $this->Form->input('has_animated_header', ['type' => 'checkbox', 'label' => false]) ?>
            <a href="Javascript:;" id="has-animated-header-preview"><?= __('Preview') ?></a>
            <?= $this->Form->input('animated_header_custom_style', ['type' => 'hidden', 'label' => false]) ?>
        </div>
    </div>
    <div class="col-sm-12">
        <fieldset class="i-check-panel" rel="has-animated-header">
            <div class="col-sm-2">
                <?= $this->Form->label(__('title')) ?>
            </div>
            <div class="col-sm-8">
                <?= $this->Form->input('animated_header_text_title', ['label' => false, 'class' => 'form-control', 'type' => 'text']) ?>
            </div>
            <div class="col-sm-2">
                <?= $this->Form->input('animated_header_text_title_color', ['label' => false, 'class' => 'form-control color', 'type' => 'text']) ?>
            </div>
            <br class="clearfix" />
            <div class="col-sm-2">
                <?= $this->Form->label(__('subtitle')) ?>
            </div>
            <div class="col-sm-8">
                <?= $this->Form->input('animated_header_text_subtitle', ['label' => false, 'class' => 'form-control', 'type' => 'text']) ?>
            </div>
            <div class="col-sm-2">
                <?= $this->Form->input('animated_header_text_subtitle_color', ['label' => false, 'class' => 'form-control color', 'type' => 'text']) ?>
            </div>
            <br class="clearfix" />
            <div class="col-sm-2">
                <?= $this->Form->label(__('first_color')) ?>
            </div>
            <div class="col-sm-2">
                <?= $this->Form->input('animated_header_first_background_color', ['label' => false, 'class' => 'form-control color', 'type' => 'text']) ?>
            </div>
            <div class="col-sm-2">
                <?= $this->Form->label(__('second_color')) ?>
            </div>
            <div class="col-sm-2">
                <?= $this->Form->input('animated_header_second_background_color', ['label' => false, 'class' => 'form-control color', 'type' => 'text']) ?>
            </div>
            <div class="col-sm-2">
                <?= $this->Form->label(__('third_color')) ?>
            </div>
            <div class="col-sm-2">
                <?= $this->Form->input('animated_header_third_background_color', ['label' => false, 'class' => 'form-control color', 'type' => 'text']) ?>
            </div>
            <br class="clearfix" />
            <div class="col-sm-1">
                <?= $this->Form->label(__('image')) ?>
            </div>
            <div class="col-sm-1">
                <img id="animated-header-image-preview"
                     src="<?= !is_bool(strpos($feederCategory->animated_header_image, "http")) ? $feederCategory->animated_header_image : '/img/' . $feederCategory->animated_header_image ?>"
                     style="max-width:100%"/>
                <?php
                if ($feederCategory->animated_header_image) {
                    ?>
                    <input type="checkbox" name="animated_header_image_delete" value="1" class="custom-checkbox" id="animated-header-image-delete" /> DELETE
                    <?php
                }
                ?>
            </div>
            <div class="col-sm-4">
                <?= $this->Form->input('animated_header_image', ['label' => false, 'class' => 'form-control', 'type' => 'file']) ?>
            </div>
            <div class="col-sm-1">
                <?= $this->Form->label(__('name_color')) ?>
            </div>
            <div class="col-sm-2">
                <?= $this->Form->input('animated_header_name_color', ['label' => false, 'class' => 'form-control color', 'type' => 'text']) ?>
            </div>
            <div class="col-sm-1">
                <?= $this->Form->label(__('box_color')) ?>
            </div>
            <div class="col-sm-2">
                <?= $this->Form->input('animated_header_box_color', ['label' => false, 'class' => 'form-control color', 'type' => 'text']) ?>
            </div>
            <br class="clearfix" />
            <div class="col-sm-2">
                <?= $this->Form->label(__('end_time')) ?>
            </div>
            <div class="col-sm-6 inline-selects">
                <?= $this->Form->control('animated_header_end_time', [
                    'label' => false,
                    'type' => 'date',
                    'minute' => false,
                    'empty' => [
                        'year' => __('year') . "..",
                        'month' => __('month') . "..",
                        'day' => __('day') . "..",
                        'hour' => __('hour') . ".."
                    ]
                ]) ?>
            </div>
            <div class="col-sm-2">
                <?= $this->Form->label(__('color')) ?>
            </div>
            <div class="col-sm-2">
                <?= $this->Form->input('animated_header_end_time_color', ['label' => false, 'class' => 'form-control color', 'type' => 'text']) ?>
            </div>
            <br class="clearfix" />
            <div class="col-sm-2">
                <?= $this->Form->label(__('calender')) ?>
            </div>
            <div class="col-sm-1">
                <?= $this->Form->label(__('number_color')) ?>
            </div>
            <div class="col-sm-2">
                <?= $this->Form->input('animated_header_number_color', ['label' => false, 'class' => 'form-control color', 'type' => 'text']) ?>
            </div>
            <div class="col-sm-1">
                <?= $this->Form->label(__('tile_color')) ?>
            </div>
            <div class="col-sm-2">
                <?= $this->Form->input('animated_header_tile_color', ['label' => false, 'class' => 'form-control color', 'type' => 'text']) ?>
            </div>
            <div class="col-sm-2">
                <?= $this->Form->label(__('animation_type')) ?>
            </div>
            <div class="col-sm-2">
                <?= $this->Form->input(__('animated_header_background_animation_type'), ['label' => false, 'class' => 'form-control', 'type' => 'select', 'options' => ['animation-default' => 'default']]) ?>
            </div>
        </fieldset>
    </div>
</div>

<script>
    $(document).ready(function ()
    {
        var control = $('#has-animated-header'),
            preview = $('#has-animated-header-preview'),
            panel = $('.i-check-panel[rel="has-animated-header"]'),
            style_template = '<style>'
                           + '#animated-header{background-color:[FIRST_BACKGROUND_COLOR]}'
                           + '#animated-header .animated-block{background-color: [SECOND_BACKGROUND_COLOR]}'
                           //+ '#world-image{background-image: url("[IMAGE]") !important;}'
                           + '#text-title{color: [TEXT_TITLE_COLOR]}'
                           + '#text-subtitle{color: [TEXT_SUBTITLE_COLOR]}'
                           + '#date-counter{color: [END_TIME_COLOR]}'
                           + '#world-image #world-title{background-color: [BOX_COLOR] !important;color: [NAME_COLOR] !important}'
                           + '#date-counter > div .date-tile{background-color: [TILE_COLOR] !important;color: [NUMBER_COLOR] !important}'
                           + '</style>';

        if (control.prop('checked')) {
            panel.show();
            control.parent().addClass('checked');
        }

        control.on('click', function (e)
        {
            $(this).parent().toggleClass('checked');
            if ($(this).prop('checked')) {
                panel.show(128);
            } else {
                panel.hide(128);
            }
        });

        $('.form-control.color').on('changeColor', function (e)
        {
            updateAnimatedHeaderStyle();
            $(this).parent().css('background-color', $(this).val());
        }).colorpicker({ // https://farbelous.io/bootstrap-colorpicker/tutorial-Basics.html
            format: "rgba",
            horizontal: true
        }).trigger('changeColor');

        $('#animated-header-image').on('change', function (e) {
            var input = $(this).get(0);
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#animated-header-image-preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);console.log(reader);
            }
            updateAnimatedHeaderStyle();
        });

        function updateAnimatedHeaderStyle ()
        {
            var style = style_template.replace('[FIRST_BACKGROUND_COLOR]', $('#animated-header-first-background-color').val())
                                      .replace('[SECOND_BACKGROUND_COLOR]', $('#animated-header-second-background-color').val())
                                      //.replace('[IMAGE]', $('#animated-header-image-preview').attr('src'))
                                      .replace('[TEXT_TITLE_COLOR]', $('#animated-header-text-title-color').val())
                                      .replace('[TEXT_SUBTITLE_COLOR]', $('#animated-header-text-subtitle-color').val())
                                      .replace('[END_TIME_COLOR]', $('#animated-header-end-time-color').val())
                                      .replace('[BOX_COLOR]', $('#animated-header-box-color').val())
                                      .replace('[NAME_COLOR]', $('#animated-header-name-color').val())
                                      .replace('[TILE_COLOR]', $('#animated-header-tile-color').val())
                                      .replace('[NUMBER_COLOR]', $('#animated-header-number-color').val());

            $('#animated-header-custom-style').val(style);

            return style;
        }

        preview.on('click', function (e)
        {
            var style = updateAnimatedHeaderStyle();

            $('body').append('<div id="animated-header-preview" class="' + $('#animated-header-background-animation-type').val() + '">' + style + '<?= addslashes(str_replace(["\n", "\r", "\t"], '', $this->element('animated_header'))) ?></div>').fadeIn(128);

            $('#animated-header-preview').find('#text-title').text($('#animated-header-text-title').val());
            $('#animated-header-preview').find('#text-subtitle').text($('#animated-header-text-subtitle').val());
            $('#animated-header-preview #world-image').css('background-image', 'url("' + $('#animated-header-image-preview').attr('src') + '")'); // just as spaß

            $('#animated-header-preview').on('click', function (e) {
                $(this).remove();
            });
        });
    });
</script>
