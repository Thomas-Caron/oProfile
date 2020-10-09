<p>
    <label for="password">Mot de passe</label>
    <input
        type="password"
        id="password"
        name="password"
        class="input"
    />
</p>

<p>
    <label for="password-confirmation">Confirmation du mot de passe</label>
    <input
        type="password"
        id="password-confirmation"
        name="password-confirmation"
        class="input"
    />
</p>

<?php
if (has_filter('oprofile_registration_roles')) :
    $roles = apply_filters('oprofile_registration_roles', []);

    if (! empty($roles)) :

        do_action('oprofile_before_registration_roles');
        ?>
        <div>
            <label for="role"><?= apply_filters('oprofile_registration_roles_label', 'Vous êtes un'); ?></label>
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
                                    ! empty($_POST['role']) &&
                                    $_POST['role'] === $name
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
endif;
?>

<p>
    <label for="github-url">URL GitHub</label>
    <input
        type="url"
        id="github-url"
        name="github-url"
        class="input"
        <?php if (! empty($_POST['github-url'])) : ?>
            value="<?= esc_url_raw($_POST['github-url']); ?>"
        <?php endif; ?>
    />
</p>
