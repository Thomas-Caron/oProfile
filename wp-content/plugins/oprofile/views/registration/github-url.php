<p>
    <label for="github-url">URL GitHub</label>
    <input
        type="url"
        id="github-url"
        name="github-url"
        class="input"
        <?php if (! empty($formData['github-url'])) : ?>
            value="<?= esc_url_raw($formData['github-url']); ?>"
        <?php endif; ?>
    />
</p>
