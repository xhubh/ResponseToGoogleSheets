<?php

/**
 * Template Name: Form Page Template
 */
get_header();
?>

<div class="section-form">
    <div class="intro">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/OKMGLOGO.png" alt="OKMG Logo">
    </div>
    <div class="form-wrapper">
        <form id="post-to-sheet" method="post">
            <?php $default_fields_checked_values = get_field('default_fields'); ?>
            <?php if ($default_fields_checked_values) : ?>
                <?php foreach ($default_fields_checked_values as $default_fields_value) :
                    if ($default_fields_value == "name") {
                        $name = 'name';
                        $label = 'Name';
                        $placeholder = 'Enter Your Name';
                    } else if ($default_fields_value == "email") {
                        $name = 'email';
                        $label = 'Email';
                        $placeholder = 'Enter Your Email Address';
                    } else if ($default_fields_value == "phone") {
                        $name = 'phone';
                        $label = 'Phone';
                        $placeholder = 'Enter Phone Number';
                    }
                ?>
                    <div class="form-controls">
                        <label for="<?php echo $name; ?>"><?php echo $label; ?></label>
                        <input placeholder="<?php echo $placeholder; ?>" required type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" />
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php if (have_rows('form_fields')) : ?>
                <?php while (have_rows('form_fields')) : the_row();
                    $name = get_sub_field('field_name');
                    $label = get_sub_field('field_label');
                    $placeholder = get_sub_field('placeholder');
                    $required = get_sub_field('required') == 1 ? 'required' : '';
                ?>
                    <?php if (get_row_layout() == 'single_line_text') : ?>
                        <div class="form-controls">
                            <label for="<?php echo $name; ?>"><?php echo $label; ?></label>
                            <input placeholder="<?php echo $placeholder; ?>" <?php echo $required; ?> type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" />
                        </div>
                    <?php elseif (get_row_layout() == 'multi_line_text') : ?>
                        <div class="form-controls">
                            <label for="<?php echo $name; ?>"><?php echo $label; ?></label>
                            <textarea placeholder="<?php echo $placeholder; ?>" <?php echo $required; ?> type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>"></textarea>
                        </div>
                    <?php elseif (get_row_layout() == 'dropdown_field') : ?>
                        <div class="form-controls">
                            <label for="<?php echo $name; ?>"><?php echo $label; ?></label>
                            <select placeholder="<?php echo $placeholder; ?>" <?php echo $required; ?> name="<?php echo $name; ?>" id="<?php echo $name; ?>">
                                <?php if (have_rows('choices')) : ?>
                                    <?php while (have_rows('choices')) : the_row(); ?>

                                        <option value="<?php echo get_sub_field('value'); ?>"> <?php echo get_sub_field('label'); ?></option>
                                    <?php endwhile; ?>
                                <?php else : ?>
                                    <?php // No rows found 
                                    ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    <?php endif; ?>
                <?php endwhile; ?>
            <?php else : ?>
                <?php // No layouts found 
                ?>
            <?php endif; ?>
            <input type="hidden" name="sheet" value="<?php echo  get_field('sheet_endpoint'); ?>">

            <button type="submit" class="submit-btn">Submit</button>
        </form>
    </div>
    <div id="result">

    </div>
</div>
<?php get_footer(); ?>