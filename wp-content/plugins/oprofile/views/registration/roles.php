<?php

if (! empty($roles)) :

    do_action('oprofile_before_registration_roles');
    ?>
    <div>
        <label for="role"><?= __('Vous êtes un&hellip;'); ?></label>
        <div>
            <?php foreach ($roles as $name => $displayName) : ?>
                <p>
                    <label>
                        <input
                            type="radio"
                            name="role"
                            value="<?= esc_attr($name); ?>"
                            <?php
                            if (
                                ! empty($formData['role']) &&
                                $formData['role'] === $name
                            ) :
                            ?>
                                checked="checked"
                            <?php endif; ?>
                        />
                        <?= esc_html($displayName); ?>
                    </label>
                </p>
            <?php endforeach; ?>
        </div>
    </div>
<?php
endif;
