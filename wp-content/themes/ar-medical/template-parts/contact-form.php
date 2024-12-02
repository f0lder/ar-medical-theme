<!-- template-parts/contact-form.php -->
<div class="contact-form-container p-6 max-w-lg mx-auto bg-white rounded-xl shadow-md space-y-4">
    <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post" class="space-y-4">
        <input type="hidden" name="action" value="submit_contact_form">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <input type="text" id="first_name" name="first_name" placeholder="Prenume" required
                    class="input input-bordered w-full">
            </div>
            <div>
                <input type="text" id="last_name" name="last_name" placeholder="Nume" required
                    class="input input-bordered w-full">
            </div>
            <div>
                <input type="text" id="phone" name="phone" placeholder="Număr de telefon" required
                    class="input input-bordered w-full ">
            </div>
            <div>
                <input type="email" id="email" name="email" placeholder="Email" required
                    class="input input-bordered w-full">
            </div>
        </div>
        <div>
            <input type="text" id="appointment" name="appointment" placeholder="Data programării" required
                class="input input-bordered w-full">
        </div>
        <div>
            <select id="service" name="service" required class="select select-bordered w-full">
                <option value="" disabled selected>Selectați un serviciu</option>
                <?php
                $args = array(
                    'post_type' => 'serviciu',
                    'posts_per_page' => -1,
                );
                $services = new WP_Query($args);
                if ($services->have_posts()):
                    while ($services->have_posts()):
                        $services->the_post();
                        ?>
                        <option value="<?php the_title(); ?>"><?php the_title(); ?></option>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </select>
        </div>
        <div>
            <textarea id="message" name="message" rows="4" placeholder="Mesaj" required
                class="textarea textarea-bordered w-full"></textarea>
        </div>
        <div>
            <button type="submit" class="btn btn-primary w-full">Trimite</button>
        </div>
    </form>
</div>


